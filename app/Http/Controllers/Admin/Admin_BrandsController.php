<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Brand_Category;
use App\Models\ref_KuotaPoint;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Brands_Register;
use Illuminate\Support\Facades\Storage;

class Admin_BrandsController extends Controller
{
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
        return view('master.brands.active.editUserBrands', [
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

            Brands_Register::create([
                'user_id'             => $storeUser->id,
                'brand_category_code' => $request->brand_category_code,
                'brand_code'          => str_pad(mt_rand(0, 9999999999), 10, "0", STR_PAD_LEFT),
                'brand_name'          => $request->brand_name,
                'slug'                => $request->slug,
                'brand_description'   => $request->brand_description,
                'brand_image'         => $imageBrandName,
                'brand_image_path'    => $imageBrandPath,
                'website'             => $request->website_brand,
                'whatsapp'            => $request->whatsapp_brand,
                'facebook'            => $request->facebook_brand,
                'instagram'           => $request->instagram_brand,
                'tiktok'              => $request->tiktok_brand,
                'youtube'             => $request->youtube_brand,
                'is_regis'            => 1,
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
