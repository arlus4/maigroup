<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;
use App\Models\Outlet;
use App\Models\Ref_Produk;
use App\Models\Ref_Project;
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
        $getOutlet      = Outlet::select('id','nama_outlet','outlet_id')->get();
        $getProduk      = Ref_Produk::select('id','sku','nama_produk','harga')->get();
        $getKategori    = Ref_Project::select('id','project_name')->get();

        return view('owner.restock',[
            'title' => 'Restock Order',
        ], compact('getOutlet','getProduk','getKategori'));
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
                    'sku_id' => 'PA1', 
                    'qty' => '25', 
                    'amount' => '25000',
                    'id_produk' => '01',
                    'project_name' => null,
                    'id_project' => null,
                    'harga_satuan' => null
                ];
            } elseif ($request->plan == 'advanced') {
                $planData[] = [
                    'sku_id' => 'PA2', 
                    'qty' => '50', 
                    'amount' => '50000',
                    'id_produk' => '02',
                    'project_name' => null,
                    'id_project' => null,
                    'harga_satuan' => null
                ];
            } elseif ($request->plan == 'custom') {
                $planData[] = [
                    'sku_id' => 'PA3', 
                    'qty' => $request->qtyPaket, 
                    'amount' => null,
                    'id_produk' => '03',
                    'project_name' => null,
                    'id_project' => null,
                    'harga_satuan' => null
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
                    ]);
                }
            }

            DB::commit(); // Commit the transaction

        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception
            
            return redirect()->route('owner.owner_restock')->with('error', 'Gagal Menambah Restock. Silakan coba lagi: '. $th->getMessage());
        }
        return redirect()->route('owner.owner_status_restock')->with('success', 'Berhasil dan Pesanan sudah diterima, admin akan segera menghubungi WhatsApp anda');
    }

    public function konfPembayaran(){
        $getInvoice = Invoice_Master_Seller::select('outlet_id','invoice_no','progress')
            ->where('outlet_id', Auth::user()->outlet_id)
            ->where('progress', 1)
            ->get();

        return view('owner.konfPembayaran', compact('getInvoice'));
    }

    public function cekDataInvoice($noInvoice){
        $invoice = Invoice_Master_Seller::where('invoice_no', $noInvoice)->firstOrFail(); // Atau query yang sesuai untuk mendapatkan data
        return response()->json($invoice);
    }

    public function storeKonfPembayaran(Request $request){
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'outlet_id'                         => 'required',
                'invoice_no'                        => 'required',
                'asal_rekening_bank'                => 'required',
                'nama_pemilik_rekening_pembayaran'  => 'required',
                'bukti_pembayaran'                  => 'required'
            ]);

            if ($request->hasFile('bukti_pembayaran')) {
                $request->validate([
                    'bukti_pembayaran' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'bukti_pembayaran.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.',
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

            return redirect()->back()->with('error', 'Gagal melakukan konfirmasi pembayaran. Silakan coba lagi: '. $th->getMessage());
        }
        return redirect()->back()->with('success', 'Terima kasih atas konfirmasi pembayaran Anda! Kami akan segera melakukan verifikasi dan proses pengiriman barang, <strong>Cek Status invoice</strong> dan pesanan Anda pada halaman <strong>Daftar Pembelian</strong>.');
    }

    public function statusRestock(){
        $getStatus = Invoice_Master_Seller::select(
                'invoice_master_seller.outlet_id',
                'invoice_master_seller.invoice_no',
                'invoice_master_seller.progress',

                'outlets.outlet_id',
                'outlets.nama_outlet'
            )
            ->leftJoin('outlets','invoice_master_seller.outlet_id','=','outlets.outlet_id')
            ->where('invoice_master_seller.outlet_id', Auth::user()->outlet_id)
            ->get();

        return view('owner.statusRestock', compact('getStatus'));
    }

    public function detailOrder($invoice)
    {
        $data = Invoice_Master_Seller::select
        (
            'invoice_master_seller.id as idInvoiceMasterSeller',
            'invoice_master_seller.outlet_id',
            'invoice_master_seller.invoice_no',
            'invoice_master_seller.qty',
            'invoice_master_seller.amount',
            'invoice_master_seller.date_created',
            'invoice_master_seller.ongkir',
            'invoice_master_seller.total',
            
            'outlets.id as idOutlets',
            'outlets.user_id',
            'outlets.nama_outlet',
            
            'users_details.nomor_telfon',
            'users_details.kode_pos',
            'users_details.alamat_detail',
            
            'ref_kelurahan.kode_kelurahan',
            'ref_kelurahan.nama_kelurahan',
            'ref_kecamatan.nama_kecamatan',
            'ref_kotakab.nama_kotakab',
            'ref_propinsi.nama_propinsi',
        )
        ->leftJoin('outlets','invoice_master_seller.outlet_id','=','outlets.outlet_id')
        ->leftJoin('users_details','outlets.user_id','=','users_details.user_id')
        ->leftJoin('ref_kelurahan','users_details.kelurahan','=','ref_kelurahan.kode_kelurahan')
        ->leftJoin('ref_kecamatan','users_details.kecamatan','=','ref_kecamatan.kode_kecamatan')
        ->leftJoin('ref_kotakab','users_details.kota_kabupaten','=','ref_kotakab.kode_kotakab')
        ->leftJoin('ref_propinsi','users_details.provinsi','=','ref_propinsi.kode_propinsi')
        ->where('invoice_master_seller.invoice_no', $invoice)
        ->where('invoice_master_seller.outlet_id', Auth::user()->outlet_id)
        ->first();

        $detail = Invoice_Detail_Seller::select(
            'invoice_detail_seller.invoice_no',
            'invoice_detail_seller.sku_id',
            'invoice_detail_seller.qty as qtyDetailSeller',
            'invoice_detail_seller.amount as amountDetailSeller',
            'invoice_detail_seller.discount',
            'invoice_detail_seller.total_amount',
            'invoice_detail_seller.project_id',
            
            'ref_produks.sku',
            'ref_produks.nama_produk',
            'ref_produks.path_thumbnail',

            'ref_project.project_name',
        )
        ->leftJoin('ref_produks', 'invoice_detail_seller.sku_id', '=', 'ref_produks.sku')
        ->leftJoin('ref_project', 'invoice_detail_seller.project_id', '=', 'ref_project.id')
        ->where('invoice_detail_seller.invoice_no', $invoice)
        ->where('invoice_detail_seller.outlet_id', Auth::user()->outlet_id)
        ->get();

        if (!$detail) {
            redirect()->back()->with('error', 'Tidak Ada Detail');
        }

        return view('owner.detailOrder', [
            'data'     => $data,
            'details'  => $detail
        ]);
    }

    public function changeProgressOrder($invoice_no) {
        try {
            DB::beginTransaction();
    
            $invoice  = Invoice_Master_Seller::where('invoice_no', $invoice_no)->first();
            $dataJoin = Invoice_Master_Seller::select(
                    'invoice_master_seller.outlet_id',
                    'invoice_master_seller.invoice_no',

                    'invoice_detail_seller.sku_id',
                    'invoice_detail_seller.qty',

                    'ref_produks.id',
                    'ref_produks.project_id'
                )
                ->leftJoin('invoice_detail_seller','invoice_master_seller.invoice_no','=','invoice_detail_seller.invoice_no')
                ->leftJoin('ref_produks','invoice_detail_seller.sku_id','=','ref_produks.sku')
                ->where('invoice_detail_seller.invoice_no', $invoice->invoice_no)
                ->get();
            
            if ($invoice) {
                $invoice->update([
                    'progress' => '5',
                ]);
 
                // update ref_kuota_point, berdasarkan outlet_id
                ref_KuotaPoint::where('outlet_id', $invoice->outlet_id)->update(['kuota_point' => DB::raw('kuota_point + ' . $invoice->qty)]);


                // update atau insert product_outlet, berdasarkan outlet_id
                foreach ($dataJoin as $data) {
                    Product_Outlet::updateOrInsert([
                        'outlet_id'   => $invoice->outlet_id,
                        'product_id'  => $data->id,
                    ],[
                        'category_id' => $data->project_id,
                        'jumlah'      => DB::raw('jumlah + ' . $data->qty),
                    ]);
                }

                DB::commit();
    
                return response()->json(['status' => 'success', 'message' => 'Progress order berhasil diubah.']);
            } else {
                DB::rollback();
    
                return response()->json(['status' => 'error', 'message' => 'Invoice tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            DB::rollback();
    
            Log::error($e);
    
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
