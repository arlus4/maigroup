<?php

namespace App\Http\Controllers\Admin\Admin_Manage_Owner;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Models\Ref_Provinsi;
use App\Models\Users_Detail;
use Illuminate\Http\Request;
use App\Models\Brand_Category;
use App\Models\ref_KuotaPoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class Admin_Tambah_OwnerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $getBrands    = Brand_Category::all();
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();

        return view('master.user-owner.tambahUserOwner', [
            'getBrands' => $getBrands,
            'getProvinsi' => $getProvinsi
        ]);
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

            $request->validate([
                'name'          => 'required',
                'username'      => 'required|unique:users_login',
                'email'         => 'required|email|unique:users_login',
                'password'      => 'required',
                'no_hp'         => 'required|unique:users_login',
                'nomor_ktp'     => 'required',
                'brand_name'    => 'required',
                'slug'          => 'required|unique:brands',
            ], [
                'username.unique' => 'Username Sudah Digunakan',
                'email.unique'    => 'Email Sudah Digunakan',
                'no_hp.unique'    => 'Nomor HP Sudah Digunakan',
            ]);

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar'        => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'avatar.mimes'  => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Store the uploaded image in storage/app/storage/avatar directory
                $imageName = Str::random(10) . '_' . $request->avatar->getClientOriginalName();

                $request->avatar->storeAs('user_owner/avatar/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/user_owner/avatar/' . $imageName;
            } else {
                $imageName = null;
                $imagePath = null;
            }

            $storeUser = User::create([
                'users_type'   => 2,
                'name'         => $request->name,
                'username'     => $request->username,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'no_hp'        => $request->no_hp,
                'brand_code'   => str_pad(mt_rand(0, 9999999999), 10, "0", STR_PAD_LEFT),
                'is_active'    => 1,
                'created_at'   => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'   => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            Users_Detail::create([
                'user_id'           => $storeUser->id,
                'avatar'            => $imageName,
                'path_avatar'       => $imagePath,
                'nomor_telfon'      => $request->no_hp,
                'nomor_ktp'         => $request->nomor_ktp,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'kelurahan'         => $request->kelurahan,
                'kecamatan'         => $request->kecamatan,
                'kota_kabupaten'    => $request->kotkab,
                'provinsi'          => $request->provinsi,
                'kode_pos'          => $request->kode_pos,
                'alamat_detail'     => $request->alamat_detail,
                'created_at'        => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'        => Carbon::now()->timezone('Asia/Jakarta')
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
            } else {
                $imageBrandName = null;
                $imageBrandPath = null;
            }

            Brand::create([
                'user_id'             => $storeUser->id,
                'brand_category_code' => $request->brand_category_code,
                'brand_code'          => $storeUser->brand_code,
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
                'brand_code'   => $storeUser->brand_code,
                'kuota_point'  => 0,
                'update_date'  => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction
        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        return redirect()->route('admin.admin_user_owner')->with('success', 'Berhasil Menambah User Owner');
    }
}
