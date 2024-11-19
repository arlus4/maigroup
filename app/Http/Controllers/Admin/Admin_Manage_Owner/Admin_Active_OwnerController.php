<?php

namespace App\Http\Controllers\Admin\Admin_Manage_Owner;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Outlet;
use App\Models\ref_KotaKab;
use App\Models\Ref_Project;
use App\Models\Ref_Provinsi;
use App\Models\Users_Detail;
use App\Models\ref_KodePos;
use App\Models\ref_Kelurahan;
use App\Models\ref_Kecamatan;
use App\Models\Users_Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Brands_Register;

class Admin_Active_OwnerController extends Controller
{
    // begin::Home
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('master.user-owner.daftarUserOwner');
    }
    
    /**
     * Retrieves data of user owners from the database and returns it as a JSON response.
     *
     * @return JsonResponse
     */
    public function getDataUserOwner(): JsonResponse
    {
        // Retrieve data from the 'users_login' table
        $data = DB::table('users_login')
        ->select(
            'users_login.id as idUserLogin', // Alias for the 'id' column in the 'users_login' table
            'users_login.users_type', // 'users_type' column in the 'users_login' table
            'users_login.name', // 'name' column in the 'users_login' table
            'users_login.username', // 'username' column in the 'users_login' table
            'users_login.email', // 'email' column in the 'users_login' table
            'users_login.no_hp', // 'no_hp' column in the 'users_login' table
            'users_login.is_active', // 'is_active' column in the 'users_login' table
            'users_details.id as idUserDetail', // Alias for the 'id' column in the 'users_details' table
            'users_details.avatar', // 'avatar' column in the 'users_details' table
            'users_details.path_avatar', // 'path_avatar' column in the 'users_details' table
            DB::raw('UPPER(permissions.name) as permissions'), // Alias for the 'name' column in the 'permissions' table, converted to uppercase
        )
        ->leftJoin('users_details', 'users_login.id', 'users_details.user_id') // Perform a left join between 'users_login' and 'users_details' tables based on 'id' and 'user_id' columns respectively
        ->leftJoin('model_has_permissions', 'users_login.id', 'model_has_permissions.model_id') // Perform a left join between 'users_login' and 'model_has_permissions' tables based on 'id' and 'model_id' columns respectively
        ->leftJoin('permissions', 'model_has_permissions.permission_id', 'permissions.id') // Perform a left join between 'model_has_permissions' and 'permissions' tables based on 'permission_id' and 'id' columns respectively
        ->where('users_login.users_type', 2) // Filter rows where 'users_type' column is equal to 2
        ->where('users_login.is_active', 1) // Filter rows where 'is_active' column is equal to 1
        ->get(); // Execute the query and retrieve the result set

        // Construct the JSON response data
        $datas = [
            'data' => $data
        ];
    
        // Return the JSON response
        return response()->json($datas);
    }

    /**
     * Update the notifications status for a user.
     *
     * @param Request $request
     * @param int $user
     * @return JsonResponse
     */
    public function updateNotifications(Request $request, $user)
    {
        // Check if the 'enabled' parameter is set to 'true'
        // If true, set $isActive to 1, otherwise set it to 0
        $isActive = $request->enabled === 'true' ? 1 : 0;

        // Update the 'is_active' column of the user with the given ID
        User::where('id', $user)->update(['is_active' => $isActive]);

        // Return a JSON response with a success message
        return response()->json(['message' => 'Status Berhasil Diubah.']);
    }
    // end::Home

    // begin::Detail
    /**
     * Retrieves and displays detailed information about a user owner.
     *
     * @param string $username
     * @return \Illuminate\View\View
     */
    public function show($username)
    {
        // Retrieve data for the user owner from the 'users_login' table
        $getData = DB::table('users_login')
            ->select([
                DB::raw('MAX(users_login.id) AS idUserLogin'), // Alias for the 'id' column in the 'users_login' table
                'users_login.username', // 'username' column in the 'users_login' table
                DB::raw('MAX(users_login.name) AS name'), // Alias for the 'name' column in the 'users_login' table
                DB::raw('MAX(users_login.no_hp) AS no_hp'), // Alias for the 'no_hp' column in the 'users_login' table
                DB::raw('MAX(users_login.email) AS email'), // Alias for the 'email' column in the 'users_login' table
                DB::raw('MAX(users_details.id) AS idUserDetail'), // Alias for the 'id' column in the 'users_details' table
                DB::raw('MAX(users_details.avatar) AS avatar'), // Alias for the 'avatar' column in the 'users_details' table
                DB::raw('CASE
                            WHEN MAX(CAST(users_details.path_avatar AS VARCHAR(MAX))) IS NULL
                            THEN \'Gambar Ditemukan\'
                            ELSE MAX(CAST(users_details.path_avatar AS VARCHAR(MAX)))
                        END AS path_avatar'), // Alias for the 'path_avatar' column in the 'users_details' table, with a conditional statement
                DB::raw('MAX(users_details.nomor_ktp) AS nomor_ktp'), // Alias for the 'nomor_ktp' column in the 'users_details' table
                DB::raw('MAX(users_details.tanggal_lahir) AS tanggal_lahir'), // Alias for the 'tanggal_lahir' column in the 'users_details' table
                DB::raw('MAX(users_details.jenis_kelamin) AS jenis_kelamin'), // Alias for the 'jenis_kelamin' column in the 'users_details' table
                DB::raw('MAX(users_details.kode_pos) AS kode_pos'), // Alias for the 'kode_pos' column in the 'users_details' table
                DB::raw('MAX(ref_propinsi.kode_propinsi) AS kode_propinsi'), // Alias for the 'kode_propinsi' column in the 'ref_propinsi' table
                DB::raw('MAX(ref_propinsi.nama_propinsi) AS nama_propinsi'), // Alias for the 'nama_propinsi' column in the 'ref_propinsi' table
                DB::raw('MAX(ref_kotakab.kode_kotakab) AS kode_kotakab'), // Alias for the 'kode_kotakab' column in the 'ref_kotakab' table
                DB::raw('MAX(ref_kotakab.nama_kotakab) AS nama_kotakab'), // Alias for the 'nama_kotakab' column in the 'ref_kotakab' table
                DB::raw('MAX(ref_kecamatan.kode_kecamatan) AS kode_kecamatan'), // Alias for the 'kode_kecamatan' column in the 'ref_kecamatan' table
                DB::raw('MAX(ref_kecamatan.nama_kecamatan) AS nama_kecamatan'), // Alias for the 'nama_kecamatan' column in the 'ref_kecamatan' table
                DB::raw('MAX(ref_kelurahan.kode_kelurahan) AS kode_kelurahan'), // Alias for the 'kode_kelurahan' column in the 'ref_kelurahan' table
                DB::raw('MAX(ref_kelurahan.nama_kelurahan) AS nama_kelurahan'), // Alias for the 'nama_kelurahan' column in the 'ref_kelurahan' table
                DB::raw('CASE
                            WHEN MAX(CAST(users_details.alamat_detail AS VARCHAR(MAX))) IS NULL
                            THEN \'Alamat Tidak Ditemukan\'
                            ELSE MAX(CAST(users_details.alamat_detail AS VARCHAR(MAX)))
                        END AS alamat_detail'), // Alias for the 'alamat_detail' column in the 'users_details' table, with a conditional statement
                DB::raw('MAX(UPPER(permissions.name)) as permissions'), // Alias for the 'name' column in the 'permissions' table, converted to uppercase
                DB::raw('MAX(permissions.description) as description_permissions') // Alias for the 'description' column in the 'permissions' table
            ])
            ->leftJoin('users_details', 'users_login.id', '=', 'users_details.user_id') // Perform a left join between 'users_login' and 'users_details' tables based on 'id' and 'user_id' columns respectively
            ->leftJoin('model_has_permissions', 'users_login.id', 'model_has_permissions.model_id') // Perform a left join between 'users_login' and 'model_has_permissions' tables based on 'id' and 'model_id' columns respectively
            ->leftJoin('permissions', 'model_has_permissions.permission_id', 'permissions.id') // Perform a left join between 'model_has_permissions' and 'permissions' tables based on 'permission_id' and 'id' columns respectively
            ->leftJoin('ref_propinsi', 'users_details.provinsi', '=', 'ref_propinsi.kode_propinsi') // Perform a left join between 'users_details' and 'ref_propinsi' tables based on 'provinsi' and 'kode_propinsi' columns respectively
            ->leftJoin('ref_kotakab', 'users_details.kota_kabupaten', '=', 'ref_kotakab.kode_kotakab') // Perform a left join between 'users_details' and 'ref_kotakab' tables based on 'kota_kabupaten' and 'kode_kotakab' columns respectively
            ->leftJoin('ref_kecamatan', 'users_details.kecamatan', '=', 'ref_kecamatan.kode_kecamatan') // Perform a left join between 'users_details' and 'ref_kecamatan' tables based on 'kecamatan' and 'kode_kecamatan' columns respectively
            ->leftJoin('ref_kelurahan', 'users_details.kelurahan', '=', 'ref_kelurahan.kode_kelurahan') // Perform a left join between 'users_details' and 'ref_kelurahan' tables based on 'kelurahan' and 'kode_kelurahan' columns respectively
            ->where('users_login.users_type', '2') // Filter rows where 'users_type' column is equal to '2'
            ->where('users_login.username', $username) // Filter rows where 'username' column is equal to the provided username
            ->groupBy('users_login.username') // Group the result by 'username' column
        ->first(); // Retrieve the first row of the result set

        // Retrieve brands associated with the user owner
        $getBrands = Brand::select('brand_name', 'brand_code', 'slug', 'is_active')->where('user_id', $getData->idUserLogin)->paginate(5);

        // Retrieve register brands associated with the user owner
        $getBrandsRegister = Brands_Register::select('id', 'brand_name', 'brand_code', 'slug', 'is_regis')->where('user_id', $getData->idUserLogin)->paginate(5);

        // Count the number of brands associated with the user owner
        $countBrands = Brand::where('user_id', $getData->idUserLogin)->count();

        // Retrieve outlets associated with the user owner
        $getOutlets = Outlet::where('user_id', $getData->idUserLogin)->paginate(5);

        // Count the number of outlets associated with the user owner
        $countOutlets = Outlet::where('user_id', $getData->idUserLogin)->count();

        // Retrieve employees associated with the user owner
        $getEmployee = DB::table('pegawai')
            ->select('pegawai.id', 'pegawai.name', 'pegawai.username', 'pegawai.no_hp', 'pegawai.email')
            ->leftJoin('outlets', 'pegawai.outlet_code', 'outlets.outlet_code')
            ->where('outlets.user_id', $getData->idUserLogin)
        ->paginate(5);

        // Count the number of employees associated with the user owner
        $countEmployee = DB::table('pegawai')
            ->leftJoin('outlets', 'pegawai.outlet_code', 'outlets.outlet_code')
            ->where('outlets.user_id', $getData->idUserLogin)
        ->count();

        // Retrieve user sessions for the user owner
        $getSessions = Users_Session::where('user_id', $getData->idUserLogin)->get();

        // Format the last_activity timestamp for each session
        foreach ($getSessions as $session) {
            $session->last_activity = Carbon::createFromTimestamp($session->last_activity)->diffForHumans();
        }

        // Return the view with the retrieved data
        return view('master.user-owner.detailUserOwner', [
            'username'          => $username,
            'getData'           => $getData,
            'getBrands'         => $getBrands,
            'getBrandsRegister' => $getBrandsRegister,
            'countBrands'       => $countBrands,
            'getOutlets'        => $getOutlets,
            'countOutlets'      => $countOutlets,
            'getEmployee'       => $getEmployee,
            'countEmployee'     => $countEmployee,
            'sessions'          => $getSessions
        ]);
    }

    /**
     * Update the phone number for the owner.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatenoHPOwner(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    => 'required',
                'no_hp' => 'required',
            ]);

            // Check if the phone number is already used by another user
            $used = User::where('no_hp', $request->no_hp)->exists();
            if ($used) {
                return redirect()->back()->with('error', 'The phone number is already used. Please use a different phone number.');
            }

            // Update the phone number
            $update_nohp = User::findOrFail($request->id);
            $update_nohp->update(['no_hp' => $request->no_hp]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'An error occurred: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Phone number successfully updated.');
    }

    /**
     * Update the email for the owner.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateEmailOwner(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id'    => 'required',
                'email' => 'required|email',
            ]);

            // Check if the email is already used by another user
            $used = User::where('email', $request->email)->exists();
            if ($used) {
                return redirect()->back()->with('error', 'Email is already in use. Please use a different email.');
            }

            // Update the email
            $update_email = User::findOrFail($request->id);
            $update_email->update(['email' => $request->email]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'An error occurred: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Email successfully updated.');
    }

    /**
     * Update the password for the owner.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePasswordOwner(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'current_password'  => 'required',
                'new_password'      => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
                'confirm_password'  => 'required|same:new_password',
            ]);

            $user = User::findOrFail($request->id);

            // Check if the current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['Current password is incorrect.'],
                ]);
            }

            // Update the password
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'An error occurred: ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Password successfully updated.');
    }

    /**
     * Delete the session for the owner.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteSessionOwner(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id' => 'required',
            ]);

            // Delete the session for the owner with the provided ID
            Users_Session::where('user_id', $request->id)->delete();

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
            'message' => 'Session successfully deleted'
        ]);
    }
    // end::Detail

    // begin::Edit
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($username): View
    {
        // Retrieve data from the 'web.user_owner_detail' stored procedure using the provided username
        $getData = DB::table('users_login')
        ->select(
            'users_login.id as idUserLogin',
            'users_login.username',
            'users_login.name',
            'users_login.no_hp',
            'users_login.email',
            'users_details.id as idUserDetail',
            'users_details.avatar',
            'users_details.path_avatar',
            'users_details.nomor_ktp',
            'users_details.tanggal_lahir',
            'users_details.jenis_kelamin',
            'users_details.kode_pos',
            'users_details.alamat_detail',
            'ref_propinsi.kode_propinsi',
            'ref_propinsi.nama_propinsi',
            'ref_kotakab.kode_kotakab',
            'ref_kotakab.nama_kotakab',
            'ref_kecamatan.kode_kecamatan',
            'ref_kecamatan.nama_kecamatan',
            'ref_kelurahan.kode_kelurahan',
            'ref_kelurahan.nama_kelurahan',
        )
        ->leftJoin('users_details', 'users_details.user_id', 'users_login.id')
        ->leftJoin('ref_propinsi', 'ref_propinsi.kode_propinsi', 'users_details.provinsi')
        ->leftJoin('ref_kotakab', 'ref_kotakab.kode_kotakab', 'users_details.kota_kabupaten')
        ->leftJoin('ref_kecamatan', 'ref_kecamatan.kode_kecamatan', 'users_details.kecamatan')
        ->leftJoin('ref_kelurahan', 'ref_kelurahan.kode_kelurahan', 'users_details.kelurahan')
        ->where('username', $username)
        ->first();
    
        // Retrieve data from the 'Ref_Project' table to populate the category dropdown
        $getKategori  = Ref_Project::select('id','project_name','slug')->get();
    
        // Retrieve data from the 'Ref_Provinsi' table to populate the province dropdown
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();
    
        // Retrieve data from the 'ref_KotaKab' table based on the selected province to populate the city/district dropdown
        $getKotaKab   = ref_KotaKab::select('kode_kotakab','kode_propinsi','nama_kotakab')->where('kode_propinsi', $getData->kode_propinsi)->get();
    
        // Retrieve data from the 'ref_Kecamatan' table based on the selected city/district to populate the sub-district dropdown
        $getKecamatan = ref_Kecamatan::select('kode_kecamatan','kode_kotakab','nama_kecamatan')->where('kode_kotakab', $getData->kode_kotakab)->get();
    
        // Retrieve data from the 'ref_Kelurahan' table based on the selected sub-district to populate the village dropdown
        $getKelurahan = ref_Kelurahan::select('kode_kelurahan','kode_kecamatan','nama_kelurahan')->where('kode_kecamatan', $getData->kode_kecamatan)->get();
    
        // Retrieve data from the 'ref_KodePos' table based on the selected village to populate the postal code dropdown
        $getKodePos   = ref_KodePos::select('kodepos','kode_kelurahan')->where('kode_kelurahan', $getData->kode_kelurahan)->get();
    
        // Return the 'editUserOwner' view with the retrieved data
        return view('master.user-owner.editUserOwner', compact('getKategori', 'getProvinsi', 'getData', 'getKotaKab', 'getKecamatan', 'getKelurahan', 'getKodePos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction
    
            $validasi = User::find($request->idUserLogin);
    
            $request->validate([
                'name'          => 'required',
                'username'      => 'required|unique:users_login,username,' . $validasi->id,
                'email'         => 'required|email|unique:users_login,email,' . $validasi->id,
                'no_hp'         => 'required|unique:users_login,no_hp,' . $validasi->id,
            ]);
    
            // Check if an avatar file is uploaded
            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'avatar.mimes' => 'The file format must be JPG, JPEG, or PNG.', // Error message
                ]);
    
                // Store the uploaded image in storage/app/public/user_owner/avatar directory
                $imageName = Str::random(10) . '_' . $request->avatar->getClientOriginalName();
                $request->avatar->storeAs('user_owner/avatar/', $imageName, 'public');
    
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/user_owner/avatar/' . $imageName;
    
                // Delete the old image
                if (Storage::disk('public')->exists('storage/user_owner/avatar/' . $request->avatar_exists)) {
                    Storage::disk('public')->delete('storage/user_owner/avatar/' . $request->avatar_exists);
                }
            } else {
                $imageName = $request->avatar_exists;
                $imagePath = $request->path_avatar_exists;
            }
    
            $user = User::where('id', $request->idUserLogin)->first();
    
            // Check if a new password is provided
            if ($request->password != NULL) {
                $password = Hash::make($request->password);
            } else {
                $password = $user->password;
            }
    
            if ($user) {
                $user->update([
                    'users_type'    => 2,
                    'name'          => $request->name,
                    'username'      => $request->username,
                    'email'         => $request->email,
                    'password'      => $password,
                    'no_hp'         => $request->no_hp,
                    'updated_at'    => Carbon::now()->timezone('Asia/Jakarta')
                ]);
    
                Users_Detail::updateOrCreate(
                    ['user_id' => $user->id],
                    [
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
                        'updated_at'        => Carbon::now()->timezone('Asia/Jakarta')
                    ]
                );
            }
    
            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception
    
            return redirect()->back()->with('error', 'An error occurred: ' . $th->getMessage());
        }
        return redirect()->route('admin.admin_user_owner')->with('success', 'Successfully updated User Owner');
    }
    // end::Edit
}
