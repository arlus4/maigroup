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
use App\Models\Invoice_Pengiriman_Seller;
use App\Models\Konfirmasi_Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;

class Admin_OrderController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index(): View
    // {
    //     $data = Invoice_Master_Seller::select(
    //             'invoice_master_seller.id as idInvoiceMasterSeller',
    //             'invoice_master_seller.outlet_id',
    //             'invoice_master_seller.invoice_no',
    //             'invoice_master_seller.qty',
    //             'invoice_master_seller.amount',
    //             'invoice_master_seller.project_id',
    //             'invoice_master_seller.progress',
    //             'invoice_master_seller.ongkir',
    //             'invoice_master_seller.total'
    //         )
    //         ->whereIn('invoice_master_seller.progress', ['0', '1'])
    //         ->orderBy('invoice_master_seller.progress', 'asc')
    //         ->get();

    //     return view('master.order.daftarOrder', compact('data'));
    // }

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new_order(): View
    {
        return view('master.order.daftarOrder', [
            'title' => "New Order",
            'url'   => 'get_data_new_order'
        ]);
    }

    public function get_data_new_order()
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
        ->where('invoice_master_seller.progress', 0)
        ->orderBy('invoice_master_seller.date_created', 'asc')
        ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
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

            // Cek data agar tidak ada total_amount yang null
            $invoice_detail = Invoice_Detail_Seller::select('total_amount')->where('invoice_no', $request->invoice_no)->get();

            foreach ($invoice_detail as $detail) {
                if ($detail->total_amount === null) {
                    // Proses dihentikan jika ditemukan total_amount yang null
                    return back()->with('error', 'Silahkan Periksa Kembali Harga Produk pada Invoice Detail.');
                }
            }

            // Dapatkan invoice berdasarkan invoice_no
            $invoice = Invoice_Master_Seller::where('invoice_no', $request->invoice_no)->first();
    
            if ($invoice) {
                // Generate kode unik
                $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                $kodeUnik = $this->generateUniqueCode($today);

                // Hitung total baru
                $newTotal = $invoice->amount + $request->ongkir + $kodeUnik;
    
                // Update field ongkir dan total
                $invoice->update([
                    'progress' => '1',
                    'ongkir' => $request->ongkir,
                    'total' => $newTotal,
                    'kode_unik' => $kodeUnik
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

    // class function untuk generate kode unik
    private function generateUniqueCode($date)
    {
        do {
            $randomCode = rand(11, 99);
            $exists = Invoice_Master_Seller::where('date_created', $date)->where('kode_unik', $randomCode)->exists();
        } while ($exists);

        return $randomCode;
    }

    public function update_harga_paket(Request $request, $invoice)
    {
        try {
            DB::beginTransaction(); // Begin Transaction
    
            // Validasi request
            $request->validate([
                'sku_id' => 'required',
                'harga' => 'required',
            ]);
            
            $master = Invoice_Master_Seller::where('invoice_no', $invoice)->first();
            $detail = Invoice_Detail_Seller::where('invoice_no', $invoice)
                                           ->where('sku_id', $request->sku_id)
                                           ->first();
    
            if (!$master || !$detail) {
                throw new \Exception("Data tidak ditemukan.");
            }
    
            $master_total = $master->amount + $request->harga;
            $master->update(['amount' => $master_total]);
            $detail->update(['total_amount' => $request->harga]);
    
            DB::commit(); // Commit the transaction
            
            return back()->with('success', 'Data harga berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception
            return back()->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $th->getMessage());
        }
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function waiting_payment_order(): View
    {
        return view('master.order.daftarOrder', [
            'title' => "Waiting Payment",
            'url'   => 'get_data_waiting_payment'
        ]);
    }

    public function get_data_waiting_payment()
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
        ->where('invoice_master_seller.progress', 1)
        ->orderBy('invoice_master_seller.date_created', 'asc')
        ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment_received_order(): View
    {
        return view('master.order.daftarOrder', [
            'title' => "Payment Received",
            'url'   => 'get_data_payment_received'
        ]);
    }

    public function get_data_payment_received()
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
        ->where('invoice_master_seller.progress', 2)
        ->orderBy('invoice_master_seller.date_created', 'asc')
        ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_payment_received_order($invoice)
    {
        try {
            DB::beginTransaction(); // Begin Transaction
            
            $data = Invoice_Master_Seller::where('invoice_no', $invoice)->first();

            $data->update([
                'progress' => '3',
            ]);

            DB::commit(); // Commit the transaction

            return response()->json(['status' => 'success', 'message' => 'Pembayaran Berhasil Diterima']);

        } catch (\Throwable $th) {
            // Jika terjadi kesalahan, tangkap exception dan kembalikan response error
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengupdate data: ' . $th->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve_order(): View
    {
        return view('master.order.daftarOrder', [
            'title' => "Approve Order",
            'url'   => 'get_data_approve'
        ]);
    }

    public function get_data_approve()
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
        ->where('invoice_master_seller.progress', 3)
        ->orderBy('invoice_master_seller.date_created', 'asc')
        ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_approve_order(Request $request, $invoice)
    {
        // dd($invoice, $request->all());
        try {
            DB::beginTransaction(); // Begin Transaction
            
            $data = Invoice_Master_Seller::where('invoice_no', $invoice)->first();

            $data->update([
                'progress' => '4',
            ]);

            Invoice_Pengiriman_Seller::create([
                'invoice_no'            => $invoice,
                'nama_ekspedisi'        => $request->nama_ekspedisi,
                'no_resi'               => $request->no_resi,
                'status'                => '1',
                'tanggal_pengiriman'    => $request->tanggal_pengiriman,
                'date_created'          => Carbon::now()->timezone('Asia/Jakarta'),
            ]);

            DB::commit(); // Commit the transaction

            return response()->json(['status' => 'success', 'message' => 'Pesanan Berhasil Dikirim']);

        } catch (\Throwable $th) {
            // Jika terjadi kesalahan, tangkap exception dan kembalikan response error
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengupdate data: ' . $th->getMessage()], 500);
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deliver_order(): View
    {
        return view('master.order.daftarOrder', [
            'title' => "Deliver Order",
            'url'   => 'get_data_deliver'
        ]);
    }

    public function get_data_deliver()
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
        ->where('invoice_master_seller.progress', 4)
        ->orderBy('invoice_master_seller.date_created', 'asc')
        ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejected_order(): View
    {
        return view('master.order.daftarOrder', [
            'title' => "Rejected Order",
            'url'   => 'get_data_rejected'
        ]);
    }

    public function get_data_rejected()
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
        ->where('invoice_master_seller.progress', 6)
        ->orderBy('invoice_master_seller.date_created', 'asc')
        ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
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
            'invoice_master_seller.progress',
            'invoice_master_seller.kode_unik',
            
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

        $konfirmasi = Konfirmasi_Pembayaran::select(
            'konfirmasi_pembayarans.outlet_id',
            'konfirmasi_pembayarans.invoice_no',
            'konfirmasi_pembayarans.asal_rekening_pembayaran',
            'konfirmasi_pembayarans.nama_pemilik_rekening_pembayaran',
            'konfirmasi_pembayarans.jumlah_pembayaran',
            'konfirmasi_pembayarans.bukti_pembayaran',
            'konfirmasi_pembayarans.path_bukti_pembayaran',
            'konfirmasi_pembayarans.date_created',

            'ref_bank.nama_bank',
            'ref_bank.icon_bank',
            'ref_bank.path_icon_bank'
        )
        ->leftjoin('ref_bank', 'konfirmasi_pembayarans.id_ref_bank_maigroup', '=', 'ref_bank.id')
        ->where('invoice_no', $invoice)
        ->first();

        $shipping = Invoice_Pengiriman_Seller::select(
            'invoice_no',
            'nama_ekspedisi',
            'no_resi',
            'tanggal_pengiriman'
        )
        ->where('invoice_no', $invoice)
        ->first();

        if (!$konfirmasi) {
            return view('master.order.invoiceOrder', [
                'data' => $data,
                'details' => $detail
            ]);
        }

        if (!$detail) {
            redirect()->back()->with('error', 'Tidak Ada Detail');
        }

        return view('master.order.summaryInvoice', [
            'data' => $data,
            'details' => $detail,
            'shipping' => $shipping,
            'konfirmasi' => $konfirmasi,
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
            'invoice_master_seller.kode_unik',
            
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

        return view('master.order.invoice', [
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
}
