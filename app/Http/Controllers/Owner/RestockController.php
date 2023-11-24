<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;
use App\Models\Outlet;
use App\Models\Ref_Produk;
use App\Models\Ref_Project;
use App\Models\Ref_Bank;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ref_KuotaPoint;
use App\Models\Product_Outlet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Invoice_Detail_Seller;
use App\Models\Invoice_Master_Seller;
use App\Models\Konfirmasi_Pembayaran;

class RestockController extends Controller
{
    public function index()
    {
        $getOutlet      = Outlet::select('id', 'nama_outlet', 'outlet_id')->get();
        $getProduk      = Ref_Produk::select('id', 'sku', 'nama_produk', 'harga')->get();
        $getKategori    = Ref_Project::select('id', 'project_name')->get();

        return view('owner.restock-order.tambahRestock', [
            'title' => 'Restock Order',
        ], compact('getOutlet', 'getProduk', 'getKategori'));
    }

    public function getHargaOrder($id)
    {
        $produk = Ref_Produk::select(
            'ref_project.id as id_project',
            'ref_project.project_name',
            'ref_produks.harga',
            'ref_produks.sku'
        )
            ->leftJoin('ref_project', 'ref_produks.project_id', '=', 'ref_project.id')
            ->where('ref_produks.id', $id)
            ->first();

        // Periksa apakah produk ditemukan
        if ($produk) {
            $project_name   = $produk->project_name;
            $project_id     = $produk->id_project;
            $harga          = $produk->harga;
            $sku            = $produk->sku;

            return response()->json([
                'harga'         => $harga,
                'sku'           => $sku,
                'project_name'  => $project_name,
                'id_project'    => $project_id
            ]);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            // Cek jika qtyPaket dan semua qty di data_restock_order adalah null
            if (is_null($request->qtyPaket) && collect($request->data_restock_order)->every(function ($item) {
                return is_null($item['qty']);
            })) {
                // Jika kondisi terpenuhi, kembalikan response atau redirect
                return back()->with('error', 'Pesanan Tidak Ditemukan. Mohon Lengkapi Pesanan Anda.');
            }

            $request->validate([
                'outlet_id' => 'required',
            ]);

            // Get no_invoice
            $date               = date('Ymd');
            $randomNumberPart   = str_pad(mt_rand(0, 99999999), 8, "0", STR_PAD_LEFT); // 8 karakter
            $no_invoice         = 'MAI-' . $date . $randomNumberPart;

            // Menyiapkan data paket berdasarkan plan
            $planData = [];
            if ($request->plan == 'startup') {
                $planData[] = [
                    'sku_id'        => 'PAKET25',
                    'qty'           => '25',
                    'amount'        => '50000',
                    'id_produk'     => '01',
                    'project_name'  => null,
                    'id_project'    => null,
                    'harga_satuan'  => null,
                    'is_paket'      => '1'
                ];
            } elseif ($request->plan == 'advanced') {
                $planData[] = [
                    'sku_id'        => 'PAKET50',
                    'qty'           => '50',
                    'amount'        => '98000',
                    'id_produk'     => '02',
                    'project_name'  => null,
                    'id_project'    => null,
                    'harga_satuan'  => null,
                    'is_paket'      => '1'
                ];
            } elseif ($request->plan == 'custom') {
                $planData[] = [
                    'sku_id'        => 'PAKETAGAN',
                    'qty'           => $request->qtyPaket,
                    'amount'        => null,
                    'id_produk'     => '03',
                    'project_name'  => null,
                    'id_project'    => null,
                    'harga_satuan'  => null,
                    'is_paket'      => '1'
                ];
            }

            // Menggabungkan data plan dengan data_restock_order
            $allData = array_merge($planData, $request->data_restock_order ?? []);

            // Hitung total qty dan amount
            $totalQty = array_sum(array_column($allData, 'qty'));
            $totalAmount = array_sum(array_map(function ($item) {
                return (int) str_replace(['Rp', '.', ','], '', $item['amount']);
            }, $allData));

            // Simpan data ke invoice_master
            $master = Invoice_Master_Seller::create([
                'outlet_id'     => $request->outlet_id,
                'invoice_no'    => $no_invoice,
                'qty'           => $totalQty,
                'amount'        => $totalAmount,
                'noted'         => $request->noted,
                'date_created'  => Carbon::now()->timezone('Asia/Jakarta'),
                'progress'      => 0,
            ]);

            // Loop melalui array data_restock_order dan simpan data ke invoice_detail
            foreach ($allData as $detail) {
                if ($detail['sku_id'] && $detail['qty']) {
                    $amount = isset($detail['amount']) ? (int) str_replace(['Rp', '.', ','], '', $detail['amount']) : null;
                    $hargaSatuan = (int) str_replace(['Rp', '.', ','], '', $detail['harga_satuan']);

                    Invoice_Detail_Seller::create([
                        'outlet_id'     => $request->outlet_id,
                        'invoice_no'    => $no_invoice,
                        'sku_id'        => $detail['sku_id'],
                        'qty'           => $detail['qty'],
                        'amount'        => $hargaSatuan,
                        'discount'      => null, // logika untuk discount jika ada
                        'total_amount'  => $amount,
                        'date_created'  => Carbon::now()->timezone('Asia/Jakarta'),
                        'project_id'    => $detail['id_project'],
                        'is_paket'      => $detail['is_paket'] ?? '0'
                    ]);
                }
            }

            DB::commit(); // Commit the transaction

        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->route('owner.owner_restock')->with('error', 'Gagal Menambah Restock. Silakan coba lagi: ' . $th->getMessage());
        }
        return redirect()->route('owner.owner_status_restock')->with('success', 'Berhasil dan Pesanan sudah diterima, admin akan segera menghubungi WhatsApp anda');
    }

    public function konfPembayaran()
    {
        $getInvoice       = Invoice_Master_Seller::select('outlet_id', 'invoice_no', 'progress')
            ->where('outlet_id', Auth::user()->outlet_id)
            ->where('progress', 1)
            ->get();

        $getBankTujuan    = Ref_Bank::select('id', 'nama_bank', 'path_icon_bank')->get();

        return view('owner.restock-order.konfPembayaran', compact('getInvoice', 'getBankTujuan'));
    }

    public function cekDataInvoice($noInvoice)
    {
        $invoice = Invoice_Master_Seller::where('invoice_no', $noInvoice)->firstOrFail(); // Atau query yang sesuai untuk mendapatkan data
        return response()->json($invoice);
    }

    public function storeKonfPembayaran(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'outlet_id'                         => 'required',
                'invoice_no'                        => 'required',
                'bank_maigroup'                     => 'required',
                'asal_rekening_bank'                => 'required',
                'nama_pemilik_rekening_pembayaran'  => 'required',
                'bukti_pembayaran'                  => 'required'
            ]);

            if ($request->hasFile('bukti_pembayaran')) {
                $request->validate([
                    'bukti_pembayaran' => 'required|mimes:jpeg,png,jpg,pdf',
                ], [
                    'bukti_pembayaran.mimes' => 'Format Bukti Pembayaran harus berupa JPG, JPEG, PNG, atau PDF.',
                ]);

                $imageName = Str::random(10) . '_' . $request->bukti_pembayaran->getClientOriginalName();

                $request->bukti_pembayaran->storeAs('bukti_pembayaran/', $imageName, 'public');

                $imagePath = 'storage/bukti_pembayaran/' . $imageName;
            } else {
                $imageName = null;
                $imagePath = null;
            }

            $master = Konfirmasi_Pembayaran::create([
                'outlet_id'                         => $request->outlet_id,
                'invoice_no'                        => $request->invoice_no,
                'id_ref_bank_maigroup'              => $request->bank_maigroup,
                'asal_rekening_pembayaran'          => $request->asal_rekening_bank,
                'nama_pemilik_rekening_pembayaran'  => $request->nama_pemilik_rekening_pembayaran,
                'jumlah_pembayaran'                 => $request->jumlah_pembayaran,
                'bukti_pembayaran'                  => $imageName,
                'path_bukti_pembayaran'             => $imagePath,
                'date_created'                      => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            Invoice_Master_Seller::where('invoice_no', $request->invoice_no)->update([
                'progress' => '2',
            ]);

            DB::commit(); // Commit the transaction

        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal melakukan konfirmasi pembayaran. Silakan coba lagi: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Terima kasih atas konfirmasi pembayaran Anda! Kami akan segera melakukan verifikasi dan proses pengiriman barang, <strong>Cek Status invoice</strong> dan pesanan Anda pada halaman <strong>Daftar Pembelian</strong>.');
    }

    public function statusRestock()
    {
        $getStatus = Invoice_Master_Seller::select(
            'invoice_master_seller.outlet_id',
            'invoice_master_seller.invoice_no',
            'invoice_master_seller.progress',
            'invoice_master_seller.date_created',

            'outlets.outlet_id',
            'outlets.nama_outlet'
        )
            ->leftJoin('outlets', 'invoice_master_seller.outlet_id', '=', 'outlets.outlet_id')
            ->where('invoice_master_seller.outlet_id', Auth::user()->outlet_id)
            ->whereIn('invoice_master_seller.progress', ['0', '1', '2', '3', '4'])
            ->get();

        return view('owner.restock-order.daftarPembelian', compact('getStatus'));
    }

    public function detailPembelian($invoice)
    {
        $datas = DB::select("SELECT 
            outlet_id,
            invoice_no,
            qty,
            amount,
            date_created_invoice,
            ongkir,
            total,
            kode_unik,
            nama_outlet,
            no_hp_outlet,
            kodepos,
            alamat_detail,
            nama_kelurahan,
            nama_kotakab,
            nama_provinsi,
            nama_kecamatan

            FROM [maigroup].[dbo].[web.invoice_master_seller] ('". $invoice ."')
        ");
        $data = $datas[0];

        $detail = DB::select("SELECT 
            invoice_no,
            sku_id,
            qty,
            amount,
            discount,
            total_amount,
            project_name,
            nama_produk,
            path_thumbnail

            FROM [maigroup].[dbo].[web.invoice_detail_seller] ('". $invoice ."')
        ");

        if (!$detail) {
            redirect()->back()->with('error', 'Tidak Ada Detail');
        }

        return view('owner.restock-order.detailPembelian', [
            'data'     => $data,
            'details'  => $detail
        ]);
    }

    public function changeProgressOrder($invoice_no)
    {
        try {
            DB::beginTransaction();

            $invoice  = Invoice_Master_Seller::where('invoice_no', $invoice_no)->first();

            $invoice->update([
                'progress' => '5',
            ]);

            if ($invoice) {
                // get kouta point
                $kouta_point = Invoice_Detail_Seller::select('qty')->where('invoice_no', $invoice_no)->where('is_paket', '1')->get();
                $totalQty = $kouta_point->sum('qty');

                $kuotaPoint = ref_KuotaPoint::where('outlet_id', $invoice->outlet_id)->first();

                // update ref_kuota_point, berdasarkan outlet_id
                if ($kuotaPoint) {
                    $kuotaPoint->update([
                        'kuota_point' => DB::raw('kuota_point + ' . $totalQty)
                    ]);
                }

                // get varian product
                $produk_outlet = Invoice_Detail_Seller::select(
                        'invoice_detail_seller.sku_id',
                        'invoice_detail_seller.qty',

                        'ref_produks.id as produk_id',
                        'ref_produks.project_id'
                    )
                    ->leftJoin('ref_produks', 'invoice_detail_seller.sku_id', '=', 'ref_produks.sku')
                    ->where('invoice_no', $invoice_no)
                    ->where('is_paket', '0')
                    ->get();

                foreach ($produk_outlet as $data) {
                    $jumlah = $data->qty;

                    // Update atau insert product_outlet, berdasarkan outlet_id dan product_id
                    Product_Outlet::updateOrInsert([
                        'outlet_id'   => $invoice->outlet_id,
                        'product_id'  => $data->produk_id,
                    ], [
                        'category_id' => $data->project_id,
                        'jumlah'      => DB::raw('jumlah + ' . $jumlah),
                    ]);
                }

                DB::commit();

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Progress order berhasil diubah.'
                ]);
            } else {
                DB::rollback();

                return response()->json([
                    'status'  => 'error',
                    'message' => 'Invoice tidak ditemukan'
                ], 404);
            }
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
