<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Outlet;
use App\Models\ref_KodePos;
use App\Models\ref_KotaKab;
use App\Models\Ref_Project;
use Illuminate\Support\Str;
use App\Models\Ref_Provinsi;
use App\Models\Users_Detail;
use Illuminate\Http\Request;
use App\Models\Alamat_Outlet;
use App\Models\ref_Kecamatan;
use App\Models\ref_Kelurahan;
use App\Models\ref_KuotaPoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Svg\Tag\Rect;

class Admin_UserPenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('master.user-penjual.daftarUserPenjual');
    }

    public function getDataUserPenjual()
    {
        $data = DB::select("SELECT idUserLogin, name, username, email, no_hp, is_active, avatar, path_avatar, nama_outlet, slug, outlet_id, kuota_point 
                    FROM [maigroup].[dbo].[web.user_penjual_list] ()");

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $getKategori  = Ref_Project::select('id','project_name','slug')->get();
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();

        return view('master.user-penjual.tambahUserPenjual', [
            'getKategori' => $getKategori,
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
                'nama_outlet'   => 'required',
                'slug'          => 'required|unique:outlets',
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

                $request->avatar->storeAs('user_penjual/avatar/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/user_penjual/avatar/' . $imageName;
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
                'outlet_id'    => str_pad(mt_rand(0, 9999999999), 10, "0", STR_PAD_LEFT),
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

            $storeOutlet = Outlet::create([
                'user_id'      => $storeUser->id,
                'nama_outlet'  => $request->nama_outlet,
                'project_id'   => $request->project_id,
                'slug'         => $request->slug,
                'no_hp'        => $request->no_hp,
                'is_verified'  => 0,
                'outlet_id'    => $storeUser->outlet_id,
                'created_at'   => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'   => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            Alamat_Outlet::create([
                'outlet_id'         => $storeOutlet->outlet_id,
                'kode_propinsi'     => $request->provinsi_outlet,
                'kode_kotakab'      => $request->kotkab_outlet,
                'kode_kecamatan'    => $request->kecamatan_outlet,
                'kode_kelurahan'    => $request->kelurahan_outlet,
                'kodepos'           => $request->kode_pos_outlet,
                'alamat_detail'     => $request->alamat_detail_outlet,
                'map_location'      => $request->map_location_outlet,
                'created_at'        => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'        => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            ref_KuotaPoint::create([
                'outlet_id'    => $storeUser->outlet_id,
                'kuota_point'  => 0,
                'update_date'  => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction
        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->route('admin.admin_user_penjual')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        return redirect()->route('admin.admin_user_penjual')->with('success', 'Berhasil Menambah User Penjual');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($username): View
    {
        $getDatas = DB::select("SELECT idUserLogin, name, username, no_hp, email, avatar, path_avatar, nomor_ktp, tanggal_lahir, jenis_kelamin, 
                    alamat_detail, nama_propinsi, kode_propinsi, nama_kotakab, kode_kotakab, nama_kecamatan, kode_kecamatan, 
                    nama_kelurahan, kode_kelurahan, kode_pos, nama_outlet, slug, kuota_point, project_name
        FROM [maigroup].[dbo].[web.user_penjual_detail] ('" . $username . "')");
        $getData = $getDatas[0];
        
        $getKategori  = Ref_Project::select('id','project_name','slug')->get();
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();
        $getKotaKab      = ref_KotaKab::select('kode_kotakab','kode_propinsi','nama_kotakab')->where('kode_propinsi', $getData->kode_propinsi)->get();
        $getKecamatan    = ref_Kecamatan::select('kode_kecamatan','kode_kotakab','nama_kecamatan')->where('kode_kotakab', $getData->kode_kotakab)->get();
        $getKelurahan    = ref_Kelurahan::select('kode_kelurahan','kode_kecamatan','nama_kelurahan')->where('kode_kecamatan', $getData->kode_kecamatan)->get();
        $getKodePos      = ref_KodePos::select('kodepos','kode_kelurahan')->where('kode_kelurahan', $getData->kode_kelurahan)->get();

        return view('master.user-penjual.editUserPenjual', compact('getKategori', 'getProvinsi', 'getData', 'getKotaKab', 'getKecamatan', 'getKelurahan', 'getKodePos'));
    }

    public function show($username)
    {
        $getDatas = DB::select("SELECT idUserLogin, name, username, no_hp, email, avatar, path_avatar, nomor_ktp, tanggal_lahir, jenis_kelamin, 
                alamat_detail, nama_propinsi, kode_propinsi, nama_kotakab, kode_kotakab, nama_kecamatan, kode_kecamatan, 
                nama_kelurahan, kode_kelurahan, kode_pos, nama_outlet, slug, kuota_point, project_name
        FROM [maigroup].[dbo].[web.user_penjual_detail] ('" . $username . "')");
        $getData = $getDatas[0];
        
        return response()->json($getData);
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

            $request->validate([
                'name'          => 'required',
                'username'      => 'required',
                'email'         => 'required',
                'no_hp'         => 'required',
                'nomor_ktp'     => 'required',
                'nama_outlet'   => 'required',
                'slug'          => 'required',
            ]);

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'avatar.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);
                
                // Store the uploaded image in storage/app/storage/avatar directory
                $imageName = Str::random(10) . '_' . $request->avatar->getClientOriginalName();

                $request->avatar->storeAs('user_penjual/avatar/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/user_penjual/avatar/' . $imageName;

                // Delete Old Image
                if (Storage::disk('public')->exists('storage/user_penjual/avatar/' . $request->avatar)) {
                    Storage::disk('public')->delete('storage/user_penjual/avatar/' . $request->avatar);
                }
            } else {
                $imageName = $request->avatar;
                $imagePath = $request->path_avatar;
            }
            
            $user = User::where('id', $request->idUserLogin)->first();

            if ($user) {
                $user->update([
                    'users_type'    => 2,
                    'name'          => $request->name,
                    'username'      => $request->username,
                    'email'         => $request->email,
                    'no_hp'         => $request->no_hp
                ]);

                $userDetail = Users_Detail::updateOrCreate(
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
                    ]
                );

                $outlet = Outlet::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nama_outlet'  => $request->nama_outlet,
                        'project_id'   => $request->project_id,
                        'slug'         => $request->slug,
                        'no_hp'        => $request->no_hp,
                    ]
                );
            }

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->route('admin.admin_user_penjual')->with('error', 'Gagal Mengubah User Penjual. Silakan coba lagi');
        }
        return redirect()->route('admin.admin_user_penjual')->with('success', 'Berhasil Mengubah User Penjual');
    }
    
    public function outletSlug(Request $request)
    {
        $slug = SlugService::createSlug(Outlet::class, 'slug', $request->nama_outlet);

        return response()->json(['slug' => $slug]);
    }

    public function userSlug(Request $request)
    {
        $slug = SlugService::createSlug(User::class, 'username', $request->name);

        return response()->json(['username' => $slug]);
    }

    public function updateNotifications(Request $request, $user)
    {
        $isActive = $request->enabled === 'true' ? 1 : 0;
        User::where('id', $user)->update(['is_active' => $isActive]);

        return response()->json(['message' => 'Status Berhasil Diubah.']);
    }

    public function validateNoHp(Request $request)
    {
        $noHp = $request->no_hp;
        $isUsed = User::where('no_hp', $noHp)->exists();

        return response()->json(['isUsed' => $isUsed]);
    }

    public function validateUsername(Request $request)
    {
        $username = $request->username;
        $dipakai = User::where('username', $username)->exists();

        return response()->json(['dipakai' => $dipakai]);
    }

    public function validateEmail(Request $request)
    {
        $email = $request->email;
        $used = User::where('email', $email)->exists();

        return response()->json(['used' => $used]);
    }
}
