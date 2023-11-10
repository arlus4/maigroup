<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Outlet;
use App\Models\Ref_Produk;
use App\Models\Ref_Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Invoice_Detail_Seller;
use App\Models\Invoice_Master_Seller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class Admin_OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $data = Invoice_Master_Seller::select(
                'invoice_master_seller.id as idInvoiceMasterSeller',
                'invoice_master_seller.outlet_id',
                'invoice_master_seller.invoice_no',
                'invoice_master_seller.qty',
                'invoice_master_seller.amount',
                'invoice_master_seller.project_id',
                'invoice_master_seller.progress',
                'invoice_master_seller.ongkir',
                'invoice_master_seller.total'
            )
            ->whereIn('invoice_master_seller.progress', ['0', '1'])
            ->orderBy('invoice_master_seller.progress', 'asc')
            ->get();

        return view('master.order.daftarOrder', compact('data'));
    }

    public function get_data_order($invoice)
    {
        $data = Invoice_Master_Seller::select
        (
            'invoice_master_seller.id as idInvoiceMasterSeller',
            'invoice_master_seller.outlet_id',
            'invoice_master_seller.invoice_no',
            'invoice_master_seller.qty',
            'invoice_master_seller.amount',
            'invoice_master_seller.date_created',
            
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
        ->first();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOngkir(Request $request): RedirectResponse
    {
        // Validasi request
        $request->validate([
            'invoice_no' => 'required|exists:invoice_master_seller,invoice_no',
            'ongkir' => 'required|numeric'
        ]);
    
        try {
            DB::beginTransaction(); // Begin Transaction

            // Dapatkan invoice berdasarkan invoice_no
            $invoice = Invoice_Master_Seller::where('invoice_no', $request->invoice_no)->first();
    
            if ($invoice) {
                // Hitung total baru
                $newTotal = $invoice->amount + $request->ongkir;
    
                // Update field ongkir dan total
                $invoice->update([
                    'progress' => '1',
                    'ongkir' => $request->ongkir,
                    'total' => $newTotal
                ]);
    
                DB::commit(); // Commit the transaction

                // Redirect atau return response sukses
                return back()->with('success', 'Data ongkir dan total berhasil diupdate.');
            }
            
            // Jika invoice tidak ditemukan, kembalikan response error
            return back()->with('error', 'Invoice tidak ditemukan.');
    
        } catch (\Throwable $th) {
            // Jika terjadi kesalahan, tangkap exception dan kembalikan response error
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return back()->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $th->getMessage());
        }
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderDetail($invoice): View | RedirectResponse
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
        ->get();

        if (!$detail) {
            redirect()->back()->with('error', 'Tidak Ada Detail');
        }

        // return response()->json($data);
        return view('master.order.invoiceOrder',[
            'data' => $data,
            'details' => $detail
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $getOutlet      = Outlet::select('id','nama_outlet','outlet_id')->get();
        $getProduk      = Ref_Produk::select('id','sku','nama_produk','harga')->get();
        $getKategori    = Ref_Project::select('id','project_name')->get();

        return view('master.order.tambahOrder', compact('getOutlet','getProduk','getKategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            // Validasi request
            $request->validate([
                'outlet_id' => 'required',
                'kt_docs_repeater_advanced.*.sku_id' => 'required',
                'kt_docs_repeater_advanced.*.qty' => 'required',
                'kt_docs_repeater_advanced.*.amount' => 'required'
            ]);

            // Hitung total qty dan amount
            $totalQty = collect($request->kt_docs_repeater_advanced)->sum('qty');
            $totalAmount = collect($request->kt_docs_repeater_advanced)->sum(function($item) {
                return (int) str_replace(['Rp', '.', ','], '', $item['amount']);
            });

            // Get no_invoice
            $date = date('Ymd'); // Untuk ambil data tanggal hari ini
            $randomNumberPart = str_pad(mt_rand(0, 99999999), 8, "0", STR_PAD_LEFT); // 8 karakter
            $no_invoice = 'MAI-' . $date . $randomNumberPart;

            // Simpan data ke invoice_master
            $master = Invoice_Master_Seller::create([
                'outlet_id' => $request->outlet_id,
                'invoice_no' => $no_invoice,
                'qty' => $totalQty,
                'amount' => $totalAmount,
                'noted' => $request->noted,
                'date_created' => Carbon::now()->timezone('Asia/Jakarta'),
                'progress' => 0,
            ]);

            // Loop melalui array kt_docs_repeater_advanced dan simpan data ke invoice_detail
            foreach ($request->kt_docs_repeater_advanced as $detail) {
                $amount = (int) str_replace(['Rp', '.', ','], '', $detail['amount']);
                $hargaSatuan = (int) str_replace(['Rp', '.', ','], '', $detail['harga_satuan']);

                Invoice_Detail_Seller::create([
                    'outlet_id' => $request->outlet_id,
                    'invoice_no' => $no_invoice,
                    'sku_id' => $detail['sku_id'],
                    'qty' => $detail['qty'],
                    'amount' => $hargaSatuan,
                    'discount' => null, // logika untuk discount jika ada
                    'total_amount' => $amount,
                    'date_created' => Carbon::now()->timezone('Asia/Jakarta'),
                    'project_id' => $detail['id_project'],
                ]);
            }

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return redirect()->route('admin.admin_order')->with('error', 'Gagal Menambah Orderan. Silakan coba lagi: '. $th->getMessage());
        }
        return redirect()->route('admin.admin_order')->with('success', 'Berhasil Menambah Orderan');
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
            $project_name = $produk->project_name;
            $project_id = $produk->id_project;
            $harga = $produk->harga;
            $sku = $produk->sku;

            return response()->json([
                'harga' => $harga,
                'sku' => $sku,
                'project_name' => $project_name,
                'id_project' => $project_id
            ]);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    public function downloadInvoice($invoice)
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
        ->first();

        $details = Invoice_Detail_Seller::select(
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
        ->get();

        return view('master.order.invoice',[
            'data' => $data,
            'details' => $details
        ]);
    
        // // Pastikan Anda memanggil facade dengan alias yang benar
        // $pdf = Pdf::loadView('master.order.invoice');
    
        // // Set ukuran kertas dan orientasi
        // $pdf->setPaper('A4', 'portrait');
    
        // // Download PDF
        // return $pdf->download('invoice-'.$data->invoice_no.'.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderPending(): View
    {
        $data = Invoice_Master_Seller::select(
                'invoice_master_seller.id as idInvoiceMasterSeller',
                'invoice_master_seller.outlet_id',
                'invoice_master_seller.invoice_no',
                'invoice_master_seller.qty',
                'invoice_master_seller.amount',
                'invoice_master_seller.project_id',
                'invoice_master_seller.progress',
                'invoice_master_seller.ongkir',
                'invoice_master_seller.total'
            )
            ->whereIn('invoice_master_seller.progress', ['2', '3'])
            ->orderBy('invoice_master_seller.progress', 'asc')
            ->get();

        return view('master.order.pendingOrder', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function receivedPayment($invoice): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction
            
            $data = Invoice_Master_Seller::where('invoice_no', $invoice)->first();

            $data->update([
                'progress' => '3',
            ]);

            DB::commit(); // Commit the transaction

            return back()->with('success', 'Pembayaran Berhasil di Diterima');

        } catch (\Throwable $th) {
            // Jika terjadi kesalahan, tangkap exception dan kembalikan response error
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return back()->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveOrder($invoice): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction
            
            $data = Invoice_Master_Seller::where('invoice_no', $invoice)->first();

            $data->update([
                'progress' => '4',
            ]);

            DB::commit(); // Commit the transaction

            return back()->with('success', 'Invoice Berhasil di Diterima');

        } catch (\Throwable $th) {
            // Jika terjadi kesalahan, tangkap exception dan kembalikan response error
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return back()->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $th->getMessage());
        }
    }
}
