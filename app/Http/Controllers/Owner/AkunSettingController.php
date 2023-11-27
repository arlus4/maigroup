<?php

namespace App\Http\Controllers\owner;

use App\Models\User;
use App\Models\ref_KotaKab;
use App\Models\ref_KodePos;
use App\Models\Ref_Provinsi;
use Illuminate\Support\Str;
use App\Models\Users_Detail;
use Illuminate\Http\Request;
use App\Models\ref_Kecamatan;
use App\Models\ref_Kelurahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AkunSettingController extends Controller
{
    public function index($username){
        if (Auth::user()->username === $username) {
            // Jika nama pengguna cocok, lanjutkan ke tindakan yang diinginkan

            $dataUser = User::select(
                'users_login.name',
                'users_login.username',
                'users_login.no_hp',
                'users_login.email',

                'users_details.avatar',
                'users_details.path_avatar',
                'users_details.nomor_ktp',
                'users_details.jenis_kelamin',
            )
            ->leftJoin('users_details','users_login.id','=','users_details.user_id')
            ->where('users_login.username', Auth::user()->username)
            ->first();

            return view('owner.profile.pengaturanAkun', compact('dataUser'));
        } else {
            // Jika nama pengguna tidak cocok, lempar pesan error menggunakan session
            return redirect()->back()->with('toastr_error', 'Halaman tidak ditemukan, 404!');
        }
    }

    public function editProfile($username){
        $getProvinsi = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();
        $getData = User::select(
            'users_login.id as idUserLogin',
            'users_login.name',
            'users_login.username',
            'users_login.no_hp',
            'users_login.email',

            'users_details.avatar',
            'users_details.path_avatar',
            'users_details.nomor_ktp',
            'users_details.tanggal_lahir',
            'users_details.jenis_kelamin',
            'users_details.kelurahan',
            'users_details.kecamatan',
            'users_details.kota_kabupaten',
            'users_details.provinsi',
            'users_details.kode_pos',
            'users_details.alamat_detail',

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
        ->leftjoin('ref_propinsi', 'users_details.provinsi', '=', 'ref_propinsi.kode_propinsi')
        ->leftJoin('ref_kotakab','users_details.kota_kabupaten', '=', 'ref_kotakab.kode_kotakab')
        ->leftjoin('ref_kecamatan', 'users_details.kecamatan', '=', 'ref_kecamatan.kode_kecamatan')
        ->leftjoin('ref_kelurahan', 'users_details.kelurahan', '=', 'ref_kelurahan.kode_kelurahan')
        ->where('users_login.users_type', 2)
        ->where('users_login.username', Auth::user()->username)
        ->first();

        $getKotaKab      = ref_KotaKab::select('kode_kotakab','kode_propinsi','nama_kotakab')->where('kode_propinsi', $getData->kode_propinsi)->get();
        $getKecamatan    = ref_Kecamatan::select('kode_kecamatan','kode_kotakab','nama_kecamatan')->where('kode_kotakab', $getData->kode_kotakab)->get();
        $getKelurahan    = ref_Kelurahan::select('kode_kelurahan','kode_kecamatan','nama_kelurahan')->where('kode_kecamatan', $getData->kode_kecamatan)->get();
        $getKodePos      = ref_KodePos::select('kodepos','kode_kelurahan')->where('kode_kelurahan', $getData->kode_kelurahan)->get();

        return view('owner.profile.editProfile', compact('getData','getProvinsi', 'getKotaKab', 'getKecamatan', 'getKelurahan', 'getKodePos'));
    }

    public function updateProfile(Request $request, $username){
        try {
            DB::beginTransaction();
            
            // Validasi data dasar
            $request->validate([
                'name' => 'required',
                'nomor_ktp' => 'required',
                'no_hp' => 'required',
            ]);
    
            $imageName = $request->input('avatar_lama'); // Gunakan gambar lama sebagai default
            $imagePath = 'storage/user_penjual/avatar/' . $imageName;
    
            if ($request->hasFile('avatar')) {
                // Validasi gambar baru tanpa 'required'
                $request->validate(['avatar' => 'mimes:jpeg,png,jpg,gif']);
            
                // Simpan gambar baru
                $imageName = Str::random(10) . '_' . $request->avatar->getClientOriginalName();
                $request->avatar->storeAs('user_penjual/avatar/', $imageName, 'public');
                $imagePath = 'storage/user_penjual/avatar/' . $imageName;
            
                // Hapus gambar lama jika ada dan berbeda dengan gambar baru
                $oldImagePath = public_path($request->input('avatar_lama'));
                if ($request->input('avatar_lama') && file_exists($oldImagePath) && $oldImagePath != $imagePath) {
                    unlink($oldImagePath);
                }
            } else {
                // Jika tidak ada gambar yang diupload, gunakan gambar lama
                $imageName = $request->input('avatar_lama'); // Pastikan nilai ini ada di database
                $imagePath = $request->input('avatar_lama') ? 'storage/user_penjual/avatar/' . $request->input('avatar_lama') : null;
            }
    
            $user = User::where('id', $request->idUserLogin)->first();

            if ($user) {
                $user->update([
                    'name'          => $request->name,
                    'username'      => $request->username,
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
            }
    
            DB::commit();
            return redirect()->route('owner.owner_pengaturan_akun', ['username' => Auth::user()->username])->with('toastr_success', 'Berhasil Mengubah Profile');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return redirect()->back()->with('error', 'Gagal Mengubah Profile  : ' . $th->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', Password::defaults()],
        ]);
    
        $user = $request->user();
    
        // Periksa apakah current_password sesuai dengan password yang ada dalam database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }
    
        $user->update([
            'password' => Hash::make($request->password),
        ]);
    
        // hasil respon ada di signin-methods.js
        return back();
    }
}
