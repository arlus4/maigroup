<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Users_Register;
use App\Models\Outlet_Register;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Brands_Register;
use App\Models\Outlet;
use App\Models\Pegawai;
use App\Models\Product_Outlet;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Admin_OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_outletActive()
    {
        return view('master.user-owner.outlet.daftarOutletActive');
    }

    public function getDataoutletActive()
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
        return view('master.user-owner.outlet.detailOutlet', [
            'outlet' => $outlet,
            'owner'  => $owner,
            'pegawai' => $pegawai
        ]);
    }

    public function getDataPegawaiOutlet(Outlet $outlet)
    {
        $pegawai = Pegawai::where('outlet_code', $outlet->outlet_code)->orderBy('created_at')->get();

        $datas = [
            'data' => $pegawai
        ];
      
        return response()->json($datas);
    }

    public function getDataProductOutlet(Outlet $outlet)
    {
        // $product = Product_Outlet::where('outlet_id', $outlet->outlet_code)->orderBy('created_at')->get();
        $product = DB::table('product_outlets')
        ->leftJoin('product_category', 'product_category.category_code', 'product_outlets.category_id')
        ->orderBy('product_outlets.created_at')
        ->get();

        $datas = [
            'data' => $product
        ];

        return response()->json($datas);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_outletPending(): View
    {
        return view('master.user-owner.outlet.daftarOutletPending');
    }

    public function getDataoutletPending()
    {
        $data = DB::table('outlet_registers')
            ->select(
                'outlet_registers.id',
                'outlet_registers.outlet_code',
                'outlet_registers.outlet_name',
                'outlet_registers.slug',
                'outlet_registers.image_name',
                'outlet_registers.path',
                'outlet_registers.created_at',
                'users_registers.name',
                'users_registers.email',
                'brands_registers.brand_code',
                'brands_registers.brand_name',
                'brand_categories.brand_category_name',
            )
            ->leftJoin('users_registers', 'outlet_registers.user_id', 'users_registers.id')
            ->leftJoin('brands_registers', 'outlet_registers.brand_code', 'brands_registers.brand_code')
            ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
            ->where('outlet_registers.is_regis', 0)
            ->orderBy('outlet_registers.created_at', 'asc')
            ->get();
        
        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function getDataDetailOutletPending(Request $request)
    {
        return response()->json(Outlet_Register::find($request->id));
    }

    public function detail_OutletPending(Outlet_Register $outlet): View
    {
        return view('master.user-owner.outlet.detailOutletPending', [
            'outlet' => $outlet
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve_OutletPending(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction
            
            $request->validate([
                'id' => 'required'
            ]);

            $regis = Outlet_Register::find($request->id);

            // Cek user sudah teregistrasi atau belum
            $user = Users_Register::find($regis->user_id);
            if ($user->is_regis == 0) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Owner belum terdaftar'
                ]);
            }

            // Cek brand sudah teregistrasi atau belum
            $brand = Brands_Register::where('brand_code', $regis->brand_code)->first();
            if ($brand->is_regis == 0) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Brand belum terdaftar'
                ]);
            }

            Outlet::create([
                'user_id'       => $regis->user_id,
                'outlet_code'   => $regis->outlet_code,
                'outlet_name'   => $regis->outlet_name,
                'brand_code'    => $regis->brand_code,
                'slug'          => $regis->slug,
                'no_hp'         => $regis->no_hp,
                'image_name'    => $regis->image_name,
                'path'          => $regis->path,
                'website'       => $regis->website,
                'whatsapp'      => $regis->whatsapp,
                'facebook'      => $regis->facebook,
                'instagram'     => $regis->instagram,
                'tiktok'        => $regis->tiktok,
                'youtube'       => $regis->youtube,
                'is_active'     => 1,
                'created_at'    => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'    => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            $regis->update([
                'is_regis' => 1
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
            ]);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Outlet berhasil diapprove'
        ]);
    }

    public function reject_OutletPending(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id' => 'required'
            ]);

            $reject = Outlet_Register::find($request->id);

            $reject->update([
                'is_regis' => 2
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
            ]);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Outlets berhasil direject'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_outletReject()
    {
        return view('master.user-owner.outlet.daftarOutletReject');
    }

    public function getDataoutletReject()
    {
        $data = DB::table('outlet_registers')
            ->select(
                'outlet_registers.id',
                'outlet_registers.outlet_code',
                'outlet_registers.outlet_name',
                'outlet_registers.slug',
                'outlet_registers.image_name',
                'outlet_registers.path',
                'outlet_registers.created_at',
                'users_registers.name',
                'users_registers.email',
                'brands_registers.brand_code',
                'brands_registers.brand_name',
                'brand_categories.brand_category_name',
            )
            ->leftJoin('users_registers', 'outlet_registers.user_id', 'users_registers.id')
            ->leftJoin('brands_registers', 'outlet_registers.brand_code', 'brands_registers.brand_code')
            ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
            ->where('outlet_registers.is_regis', 2)
            ->orderBy('outlet_registers.created_at', 'asc')
            ->get();
        
        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }
}
