<?php

namespace App\Http\Controllers\Admin\Admin_Manage_Owner;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Users_Detail;
use Illuminate\Http\Request;
use App\Models\Users_Register;
use App\Models\Brands_Register;
use App\Models\ref_KuotaPoint;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Admin_Pending_OwnerController extends Controller
{
    /**
     * Display the index page for pending user owners.
     *
     * @return View
     */
    public function index_userPending(): View
    {
        // Return the view 'master.user-owner.user-pending.daftarUserPending'
        return view('master.user-owner.user-pending.daftarUserPending');
    }
    
    /**
     * Retrieve pending user data and return it as a JSON response.
     *
     * @return JsonResponse
     */
    public function getDataPending(): JsonResponse
    {
        // Retrieve data from the 'Users_Register' table for pending users
        $users = Users_Register::select(
            'id', 'name', 'email', 'no_hp', 'nomor_ktp', 'is_regis', 'created_at'
        )
        ->where('is_regis', 0) // Filter rows where 'is_regis' column is 0 (pending)
        ->orderBy('created_at', 'asc') // Order the results by 'created_at' column in ascending order
        ->get(); // Execute the query and retrieve the result set

        // Construct the JSON response data
        $datas = [
            'data' => $users
        ];

        // Return the JSON response
        return response()->json($datas);
    }

    /**
     * Retrieve the detailed data of a pending user and return it as a JSON response.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getDataDetailUserPending(Request $request): JsonResponse
    {
        // Retrieve the detailed data of the pending user with the provided ID
        $user = Users_Register::find($request->id);

        // Return the detailed user data as a JSON response
        return response()->json($user);
    }

    /**
     * Approve a pending user and create corresponding records in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function approve_UserPending(Request $request): JsonResponse
    {
        // Retrieve the pending user from the 'Users_Register' table
        $user_register = Users_Register::find($request->id);

        // Retrieve the brand registration data for the pending user
        $brand_register = Brands_Register::where('user_id', $request->id)->first();

        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'username' => 'required|unique:users_login',
                'password' => 'required',
            ], [
                'username.unique' => 'Username has already been taken.',
            ]);

            // Create a new user in the 'users_login' table
            $storeUser = User::create([
                'users_type'   => 2,
                'name'         => $user_register->name,
                'username'     => $request->username,
                'email'        => $user_register->email,
                'password'     => Hash::make($request->password),
                'register_id'  => $request->id,
                'no_hp'        => $user_register->no_hp,
                'brand_code'   => str_pad(mt_rand(0, 9999999999), 10, "0", STR_PAD_LEFT),
                'is_active'    => 1,
                'created_at'   => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'   => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            // Create a new record in the 'users_detail' table
            Users_Detail::create([
                'user_id'           => $storeUser->id,
                'nomor_telfon'      => $user_register->no_hp,
                'nomor_ktp'         => $user_register->nomor_ktp,
                'tanggal_lahir'     => $user_register->tanggal_lahir,
                'jenis_kelamin'     => $user_register->jenis_kelamin,
                'kelurahan'         => $user_register->kelurahan,
                'kecamatan'         => $user_register->kecamatan,
                'kota_kabupaten'    => $user_register->kotkab,
                'provinsi'          => $user_register->provinsi,
                'kode_pos'          => $user_register->kode_pos,
                'alamat_detail'     => $user_register->alamat_detail,
                'created_at'        => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'        => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            // Create a new brand record in the 'brands' table
            Brand::create([
                'user_id'             => $storeUser->id,
                'brand_category_code' => $brand_register->brand_category_code,
                'brand_code'          => $brand_register->brand_code,
                'brand_name'          => $brand_register->brand_name,
                'slug'                => $brand_register->slug,
                'no_hp_brand'         => $user_register->no_hp,
                'brand_description'   => $brand_register->brand_description,
                'brand_image'         => $brand_register->brand_image,
                'brand_image_path'    => $brand_register->brand_image_path,
                'website'             => $brand_register->website,
                'whatsapp'            => $brand_register->whatsapp,
                'facebook'            => $brand_register->facebook,
                'instagram'           => $brand_register->instagram,
                'tiktok'              => $brand_register->tiktok,
                'youtube'             => $brand_register->youtube,
                'is_verified'         => 1,
                'is_active'           => 1,
                'created_at'          => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'          => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            // Create a new record in the 'ref_kuota_point' table
            ref_KuotaPoint::create([
                'brand_code'   => $brand_register->brand_code,
                'kuota_point'  => 0,
                'update_date'  => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            // Update the 'is_regis' column of the pending user in the 'Users_Register' table
            $user_register->update([
                'is_regis' => 1
            ]);

            // Update the 'is_regis' column of the brand registration in the 'Brands_Register' table
            $brand_register->update([
                'is_regis' => 1
            ]);

            // Kirim Pesan Notifikasi Approve ke Email Owner
            Mail::raw('Account Anda Berhasil di Verifikasi Oleh Admin', function ($message) use ($user_register) {
                $message->to($user_register->email)->subject('Verification Successful');
            });

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Owner has been successfully approved.'
        ]);
    }

    /**
     * Reject a pending user and update the corresponding records in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reject_UserPending(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id' => 'required'
            ]);

            // Update the 'is_regis' column of the pending user in the 'Users_Register' table to 2 (rejected)
            Users_Register::find($request->id)->update(['is_regis' => 2]);

            // Update the 'is_regis' column of the brand registration in the 'Brands_Register' table to 2 (rejected)
            Brands_Register::where('user_id', $request->id)->update(['is_regis' => 2]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $th->getMessage()
            ]);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Owner has been successfully rejected.'
        ]);
    }

    /**
     * Display the detail page for a pending user.
     *
     * @param Users_Register $id
     * @return View
     */
    public function detail_userPending(Users_Register $id): View
    {
        // Retrieve the brands associated with the pending user
        $getBrands = Brands_Register::select('brand_name', 'brand_code', 'slug')->where('user_id', $id->id)->get();
    
        // Return the view 'master.user-owner.user-pending.detailUserPending' with the retrieved data
        return view('master.user-owner.user-pending.detailUserPending', [
            'getData' => $id,
            'getBrands' => $getBrands
        ]);
    }
}
