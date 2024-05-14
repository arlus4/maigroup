<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ref_KodePos;
use App\Models\ref_KotaKab;
use App\Models\Ref_Project;
use Illuminate\Support\Str;
use App\Models\Ref_Provinsi;
use App\Models\Users_Detail;
use Illuminate\Http\Request;
use App\Models\ref_Kecamatan;
use App\Models\ref_Kelurahan;
use App\Models\ref_KuotaPoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Brand_Category;
use App\Models\Brands_Register;
use App\Models\Users_Register;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Admin_UserOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('master.user-owner.daftarUserOwner');
    }

    public function getDataUserOwner()
    {
        $data = DB::select("SELECT idUserLogin, name, username, email, no_hp, is_active, avatar, path_avatar
                    FROM [maigroup].[dbo].[web.user_owner_list] ()");

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_userPending() : View
    {
        return view('master.user-owner.user-pending.daftarUserPending');
    }

    public function getDataPending()
    {
        $users = Users_Register::select(
            'id',
            'name',
            'email',
            'no_hp',
            'nomor_ktp',
            'is_regis',
            'created_at'
        )
        ->where('is_regis', 0)
        ->orderBy('created_at', 'asc')
        ->get();

        $datas = [
            'data' => $users
        ];
    
        return response()->json($datas);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail_userPending(Users_Register $id): View
    {
        $getBrands = Brands_Register::select('brand_name', 'brand_code', 'slug')->where('user_id', $id->id)->get();
        return view('master.user-owner.user-pending.detailUserPending', [
            'getData' => $id,
            'getBrands' => $getBrands
        ]);
    }

    public function approve_UserPending(Request $request)
    {
        $user_register  = Users_Register::find($request->id);
        $brand_register = Brands_Register::where('user_id', $request->id)->first();

        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'username'      => 'required|unique:users_login',
                'password'      => 'required',
            ], [
                'username.unique' => 'Username Sudah Digunakan',
            ]);

            $storeUser = User::create([
                'users_type'   => 2,
                'name'         => $user_register->name,
                'username'     => $request->username,
                'email'        => $user_register->email,
                'password'     => Hash::make($request->password),
                'no_hp'        => $user_register->no_hp,
                'brand_code'   => str_pad(mt_rand(0, 9999999999), 10, "0", STR_PAD_LEFT),
                'is_active'    => 1,
                'created_at'   => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'   => Carbon::now()->timezone('Asia/Jakarta')
            ]);

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

            ref_KuotaPoint::create([
                'brand_code'   => $brand_register->brand_code,
                'kuota_point'  => 0,
                'update_date'  => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            $user_register->update([
                'is_regis' => 1
            ]);

            $brand_register->update([
                'is_regis' => 1
            ]);

            DB::commit(); // Commit the transaction

        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi Kesalahan: ' . $e->getMessage()
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Owner berhasil diapprove'
        ]);
    }

    public function getDataDetailUserPending(Request $request)
    {
        return response()->json(Users_Register::find($request->id));
    }

    public function reject_UserPending(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id' => 'required'
            ]);

            Users_Register::find($request->id)->update(['is_regis' => 2]);
            Brands_Register::where('user_id', $request->id)->update(['is_regis' => 2]);

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
            'message' => 'Owner berhasil direject'
        ]);
    }

    public function index_userReject()
    {
        return view('master.user-owner.user-pending.daftarUserReject');
    }

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

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($username): View
    {
        $getDatas = DB::select("SELECT
                                    idUserLogin, name, username, no_hp, email, avatar, path_avatar, nomor_ktp,
                                    tanggal_lahir, jenis_kelamin, alamat_detail, nama_propinsi, kode_propinsi,
                                    nama_kotakab, kode_kotakab, nama_kecamatan, kode_kecamatan, nama_kelurahan,
                                    kode_kelurahan, kode_pos
                                FROM [maigroup].[dbo].[web.user_owner_detail] ('" . $username . "')");
        $getData = $getDatas[0];
        
        $getKategori  = Ref_Project::select('id','project_name','slug')->get();
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();
        $getKotaKab   = ref_KotaKab::select('kode_kotakab','kode_propinsi','nama_kotakab')->where('kode_propinsi', $getData->kode_propinsi)->get();
        $getKecamatan = ref_Kecamatan::select('kode_kecamatan','kode_kotakab','nama_kecamatan')->where('kode_kotakab', $getData->kode_kotakab)->get();
        $getKelurahan = ref_Kelurahan::select('kode_kelurahan','kode_kecamatan','nama_kelurahan')->where('kode_kecamatan', $getData->kode_kecamatan)->get();
        $getKodePos   = ref_KodePos::select('kodepos','kode_kelurahan')->where('kode_kelurahan', $getData->kode_kelurahan)->get();

        return view('master.user-owner.editUserOwner', compact('getKategori', 'getProvinsi', 'getData', 'getKotaKab', 'getKecamatan', 'getKelurahan', 'getKodePos'));
    }

    public function show($username)
    {
        $getDatas = DB::select("SELECT
                                    idUserLogin, username, name, no_hp, email, avatar, path_avatar, nomor_ktp,
                                    tanggal_lahir, jenis_kelamin, alamat_detail, nama_propinsi,
                                    nama_kotakab, nama_kecamatan, nama_kelurahan, kode_pos
                                FROM [maigroup].[dbo].[web.user_owner_detail] ('" . $username . "')"
                             );
        $getData = $getDatas[0];
        
        $getBrands = Brand::select('brand_name', 'brand_code', 'slug')->where('user_id', $getData->idUserLogin)->get();
        // dd($getBrands);

        return view('master.user-owner.detailUserOwner', [
            'username' => $username,
            'getData' => $getData,
            'getBrands' => $getBrands
        ]);
    }

    public function getDataBrandOwner($username)
    {
        $getDatas = DB::select("SELECT idUserLogin FROM [maigroup].[dbo].[web.user_owner_detail] ('" . $username . "')");
        $getData = $getDatas[0];
        $brand = Brand::where('user_id', $getData->idUserLogin)->get();

        $datas = [
            'data' => $brand
        ];

        return response()->json($datas);
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

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'avatar.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);
                
                // Store the uploaded image in storage/app/storage/avatar directory
                $imageName = Str::random(10) . '_' . $request->avatar->getClientOriginalName();

                $request->avatar->storeAs('user_owner/avatar/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/user_owner/avatar/' . $imageName;

                // Delete Old Image
                if (Storage::disk('public')->exists('storage/user_owner/avatar/' . $request->avatar_exists)) {
                    Storage::disk('public')->delete('storage/user_owner/avatar/' . $request->avatar_exists);
                }
            } else {
                $imageName = $request->avatar_exists;
                $imagePath = $request->path_avatar_exists;
            }
            
            $user = User::where('id', $request->idUserLogin)->first();

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

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
        return redirect()->route('admin.admin_user_owner')->with('success', 'Berhasil Mengubah User Owner');
    }

    // public function showManageBrands($username)
    // {
    //     $getDatas = DB::select("SELECT *
    //                 FROM [maigroup].[dbo].[web.user_owner_detail] ('" . $username . "')");
    //     $getData = $getDatas[0];

    //     return view('master.user-owner.brands.daftarUserBrands',[
    //         'getData' => $getData
    //     ]);
    // }
    
    public function brandSlug(Request $request)
    {
        $slug = SlugService::createSlug(Brand::class, 'slug', $request->brand_name);

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
        $noHp   = $request->no_hp;
        $isUsed = User::where('no_hp', $noHp)->exists();

        return response()->json(['isUsed' => $isUsed]);
    }

    public function validate_Edit_NoHp(Request $request)
    {
        $noHp = $request->no_hp;
        $UserId = $request->id;
        
        // Mengecek apakah nomor HP sudah digunakan
        $user = User::where('no_hp', $noHp)->first();
    
        // Inisialisasi $isUsed sebagai false
        $isUsed = false;
    
        // Jika user ditemukan
        if ($user) {
            // Jika id diberikan dan tidak sama dengan user yang ditemukan, atau jika id tidak diberikan sama sekali
            if ($UserId !== null) {
                if ($user->id != $UserId) {
                    // Artinya ada nomor HP yang sama terdaftar di bawah user yang berbeda
                    $isUsed = true;
                }
            } else {
                // Jika tidak ada id yang diberikan dan nomor HP ditemukan, anggap nomor HP tersebut sudah digunakan
                $isUsed = false;
            }
        }
        
        return response()->json(['isUsed' => $isUsed]);
    }

    public function validateNoHp_brand(Request $request)
    {
        $noHp   = $request->no_hp;
        $isUsed = Brand::where('no_hp', $noHp)->exists();

        return response()->json(['isUsed' => $isUsed]);
    }

    public function validate_Edit_NoHp_brand(Request $request)
    {
        $noHp = $request->no_hp;
        $brandId = $request->brand_Code;
        
        // Mengecek apakah nomor HP sudah digunakan
        $brand = Brand::where('no_hp', $noHp)->first();
    
        // Inisialisasi $isUsed sebagai false
        $isUsed = false;
    
        // Jika brand ditemukan
        if ($brand) {
            // Jika brand_Code diberikan dan tidak sama dengan brand yang ditemukan, atau jika brand_Code tidak diberikan sama sekali
            if ($brandId !== null) {
                if ($brand->brand_code != $brandId) {
                    // Artinya ada nomor HP yang sama terdaftar di bawah brand yang berbeda
                    $isUsed = true;
                }
            } else {
                // Jika tidak ada brand_Code yang diberikan dan nomor HP ditemukan, anggap nomor HP tersebut sudah digunakan
                $isUsed = false;
            }
        }
        
        return response()->json(['isUsed' => $isUsed]);
    }

    public function validateUsername(Request $request)
    {
        $username = $request->username;
        $dipakai = User::where('username', $username)->exists();

        return response()->json(['dipakai' => $dipakai]);
    }

    public function validate_Edit_Username(Request $request)
    {
        $username = $request->username;
        $UserId = $request->id;
        
        // Mengecek apakah username sudah digunakan
        $user = User::where('username', $username)->first();
    
        // Inisialisasi $dipakai sebagai false
        $dipakai = false;
    
        // Jika user ditemukan
        if ($user) {
            // Jika id diberikan dan tidak sama dengan user yang ditemukan, atau jika id tidak diberikan sama sekali
            if ($UserId !== null) {
                if ($user->id != $UserId) {
                    // Artinya ada username yang sama terdaftar di bawah user yang berbeda
                    $dipakai = true;
                }
            } else {
                // Jika tidak ada id yang diberikan dan username ditemukan, anggap username tersebut sudah digunakan
                $dipakai = false;
            }
        }
        
        return response()->json(['dipakai' => $dipakai]);
    }

    public function validateEmail(Request $request)
    {
        $email = $request->email;
        $used = User::where('email', $email)->exists();

        return response()->json(['used' => $used]);
    }

    public function validate_Edit_Email(Request $request)
    {
        $email = $request->email;
        $UserId = $request->id;
        
        // Mengecek apakah email sudah digunakan
        $user = User::where('email', $email)->first();
    
        // Inisialisasi $used sebagai false
        $used = false;
    
        // Jika user ditemukan
        if ($user) {
            // Jika id diberikan dan tidak sama dengan user yang ditemukan, atau jika id tidak diberikan sama sekali
            if ($UserId !== null) {
                if ($user->id != $UserId) {
                    // Artinya ada email yang sama terdaftar di bawah user yang berbeda
                    $used = true;
                }
            } else {
                // Jika tidak ada id yang diberikan dan email ditemukan, anggap email tersebut sudah digunakan
                $used = false;
            }
        }
        
        return response()->json(['used' => $used]);
    }
}
