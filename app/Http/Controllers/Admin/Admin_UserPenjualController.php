<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Users_Detail;
use App\Models\Ref_Project;
use App\Models\Ref_Provinsi;
use App\Models\ref_KotaKab;
use App\Models\ref_Kecamatan;
use App\Models\ref_Kelurahan;
use App\Models\ref_KodePos;
use App\Models\ref_KuotaPoint;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Admin_UserPenjualController extends Controller
{
    public function index(){
        $getData = User::select(
                'users_login.id as idUserLogin',
                'users_login.users_type',
                'users_login.name',
                'users_login.username',
                'users_login.email',
                'users_login.password',
                'users_login.no_hp',
                'users_login.is_active',
                'users_login.outlet_id',

                'users_details.id as idUserDetail',
                'users_details.user_id',
                'users_details.avatar',
                'users_details.nomor_ktp',
                'users_details.tanggal_lahir',
                'users_details.jenis_kelamin',
                'users_details.kelurahan',
                'users_details.kecamatan',
                'users_details.kota_kabupaten',
                'users_details.provinsi',
                'users_details.kode_pos',
                'users_details.alamat_detail',

                'outlets.id as idOutlet',
                'outlets.user_id',
                'outlets.nama_outlet',
                'outlets.slug',
                'outlets.outlet_id',

                'ref_kuota_point.id as idKuotaPoint',
                'ref_kuota_point.outlet_id',
                'ref_kuota_point.kuota_point',
            )
            ->leftJoin('users_details','users_details.user_id','=','users_login.id')
            ->leftJoin('outlets','outlets.user_id','=','users_login.id')
            ->leftJoin('ref_kuota_point','ref_kuota_point.outlet_id','=','outlets.outlet_id')
            ->where('users_type', 2)
            ->get();

        return view('master.user-penjual.daftarUserPenjual', compact('getData'));
    }

    public function create(Request $request){
        $getKategori  = Ref_Project::select('id','project_name','slug')->get();
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();

        return view('master.user-penjual.tambahUserPenjual', compact('getKategori','getProvinsi'));
    }

    public function outletSlug(Request $request)
    {
        $slug = SlugService::createSlug(Outlet::class, 'slug', $request->nama_outlet);

        return response()->json(['slug' => $slug]);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'name'          => 'required',
                'username'      => 'required',
                'email'         => 'required',
                'password'      => 'required',
                'no_hp'         => 'required',
                'nomor_ktp'     => 'required',
                'nama_outlet'   => 'required',
                'slug'          => 'required|unique:outlets',
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
                'outlet_id'    => mt_rand(0, 9999999999)
            ]);

            $storeUserDetail = Users_Detail::create([
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
            ]);

            $storeOutlet = Outlet::create([
                'user_id'      => $storeUser->id,
                'nama_outlet'  => $request->nama_outlet,
                'project_id'   => $request->project_id,
                'slug'         => $request->slug,
                'no_hp'        => $request->no_hp,
                'is_verified'  => 0,
                'outlet_id'    => $storeUser->outlet_id
            ]);

            ref_KuotaPoint::create([
                'outlet_id'    => $storeUser->outlet_id,
                'kuota_point'  => 0
            ]);

            DB::commit(); // Commit the transaction
        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->route('admin.admin_user_penjual')->with('error', 'Gagal Menambah User Penjual. Silakan coba lagi.');
        }
        return redirect()->route('admin.admin_user_penjual')->with('success', 'Berhasil Menambah User Penjual');
    }

    public function edit($username)
    {
        $getKategori  = Ref_Project::select('id','project_name','slug')->get();
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();

        $getData = User::select(
                'users_login.id as idUserLogin',
                'users_login.users_type',
                'users_login.name',
                'users_login.username',
                'users_login.email',
                'users_login.password',
                'users_login.no_hp',
                'users_login.outlet_id',

                'users_details.id as idUserDetail',
                'users_details.user_id',
                'users_details.avatar',
                'users_details.nomor_ktp',
                'users_details.tanggal_lahir',
                'users_details.jenis_kelamin',
                'users_details.kelurahan',
                'users_details.kecamatan',
                'users_details.kota_kabupaten',
                'users_details.provinsi',
                'users_details.kode_pos',
                'users_details.alamat_detail',

                'outlets.id as idOutlet',
                'outlets.user_id',
                'outlets.nama_outlet',
                'outlets.slug',
                'outlets.outlet_id',

                'ref_kuota_point.id as idKuotaPoint',
                'ref_kuota_point.outlet_id',
                'ref_kuota_point.kuota_point',

                'ref_project.id as idProject',
                'ref_project.project_name',

                'ref_propinsi.kode_propinsi',
                'ref_propinsi.nama_propinsi',

                'ref_kotakab.kode_kotakab',
                'ref_kotakab.nama_kotakab',
                
                'ref_kecamatan.kode_kecamatan',
                'ref_kecamatan.nama_kecamatan',

                'ref_kelurahan.kode_kelurahan',
                'ref_kelurahan.nama_kelurahan'
            )
            ->leftJoin('users_details','users_login.id','=','users_details.user_id')
            ->leftJoin('outlets','users_login.id','=','outlets.user_id')
            ->leftJoin('ref_kuota_point','outlets.outlet_id','=','ref_kuota_point.outlet_id')
            ->leftJoin('ref_project','outlets.project_id','=','ref_project.id')
            ->leftjoin('ref_propinsi', 'users_details.provinsi', '=', 'ref_propinsi.kode_propinsi')
            ->leftJoin('ref_kotakab','users_details.kota_kabupaten', '=', 'ref_kotakab.kode_kotakab')
            ->leftjoin('ref_kecamatan', 'users_details.kecamatan', '=', 'ref_kecamatan.kode_kecamatan')
            ->leftjoin('ref_kelurahan', 'users_details.kelurahan', '=', 'ref_kelurahan.kode_kelurahan')
            ->where('users_type', 2)
            ->where('username', $username)
            ->first();

        $getKotaKab      = ref_KotaKab::select('kode_kotakab','kode_propinsi','nama_kotakab')->where('kode_propinsi', $getData->kode_propinsi)->get();
        $getKecamatan    = ref_Kecamatan::select('kode_kecamatan','kode_kotakab','nama_kecamatan')->where('kode_kotakab', $getData->kode_kotakab)->get();
        $getKelurahan    = ref_Kelurahan::select('kode_kelurahan','kode_kecamatan','nama_kelurahan')->where('kode_kecamatan', $getData->kode_kecamatan)->get();
        $getKodePos      = ref_KodePos::select('kodepos','kode_kelurahan')->where('kode_kelurahan', $getData->kode_kelurahan)->get();

        return view('master.user-penjual.editUserPenjual', compact('getKategori', 'getProvinsi', 'getData', 'getKotaKab', 'getKecamatan', 'getKelurahan', 'getKodePos'));
    }

    public function update(Request $request)
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

    public function updateNotifications(Request $request, User $user)
    {
        $isActive = $request->enabled === 'true' ? 1 : 0;
        $user->update(['is_active' => $isActive]);

        return response()->json(['message' => 'Notification status updated.']);
    }
}
