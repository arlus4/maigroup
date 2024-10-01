<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Outlet;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\Users_Register;
use App\Models\Brands_Register;
use App\Models\Outlet_Register;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\Invoice_Master_Pembeli;

class Admin_OutletController extends Controller
{
    public function index_outletActive(): View
    {
        return view('master.outlets.daftarOutletActive');
    }

    public function getDataoutletActive(): JsonResponse
    {
        $data = DB::table('outlets')
            ->select(
                'outlets.id',
                'outlets.outlet_code',
                'outlets.outlet_name',
                'outlets.slug',
                'outlets.image_name',
                'outlets.path',
                'outlets.created_at',
                'users_login.name',
                'users_login.email',
                'brands.brand_code',
                'brands.brand_name',
                'brand_categories.brand_category_name',
            )
            ->leftJoin('users_login', 'outlets.user_id', 'users_login.id')
            ->leftJoin('brands', 'outlets.brand_code', 'brands.brand_code')
            ->leftJoin('brand_categories', 'brands.brand_category_code', 'brand_categories.brand_category_code')
            ->where('outlets.is_active', 1)
            ->orderBy('outlets.created_at', 'asc')
            ->get();
        
        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function detail_Outlet(Outlet $outlet): View
    {
        $owner = User::find($outlet->user_id);
        $pegawai = Pegawai::where('outlet_code', $outlet->outlet_code)->paginate(5);
        $transaksi = Invoice_Master_Pembeli::where('outlet_code', $outlet->outlet_code)->orderBy('date_created', 'asc')->paginate(5);

        $brand = Brand::select(
                'brands.brand_name',
                'brands.brand_code',
                'brands.brand_image',
                'brands.brand_image_path',
                'brand_categories.brand_category_name as category_name'
            )
            ->leftJoin('brand_categories', 'brands.brand_category_code', 'brand_categories.brand_category_code')
            ->where('brands.brand_code', $outlet->brand_code)
        ->first();

        if ($brand == null) {
            $brand = Brands_Register::select(
                'brands_registers.brand_name',
                'brands_registers.brand_code',
                'brands_registers.brand_image',
                'brands_registers.brand_image_path',
                'brand_categories.brand_category_name as category_name'
            )
            ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
            ->where('brands_registers.brand_code', $outlet->brand_code)
            ->first();
        }

        $penjualan = DB::table('invoice_master_pembeli')
            ->leftJoin('outlets', 'outlets.outlet_code', '=', 'invoice_master_pembeli.outlet_code')
            ->where('outlets.outlet_code', $outlet->outlet_code)
        ->sum('invoice_master_pembeli.amount');

        $pembelian = DB::table('invoice_master_pengeluaran')
            ->leftJoin('outlets', 'outlets.outlet_code', '=', 'invoice_master_pengeluaran.outlet_code')
            ->where('outlets.outlet_code', $outlet->outlet_code)
        ->sum('invoice_master_pengeluaran.amount');

        $pendapatan = $penjualan - $pembelian;
        return view('master.outlets.detailOutlet', [
            'outlet' => $outlet,
            'brand' => $brand,
            'owner'  => $owner,
            'pegawai' => $pegawai,
            'transaksi' => $transaksi,
            'pendapatan' => $pendapatan,
            'penjualan' => $penjualan
        ]);
    }

    public function getDetailTransaksi($invoice): JsonResponse
    {
        $invoiceNumbers = explode(',', $invoice); // Split the string into an array
    
        $dataInvoice = DB::table('invoice_master_pembeli')
            ->select(
                'invoice_master_pembeli.invoice_no',
                'invoice_master_pembeli.qty',
                'invoice_master_pembeli.amount',
                'invoice_master_pembeli.date_created',
                'pegawai.name as nama_pegawai',
                'users_pelanggan.name as nama_pembeli'
            )
            ->leftJoin('pegawai', 'pegawai.id', 'invoice_master_pembeli.pegawai_id')
            ->leftJoin('users_pelanggan', 'users_pelanggan.id', 'invoice_master_pembeli.pembeli_id')
            ->whereIn('invoice_master_pembeli.invoice_no', $invoiceNumbers) // Adjusted to handle multiple invoice numbers
            ->first();
    
        $detailInvoice = DB::table('invoice_detail_pembeli')
            ->select(
                'invoice_detail_pembeli.invoice_no',
                'invoice_detail_pembeli.qty',
                'invoice_detail_pembeli.amount',
                'invoice_detail_pembeli.price',
                'invoice_detail_pembeli.date_created',
                'product_outlets.product_name',
                'product_category.category_name'
            )
            ->leftJoin('product_outlets', 'product_outlets.id', 'invoice_detail_pembeli.product_id')
            ->leftJoin('product_category', 'product_category.category_code', 'product_outlets.category_id')
            ->whereIn('invoice_detail_pembeli.invoice_no', $invoiceNumbers) // Adjusted to handle multiple invoice numbers
            ->get();
    
        $datas = [
            'invoice' => $dataInvoice,
            'detail' => $detailInvoice
        ];
    
        return response()->json($datas);
    }

    public function printInvoice($invoice_no): View
    {
        $dataInvoice = DB::table('invoice_master_pembeli')
            ->select(
                'invoice_master_pembeli.invoice_no',
                'invoice_master_pembeli.outlet_code',
                'invoice_master_pembeli.qty',
                'invoice_master_pembeli.amount',
                'invoice_master_pembeli.date_created',
                'pegawai.name as nama_pegawai',
                'users_pelanggan.name as nama_pembeli',
                'users_login.name as nama_pemilik'
            )
            ->leftJoin('pegawai', 'pegawai.id', 'invoice_master_pembeli.pegawai_id')
            ->leftJoin('users_pelanggan', 'users_pelanggan.id', 'invoice_master_pembeli.pembeli_id')
            ->leftJoin('outlets', 'outlets.outlet_code', 'invoice_master_pembeli.outlet_code')
            ->leftJoin('users_login', 'users_login.id', 'outlets.user_id')
            ->where('invoice_master_pembeli.invoice_no', $invoice_no)
        ->first();

        $dataOutlet = DB::table('outlets')
            ->select(
                'outlets.outlet_code',
                'outlets.outlet_name',
                'outlets.no_hp',
                'outlets.image_name',
                'outlets.path',
                'outlets.whatsapp',
                'brands.brand_name',
                'brands.brand_description',
                'brands.brand_image',
                'brands.brand_image_path',
                'brand_categories.brand_category_name',
                DB::raw("CONCAT_WS(', ', outlet_details.alamat_detail, ref_kelurahan.nama_kelurahan) as alamat_detail"),
                DB::raw("CONCAT_WS(', ', ref_kecamatan.nama_kecamatan, ref_kotakab.nama_kotakab) as alamat"),
                DB::raw("CONCAT_WS(' - ', ref_propinsi.nama_propinsi, outlet_details.kode_pos) as kode_pos")
            )
            ->leftJoin('brands', 'brands.brand_code', 'outlets.brand_code')
            ->leftJoin('brand_categories', 'brands.brand_category_code', 'brand_categories.brand_category_code')
            ->leftJoin('outlet_details', 'outlet_details.outlet_code', 'outlets.outlet_code')
            ->leftJoin('ref_kelurahan', 'ref_kelurahan.kode_kelurahan', 'outlet_details.kelurahan')
            ->leftJoin('ref_kecamatan', 'ref_kecamatan.kode_kecamatan', 'outlet_details.kecamatan')
            ->leftJoin('ref_kotakab', 'ref_kotakab.kode_kotakab', 'outlet_details.kota_kabupaten')
            ->leftJoin('ref_propinsi', 'ref_propinsi.kode_propinsi', 'outlet_details.provinsi')
            ->where('outlets.outlet_code', $dataInvoice->outlet_code)
        ->first();

        $detailInvoice = DB::table('invoice_detail_pembeli')
            ->select(
                'invoice_detail_pembeli.invoice_no',
                'invoice_detail_pembeli.qty',
                'invoice_detail_pembeli.amount',
                'invoice_detail_pembeli.price',
                'invoice_detail_pembeli.date_created',
                'product_outlets.product_name',
                'product_category.category_name'
            )
            ->leftJoin('product_outlets', 'product_outlets.id', 'invoice_detail_pembeli.product_id')
            ->leftJoin('product_category', 'product_category.category_code', 'product_outlets.category_id')
            ->where('invoice_no', $invoice_no)
        ->get();

        if (!$dataInvoice) {
            return redirect()->back()->with('error', 'Invoice not found.');
        }

        return view('master.outlets.print_invoiceOutlet', [
            'dataInvoice' => $dataInvoice,
            'dataOutlet' => $dataOutlet,
            'detailInvoice' => $detailInvoice
        ]);
    }

    public function invoice_Outlet(Outlet $outlet): View
    {
        return view('master.outlets.list_invoiceOutlet', [
            'outlet' => $outlet
        ]);
    }

    public function getDataDetailOutlet(Outlet $outlet): JsonResponse
    {
        $detail = DB::table('outlet_details')
            ->select(
                'outlet_details.alamat_detail',
                'outlet_details.kode_pos',
                'outlet_details.link_google_maps',
                'ref_kelurahan.nama_kelurahan',
                'ref_kecamatan.nama_kecamatan',
                'ref_kotakab.nama_kotakab',
                'ref_propinsi.nama_propinsi',
            )
            ->leftJoin('ref_kelurahan', 'outlet_details.kelurahan', 'ref_kelurahan.kode_kelurahan')
            ->leftJoin('ref_kecamatan', 'outlet_details.kecamatan', 'ref_kecamatan.kode_kecamatan')
            ->leftJoin('ref_kotakab', 'outlet_details.kota_kabupaten', 'ref_kotakab.kode_kotakab')
            ->leftJoin('ref_propinsi', 'outlet_details.provinsi', 'ref_propinsi.kode_propinsi')
            ->where('outlet_details.outlet_code', $outlet->outlet_code)
        ->first();
        return response()->json([
            'message' => 'Data outlet berhasil diambil',
            'data' => $outlet,
            'detail' => $detail
        ], 200);
    }

    public function getDataPegawaiOutlet(Outlet $outlet): JsonResponse
    {
        $pegawai = Pegawai::where('outlet_code', $outlet->outlet_code)->orderBy('created_at')->get();

        $datas = [
            'data' => $pegawai
        ];
      
        return response()->json($datas);
    }

    public function getDataProductOutlet(Outlet $outlet): JsonResponse
    {
        $product = DB::table('product_outlets')
            ->select(
                'product_outlets.id',
                'product_outlets.product_name',
                'product_outlets.description',
                'product_outlets.stock',
                'product_outlets.price',
                'product_outlets.image',
                'product_outlets.slug',
                'product_category.category_name',
            )
            ->leftJoin('product_category', 'product_category.category_code', 'product_outlets.category_id')
            ->where('outlet_id', $outlet->outlet_code)
            ->orderBy('product_outlets.created_at')
        ->get();

        $datas = [
            'data' => $product
        ];

        return response()->json($datas);
    }

    public function getDataPenjualanOutlet(Outlet $outlet): JsonResponse
    {
        $transaksi = DB::table('invoice_master_pembeli')
            ->select(
                'invoice_master_pembeli.date_created',
                'invoice_master_pembeli.invoice_no',
                'invoice_master_pembeli.qty',
                'invoice_master_pembeli.amount',
                'users_pelanggan.name as pembeli',
                'pegawai.name as pegawai',
            )
            ->leftJoin('users_pelanggan', 'users_pelanggan.id', 'invoice_master_pembeli.pembeli_id')
            ->leftJoin('pegawai', 'pegawai.id', 'invoice_master_pembeli.pegawai_id')
            ->where('invoice_master_pembeli.outlet_code', $outlet->outlet_code)
            ->orderBy('invoice_master_pembeli.date_created', 'asc')
        ->get();

        $datas = [
            'data' => $transaksi
        ];

        return response()->json($datas);
    }

    public function getDataPengeluaranOutlet(Outlet $outlet): JsonResponse
    {
        $transaksi = DB::table('invoice_master_pengeluaran')
            ->select(
                'invoice_master_pengeluaran.created_at',
                'invoice_master_pengeluaran.invoice_no',
                'invoice_master_pengeluaran.qty',
                'invoice_master_pengeluaran.amount',
            )
            ->where('invoice_master_pengeluaran.outlet_code', $outlet->outlet_code)
            ->orderBy('invoice_master_pengeluaran.created_at', 'asc')
        ->get();

        $datas = [
            'data' => $transaksi
        ];

        return response()->json($datas);
    }

    public function getDetailPengeluaran($invoice): JsonResponse
    {
        $invoiceNumbers = explode(',', $invoice); // Split the string into an array
    
        $dataInvoice = DB::table('invoice_master_pengeluaran')
            ->select(
                'invoice_master_pengeluaran.invoice_no',
                'invoice_master_pengeluaran.qty',
                'invoice_master_pengeluaran.amount',
                'invoice_master_pengeluaran.created_at',
            )
            ->whereIn('invoice_master_pengeluaran.invoice_no', $invoiceNumbers) // Adjusted to handle multiple invoice numbers
            ->first();
    
        $detailInvoice = DB::table('invoice_detail_pengeluaran')
            ->select(
                'invoice_detail_pengeluaran.invoice_no',
                'invoice_detail_pengeluaran.qty',
                'invoice_detail_pengeluaran.amount',
                'invoice_detail_pengeluaran.price',
                'product_outlets.product_name',
                'product_bahan.nama as nama_bahan',
                'satuan_unit.value as unit',
                'invoice_detail_pengeluaran.created_at',
            )
            ->leftJoin('ref_config as satuan_unit', function ($join) {
                $join->on('invoice_detail_pengeluaran.unit', '=', 'satuan_unit.id_value')
                    ->where('satuan_unit.code', '=', 'opt_unit');
            })
            ->leftJoin('product_outlets', 'product_outlets.id', 'invoice_detail_pengeluaran.produk_id')
            ->leftJoin('product_bahan', 'product_bahan.id', 'invoice_detail_pengeluaran.bahan_id')
            ->whereIn('invoice_detail_pengeluaran.invoice_no', $invoiceNumbers) // Adjusted to handle multiple invoice numbers
            ->get();
    
        $datas = [
            'invoice' => $dataInvoice,
            'detail' => $detailInvoice
        ];
    
        return response()->json($datas);
    }

    public function updateStatusOutlet(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    =>'required'
            ]);

            $update = Outlet::findOrFail($request->id);
            if ($update->is_active == 0) {
                $update->update(['is_active' => 1]);
            } else {
                $update->update(['is_active' => 0]);
            }
            
            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Status berhasil diperbaharui');
    }

    // JANGAN DIHAPUS!!!
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index_outletPending(): View
    // {
    //     return view('master.user-owner.outlet.daftarOutletPending');
    // }

    // public function getDataoutletPending()
    // {
    //     $data = DB::table('outlet_registers')
    //         ->select(
    //             'outlet_registers.id',
    //             'outlet_registers.outlet_code',
    //             'outlet_registers.outlet_name',
    //             'outlet_registers.slug',
    //             'outlet_registers.image_name',
    //             'outlet_registers.path',
    //             'outlet_registers.created_at',
    //             'users_registers.name',
    //             'users_registers.email',
    //             'brands_registers.brand_code',
    //             'brands_registers.brand_name',
    //             'brand_categories.brand_category_name',
    //         )
    //         ->leftJoin('users_registers', 'outlet_registers.user_id', 'users_registers.id')
    //         ->leftJoin('brands_registers', 'outlet_registers.brand_code', 'brands_registers.brand_code')
    //         ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
    //         ->where('outlet_registers.is_regis', 0)
    //         ->orderBy('outlet_registers.created_at', 'asc')
    //         ->get();
        
    //     $datas = [
    //         'data' => $data
    //     ];
    
    //     return response()->json($datas);
    // }

    // public function getDataDetailOutletPending(Request $request)
    // {
    //     return response()->json(Outlet_Register::find($request->id));
    // }

    // public function detail_OutletPending(Outlet_Register $outlet): View
    // {
    //     return view('master.user-owner.outlet.detailOutletPending', [
    //         'outlet' => $outlet
    //     ]);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function approve_OutletPending(Request $request)
    // {
    //     try {
    //         DB::beginTransaction(); // Begin Transaction
            
    //         $request->validate([
    //             'id' => 'required'
    //         ]);

    //         $regis = Outlet_Register::find($request->id);

    //         // Cek user sudah teregistrasi atau belum
    //         $user = Users_Register::find($regis->user_id);
    //         if ($user->is_regis == 0) {
    //             return response()->json([
    //                 'status'  => 'error',
    //                 'message' => 'Owner belum terdaftar'
    //             ]);
    //         }

    //         // Cek brand sudah teregistrasi atau belum
    //         $brand = Brands_Register::where('brand_code', $regis->brand_code)->first();
    //         if ($brand->is_regis == 0) {
    //             return response()->json([
    //                 'status'  => 'error',
    //                 'message' => 'Brand belum terdaftar'
    //             ]);
    //         }

    //         Outlet::create([
    //             'user_id'       => $regis->user_id,
    //             'outlet_code'   => $regis->outlet_code,
    //             'outlet_name'   => $regis->outlet_name,
    //             'brand_code'    => $regis->brand_code,
    //             'slug'          => $regis->slug,
    //             'no_hp'         => $regis->no_hp,
    //             'image_name'    => $regis->image_name,
    //             'path'          => $regis->path,
    //             'website'       => $regis->website,
    //             'whatsapp'      => $regis->whatsapp,
    //             'facebook'      => $regis->facebook,
    //             'instagram'     => $regis->instagram,
    //             'tiktok'        => $regis->tiktok,
    //             'youtube'       => $regis->youtube,
    //             'is_active'     => 1,
    //             'created_at'    => Carbon::now()->timezone('Asia/Jakarta'),
    //             'updated_at'    => Carbon::now()->timezone('Asia/Jakarta')
    //         ]);

    //         $regis->update([
    //             'is_regis' => 1
    //         ]);

    //         DB::commit(); // Commit the transaction
    //     } catch (\Throwable $th) {
    //         DB::rollback(); // Rollback the transaction in case of an exception

    //         return response()->json([
    //             'status'  => 'error',
    //             'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
    //         ]);
    //     }
    //     return response()->json([
    //         'status'  => 'success',
    //         'message' => 'Outlet berhasil diapprove'
    //     ]);
    // }

    // public function reject_OutletPending(Request $request)
    // {
    //     try {
    //         DB::beginTransaction(); // Begin Transaction

    //         $request->validate([
    //             'id' => 'required'
    //         ]);

    //         $reject = Outlet_Register::find($request->id);

    //         $reject->update([
    //             'is_regis' => 2
    //         ]);

    //         DB::commit(); // Commit the transaction
    //     } catch (\Throwable $th) {
    //         DB::rollback(); // Rollback the transaction in case of an exception

    //         return response()->json([
    //             'status'  => 'error',
    //             'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
    //         ]);
    //     }
    //     return response()->json([
    //         'status'  => 'success',
    //         'message' => 'Outlets berhasil direject'
    //     ]);
    // }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index_outletReject()
    // {
    //     return view('master.user-owner.outlet.daftarOutletReject');
    // }

    // public function getDataoutletReject()
    // {
    //     $data = DB::table('outlet_registers')
    //         ->select(
    //             'outlet_registers.id',
    //             'outlet_registers.outlet_code',
    //             'outlet_registers.outlet_name',
    //             'outlet_registers.slug',
    //             'outlet_registers.image_name',
    //             'outlet_registers.path',
    //             'outlet_registers.created_at',
    //             'users_registers.name',
    //             'users_registers.email',
    //             'brands_registers.brand_code',
    //             'brands_registers.brand_name',
    //             'brand_categories.brand_category_name',
    //         )
    //         ->leftJoin('users_registers', 'outlet_registers.user_id', 'users_registers.id')
    //         ->leftJoin('brands_registers', 'outlet_registers.brand_code', 'brands_registers.brand_code')
    //         ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
    //         ->where('outlet_registers.is_regis', 2)
    //         ->orderBy('outlet_registers.created_at', 'asc')
    //         ->get();
        
    //     $datas = [
    //         'data' => $data
    //     ];
    
    //     return response()->json($datas);
    // }
}
