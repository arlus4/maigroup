<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Brand_Category;
use App\Models\ref_KuotaPoint;
use App\Models\Users_Register;
use App\Models\Brands_Register;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Konfirmasi_Pembayaran;
use App\Models\Outlet;
use App\Models\Point_Deposit;
use App\Models\Point_Deposit_Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Admin_BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_requestPoint()
    {
        return view('master.user-owner.brands.daftarRequestPoint');
    }

    public function getDataRequestPoint()
    {
        $data = DB::table('konfirmasi_pembayaran')
        ->select(
            'konfirmasi_pembayaran.id',
            'konfirmasi_pembayaran.invoice_no',
            'konfirmasi_pembayaran.point_request',
            'konfirmasi_pembayaran.jumlah_pembayaran',
            'konfirmasi_pembayaran.path_bukti_pembayaran',
            'konfirmasi_pembayaran.created_at',
            'brands.brand_code',
            'brands.brand_name',
            'brands.no_hp',
            'ref_bank.nama_bank',
            'ref_bank.nomor_rekening',
            'users_login.name',
        )
        ->join('brands','konfirmasi_pembayaran.brand_code', 'brands.brand_code')
        ->leftJoin('ref_bank', 'konfirmasi_pembayaran.id_bank_tokoseru', 'ref_bank.id')
        ->leftJoin('users_login', 'konfirmasi_pembayaran.user_request', 'users_login.id')
        ->where('konfirmasi_pembayaran.status', 0)
        ->orderBy('konfirmasi_pembayaran.created_at', 'asc')
        ->get();

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function getDataRequestLog()
    {
        $data = DB::table('konfirmasi_pembayaran')
        ->select(
            'konfirmasi_pembayaran.id',
            'konfirmasi_pembayaran.invoice_no',
            'konfirmasi_pembayaran.point_request',
            'konfirmasi_pembayaran.jumlah_pembayaran',
            'konfirmasi_pembayaran.path_bukti_pembayaran',
            'konfirmasi_pembayaran.status',
            'brands.brand_code',
            'brands.brand_name',
            'brands.no_hp',
            'ref_bank.nama_bank',
            'ref_bank.nomor_rekening',
            'users_login.name',
        )
        ->join('brands','konfirmasi_pembayaran.brand_code', 'brands.brand_code')
        ->leftJoin('ref_bank', 'konfirmasi_pembayaran.id_bank_tokoseru', 'ref_bank.id')
        ->leftJoin('users_login', 'konfirmasi_pembayaran.user_request', 'users_login.id')
        ->whereNot('konfirmasi_pembayaran.status', 0)
        ->orderBy('konfirmasi_pembayaran.created_at', 'asc')
        ->get();

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function detailRequestPoint($id)
    {
        $data = DB::table('konfirmasi_pembayaran')
        ->select(
            'konfirmasi_pembayaran.id',
            'konfirmasi_pembayaran.invoice_no',
            'konfirmasi_pembayaran.point_request',
            'konfirmasi_pembayaran.jumlah_pembayaran',
            'konfirmasi_pembayaran.path_bukti_pembayaran',
            'konfirmasi_pembayaran.created_at',
            'brands.brand_code',
            'brands.brand_name',
            'brands.no_hp',
            'ref_bank.nama_bank',
            'ref_bank.nomor_rekening',
            'users_login.name',
        )
        ->join('brands','konfirmasi_pembayaran.brand_code', 'brands.brand_code')
        ->leftJoin('ref_bank', 'konfirmasi_pembayaran.id_bank_tokoseru', 'ref_bank.id')
        ->leftJoin('users_login', 'konfirmasi_pembayaran.user_request', 'users_login.id')
        ->where('konfirmasi_pembayaran.id', $id)
        ->orderBy('konfirmasi_pembayaran.created_at', 'asc')
        ->first();

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function approveRequestPoint(Request $request)
    {
        try {
            DB::beginTransaction();

            $approve = Konfirmasi_Pembayaran::find($request->id);

            $deposit = Point_Deposit::where('brand_code', $approve->brand_code)->first();
            if ($deposit) {
                $deposit->update([
                    'point_current' => $deposit->point_current + $approve->point_request,
                    'update_by' => Auth::user()->id,
                    'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
                ]);
            } else {
                Point_Deposit::create([
                    'brand_code' => $approve->brand_code,
                    'point_current' => $approve->point_request,
                    'update_by' => Auth::user()->id,
                    'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
                    'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                ]);
            }

            Point_Deposit_Request::where('invoice_no', $approve->invoice_no)->update(['status' => 3]);
            
            $approve->update(['status' => 1]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Request berhasil diterima'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
            ]);
        }
    }

    public function rejectRequestPoint(Request $request)
    {
        try {
            DB::beginTransaction();

            $reject = Konfirmasi_Pembayaran::find($request->id);

            Point_Deposit_Request::where('invoice_no', $reject->invoice_no)->update(['status' => 4]);

            $reject->update(['status' => 2]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Request berhasil ditolak'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_brandActive(): View
    {
        return view('master.user-owner.brands.daftarBrandActive');
    }

    public function getDatabrandActive()
    {
        $data = DB::table('brands')
            ->select(
                'brands.id',
                'brands.brand_code',
                'brands.brand_name',
                'brands.slug',
                'brands.brand_description',
                'brands.brand_image',
                'brands.brand_image_path',
                'brands.created_at',
                'brand_categories.brand_category_name',
                'users_login.name',
                'users_login.email'
            )
            ->leftJoin('users_login', 'brands.user_id', 'users_login.id')
            ->leftJoin('brand_categories', 'brands.brand_category_code', 'brand_categories.brand_category_code')
            ->where('brands.is_active', 1)
            ->orderBy('brands.created_at', 'asc')
            ->get();

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function detailBrands(Brand $brand)
    {
        $user = User::where('id', $brand->user_id)->first();
        $category = Brand_Category::select('brand_category_name')->where('brand_category_code', $brand->brand_category_code)->first();
        $outlet = Outlet::where('brand_code', $brand->brand_code)->get();
        return view('master.user-owner.brands.detailUserBrands', [
            'user' => $user,
            'brand' => $brand,
            'categories' => $category,
            'outlets' => $outlet
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_brandPending(): View
    {
        return view('master.user-owner.brands.daftarBrandPending');
    }

    public function getDatabrandPending()
    {
        $data = DB::table('brands_registers')
            ->select(
                'brands_registers.id',
                'brands_registers.brand_code',
                'brands_registers.brand_name',
                'brands_registers.slug',
                'brands_registers.brand_description',
                'brands_registers.brand_image',
                'brands_registers.brand_image_path',
                'brands_registers.created_at',
                'brand_categories.brand_category_name',
                DB::raw('COALESCE(users_registers.name, users_login.name) as name'),
                DB::raw('COALESCE(users_registers.email, users_login.email) as email')
            )
            ->leftJoin('users_registers', 'brands_registers.user_id', '=', 'users_registers.id')
            ->leftJoin('users_login', function($join) {
                $join->on('brands_registers.user_id', '=', 'users_login.id');
                $join->whereNull('users_registers.id');
            })
            ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
            ->where('brands_registers.is_regis', 0)
            ->orderBy('brands_registers.created_at', 'asc')
            ->get();

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function detail_BrandPending(Brands_Register $brand_regis)
    {
        $user = Users_Register::where('id', $brand_regis->user_id)->first();
        $category = Brand_Category::select('brand_category_name')->where('brand_category_code', $brand_regis->brand_category_code)->first();
        return view('master.user-owner.brands.detailBrandPending', [
            'brand' => $brand_regis,
            'user' => $user,
            'categories' => $category
        ]);
    }

    public function approve_BrandPending(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction
            
            $request->validate([
                'id' => 'required'
            ]);

            $regis = Brands_Register::find($request->id);

            // Cek user sudah teregistrasi atau belum
            $user = Users_Register::find($regis->user_id);

            if ($user->is_regis == 0) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Owner belum terdaftar'
                ]);
            }

            Brand::create([
                'user_id'               => $regis->user_id,
                'brand_category_code'   => $regis->brand_category_code,
                'brand_code'            => $regis->brand_code,
                'brand_name'            => $regis->brand_name,
                'slug'                  => $regis->slug,
                'no_hp'                 => $regis->whatsapp,
                'brand_description'     => $regis->brand_description,
                'brand_image'           => $regis->brand_image,
                'brand_image_path'      => $regis->brand_image_path,
                'website'               => $regis->website,
                'whatsapp'              => $regis->whatsapp,
                'facebook'              => $regis->facebook,
                'instagram'             => $regis->instagram,
                'tiktok'                => $regis->tiktok,
                'youtube'               => $regis->youtube,
                'is_active'             => 1,
                'created_at'            => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'            => Carbon::now()->timezone('Asia/Jakarta')
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
            'message' => 'Brands berhasil diapprove'
        ]);
    }

    public function getDataDetailBrandPending(Request $request)
    {
        return response()->json(Brands_Register::find($request->id));
    }

    public function reject_BrandPending(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id' => 'required'
            ]);

            Brands_Register::find($request->id)->update(['is_regis' => 2]);

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
            'message' => 'Brands berhasil direject'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_brandReject(): View
    {
        return view('master.user-owner.brands.daftarBrandReject');
    }

    public function getDatabrandReject()
    {
        $data = DB::table('brands_registers')
            ->select(
                'brands_registers.id',
                'brands_registers.brand_code',
                'brands_registers.brand_name',
                'brands_registers.slug',
                'brands_registers.brand_description',
                'brands_registers.brand_image',
                'brands_registers.brand_image_path',
                'brands_registers.created_at',
                'brand_categories.brand_category_name',
                DB::raw('COALESCE(users_registers.name, users_login.name) as name'),
                DB::raw('COALESCE(users_registers.email, users_login.email) as email')
            )
            ->leftJoin('users_registers', 'brands_registers.user_id', '=', 'users_registers.id')
            ->leftJoin('users_login', function($join) {
                $join->on('brands_registers.user_id', '=', 'users_login.id');
                $join->whereNull('users_registers.id');
            })
            ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
            ->where('brands_registers.is_regis', 2)
            ->orderBy('brands_registers.created_at', 'asc')
            ->get();

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit_New_Brands(Brand $brand)
    {
        $user = User::where('id', $brand->user_id)->first();
        $getBrands = Brand_Category::all();
        return view('master.user-owner.brands.editUserBrands', [
            'user' => $user,
            'brand' => $brand,
            'categories' => $getBrands
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update_New_Brands (Request $request, Brand $brand)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'brand_category_code'   => 'required',
                'brand_name'            => 'required',
                'slug'                  => 'required',
                'no_hp_brand'           => 'required'
            ]);

            if ($request->hasFile('logo_brand')) {
                $request->validate([
                    'logo_brand'        => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'logo_brand.mimes'  => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Store the uploaded image in storage/app/storage/logo_brand directory
                $imageBrandName = Str::random(10) . '_' . $request->logo_brand->getClientOriginalName();

                $request->logo_brand->storeAs('user_owner/logo_brand/', $imageBrandName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imageBrandPath = 'storage/user_owner/logo_brand/' . $imageBrandName;

                // Delete Old Image
                if (Storage::disk('public')->exists('storage/user_owner/logo_brand/' . $request->brand_image)) {
                    Storage::disk('public')->delete('storage/user_owner/logo_brand/' . $request->brand_image);
                }
            } else {
                $imageBrandName = $request->brand_image;
                $imageBrandPath = $request->brand_image_path;
            }

            $brand->update([
                'brand_category_code' => $request->brand_category_code,
                'brand_name'          => $request->brand_name,
                'slug'                => $request->slug,
                'no_hp'               => $request->no_hp_brand,
                'brand_description'   => $request->brand_description,
                'brand_image'         => $imageBrandName,
                'brand_image_path'    => $imageBrandPath,
                'website'             => $request->website_brand,
                'whatsapp'            => $request->whatsapp_brand,
                'facebook'            => $request->facebook_brand,
                'instagram'           => $request->instagram_brand,
                'tiktok'              => $request->tiktok_brand,
                'youtube'             => $request->youtube_brand,
                'updated_at'          => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->route('admin.admin_user_owner')->with('error', 'Gagal Mengubah Brand. Silakan coba lagi : ' . $th->getMessage());
        }
        return redirect()->route('admin.admin_detail_user_owner', ['username' => $request->username])->with('success', 'Berhasil Mengubah Brand');
    }


    // CEK LAGI
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_New_Brands($username)
    {
        $user = User::where('username', $username)->first();
        $getBrands = Brand_Category::all();
        return view('master.user-owner.brands.tambahUserBrands', [
            'user' => $user,
            'getBrands' => $getBrands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_New_Brands(Request $request)
    {
        try {
            $storeUser = User::where('username', $request->username)->first();

            DB::beginTransaction(); // Begin Transaction

            if ($request->hasFile('logo_brand')) {
                $request->validate([
                    'logo_brand'        => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'logo_brand.mimes'  => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Store the uploaded image in storage/app/storage/logo_brand directory
                $imageBrandName = Str::random(10) . '_' . $request->logo_brand->getClientOriginalName();

                $request->logo_brand->storeAs('user_owner/logo_brand/', $imageBrandName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imageBrandPath = 'storage/user_owner/logo_brand/' . $imageBrandName;
            } else {
                $imageBrandName = null;
                $imageBrandPath = null;
            }

            Brand::create([
                'user_id'             => $storeUser->id,
                'brand_category_code' => $request->brand_category_code,
                'brand_code'          => str_pad(mt_rand(0, 9999999999), 10, "0", STR_PAD_LEFT),
                'brand_name'          => $request->brand_name,
                'slug'                => $request->slug,
                'no_hp_brand'         => $request->no_hp,
                'brand_description'   => $request->brand_description,
                'brand_image'         => $imageBrandName,
                'brand_image_path'    => $imageBrandPath,
                'website'             => $request->website_brand,
                'whatsapp'            => $request->whatsapp_brand,
                'facebook'            => $request->facebook_brand,
                'instagram'           => $request->instagram_brand,
                'tiktok'              => $request->tiktok_brand,
                'youtube'             => $request->youtube_brand,
                'is_verified'         => 1,
                'is_active'           => 1,
                'created_at'   => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'   => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            ref_KuotaPoint::create([
                'brand_code'   => str_pad(mt_rand(0, 9999999999), 10, "0", STR_PAD_LEFT),
                'kuota_point'  => 0,
                'update_date'  => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction

            return redirect()->route('admin.admin_detail_user_owner', ['username' => $request->username])->with('success', 'Berhasil Menambah Brand');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
