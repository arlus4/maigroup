<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;
use App\Models\Outlet;
use App\Models\ref_KodePos;
use App\Models\ref_KotaKab;
use Illuminate\Support\Str;
use App\Models\Ref_Provinsi;
use Illuminate\Http\Request;
use App\Models\Alamat_Outlet;
use App\Models\ref_Kecamatan;
use App\Models\ref_Kelurahan;
use App\Models\ref_KuotaPoint;
use App\Models\Outlet_Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OutletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.outlets.listOutlet');
    }

    public function get_data_listOutlet()
    {
        $data = DB::table('outlets')
            ->select(
                'outlets.id',
                'outlets.outlet_id',
                'outlets.nama_outlet',
                'outlets.no_hp',
                'outlets.image_name',
                'outlets.is_verified',
                'outlets.slug',
                'outlet_categories.nama_category',
                'ref_kuota_point.kuota_point',
                'alamat_outlets.map_location',
            )
            ->leftJoin('outlet_categories', 'outlets.outlet_category', 'outlet_categories.id')
            ->leftJoin('ref_kuota_point', 'outlets.outlet_id', 'ref_kuota_point.outlet_id')
            ->leftJoin('alamat_outlets', 'outlets.outlet_id', 'alamat_outlets.outlet_id')
            ->where('outlets.user_id', Auth::user()->id)
            ->get();

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
    public function create()
    {
        $getKategori  = Outlet_Category::select('id','nama_category','slug')->get();
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();
        
        return view('owner.outlets.createOutlet',[
            'title' => 'Outlet Baru',
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
                'nama_outlet'       => 'required',
                'no_hp'             => 'required|unique:outlets',
                'slug'              => 'required|unique:outlets',
                'outlet_category'   => 'required',
            ], [
                'no_hp.unique'      => 'Nomor HP Sudah Digunakan',
            ]);

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar'        => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'avatar.mimes'  => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Store the uploaded image in storage/app/storage/avatar directory
                $imageName = Str::random(10) . '_' . $request->avatar->getClientOriginalName();

                $request->avatar->storeAs('outlet/avatar/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/outlet/avatar/' . $imageName;
            } else {
                $imageName = null;
                $imagePath = null;
            }

            $randomNumber = '';

            for ($i = 0; $i < 18; $i++) {
                $randomNumber .= mt_rand(0, 9);
            }

            $storeOutlet = Outlet::create([
                'user_id'           => Auth::user()->id,
                'outlet_id'         => $randomNumber,
                'nama_outlet'       => $request->nama_outlet,
                'outlet_category'   => $request->outlet_category,
                'slug'              => $request->slug,
                'no_hp'             => $request->no_hp,
                'image_name'        => $imageName,
                'path'              => $imagePath,
                'is_verified'       => 0,
                'created_at'        => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'        => Carbon::now()->timezone('Asia/Jakarta')
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
                'outlet_id'    => $storeOutlet->outlet_id,
                'kuota_point'  => 0,
                'update_date'  => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction
        }catch (\Exception $e){
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        return redirect('/owner/listOutlet')->with('success', 'Berhasil Menambah Outlet Baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outlet $outlet
     * @return \Illuminate\Http\Response
     */
    public function show($outlet)
    {
        $getData = DB::table('outlets')
                ->select(
                    // '*'
                    'outlets.outlet_id',
                    'outlets.nama_outlet',
                    'outlets.no_hp',
                    'outlet_categories.nama_category',
                    'alamat_outlets.kodepos',
                    'alamat_outlets.alamat_detail',
                    'ref_propinsi.nama_propinsi',
                    'ref_kotakab.nama_kotakab',
                    'ref_kecamatan.nama_kecamatan',
                    'ref_kelurahan.nama_kelurahan'

                )
                ->leftJoin('outlet_categories', 'outlets.outlet_category', 'outlet_categories.id')
                ->leftJoin('alamat_outlets', 'outlets.outlet_id', 'alamat_outlets.outlet_id')
                ->leftJoin('ref_propinsi', 'alamat_outlets.kode_propinsi', 'ref_propinsi.kode_propinsi')
                ->leftJoin('ref_kotakab', 'alamat_outlets.kode_kotakab', 'ref_kotakab.kode_kotakab')
                ->leftJoin('ref_kecamatan', 'alamat_outlets.kode_kecamatan', 'ref_kecamatan.kode_kecamatan')
                ->leftJoin('ref_kelurahan', 'alamat_outlets.kode_kelurahan', 'ref_kelurahan.kode_kelurahan')
                ->where('outlets.slug', $outlet)
                ->first();

        return response()->json($getData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outlet $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        $alamat_detail = Alamat_Outlet::where('outlet_id', $outlet->outlet_id)->first();
        $getKategori  = Outlet_Category::select('id','nama_category','slug')->get();
        $getProvinsi  = Ref_Provinsi::select('kode_propinsi','nama_propinsi')->get();
        $getKotaKab   = ref_KotaKab::select('kode_kotakab','kode_propinsi','nama_kotakab')->where('kode_propinsi', $alamat_detail->kode_propinsi)->get();
        $getKecamatan = ref_Kecamatan::select('kode_kecamatan','kode_kotakab','nama_kecamatan')->where('kode_kotakab', $alamat_detail->kode_kotakab)->get();
        $getKelurahan = ref_Kelurahan::select('kode_kelurahan','kode_kecamatan','nama_kelurahan')->where('kode_kecamatan', $alamat_detail->kode_kecamatan)->get();
        $getKodePos   = ref_KodePos::select('kodepos','kode_kelurahan')->where('kode_kelurahan', $alamat_detail->kode_kelurahan)->get();

        return view('owner.outlets.editOutlet',[
            'title' => "Ubah Outlet $outlet->nama_outlet",
            'outlet' => $outlet,
            'alamat' => $alamat_detail,
            'getKategori' => $getKategori,
            'getProvinsi' => $getProvinsi,
            'getKotaKab' => $getKotaKab,
            'getKecamatan' => $getKecamatan,
            'getKelurahan' => $getKelurahan,
            'getKodePos' => $getKodePos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Outlet $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Outlet $outlet, Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $outletId = $outlet->id; // Mendapatkan ID dari outlet yang akan diperbarui

            $request->validate([
                'nama_outlet'       => 'required',
                'no_hp'             => 'required|unique:outlets,no_hp,' . $outletId,
                'slug'              => 'required|unique:outlets,slug,' . $outletId,
                'outlet_category'   => 'required',
            ]);

            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'avatar.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);
                
                // Store the uploaded image in storage/app/storage/avatar directory
                $imageName = Str::random(10) . '_' . $request->avatar->getClientOriginalName();

                $request->avatar->storeAs('outlet/avatar/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/outlet/avatar/' . $imageName;

                // Delete Old Image
                if (Storage::disk('public')->exists('storage/outlet/avatar/' . $request->avatar)) {
                    Storage::disk('public')->delete('storage/outlet/avatar/' . $request->avatar);
                }
            } else {
                $imageName = $request->avatar;
                $imagePath = $request->path_avatar;
            }

            if ($outlet) {
                $outlet->update([
                    'nama_outlet'       => $request->nama_outlet,
                    'slug'              => $request->slug,
                    'no_hp'             => $request->no_hp,
                    'outlet_category'   => $request->outlet_category,
                    'image_name'        => $imageName,
                    'path'              => $imagePath,
                    'updated_at'        => Carbon::now()->timezone('Asia/Jakarta')
                ]);

                Alamat_Outlet::where('outlet_id', $outlet->outlet_id)->update([
                    'kode_propinsi'     => $request->provinsi_outlet,
                    'kode_kotakab'      => $request->kotkab_outlet,
                    'kode_kecamatan'    => $request->kecamatan_outlet,
                    'kode_kelurahan'    => $request->kelurahan_outlet,
                    'kodepos'           => $request->kode_pos_outlet,
                    'alamat_detail'     => $request->alamat_detail_outlet,
                    'map_location'      => $request->map_location_outlet,
                    'updated_at'        => Carbon::now()->timezone('Asia/Jakarta')
                ]);
            }

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        return redirect('/owner/listOutlet')->with('success', 'Berhasil Mengubah Outlet');
    }

    public function outletSlug(Request $request)
    {
        $slug = SlugService::createSlug(Outlet::class, 'slug', $request->nama_outlet);

        return response()->json(['slug' => $slug]);
    }

    public function validateNoHp(Request $request)
    {
        $noHp = $request->no_hp;
        $outletId = $request->outlet_id;
    
        // Mengecek apakah nomor HP sudah digunakan
        $outlet = Outlet::where('no_hp', $noHp)->first();
    
        // Inisialisasi $isUsed sebagai false
        $isUsed = false;
    
        // Jika outlet ditemukan
        if ($outlet) {
            // Jika outlet_id diberikan dan tidak sama dengan outlet yang ditemukan, atau jika outlet_id tidak diberikan sama sekali
            if ($outletId !== null) {
                if ($outlet->outlet_id != $outletId) {
                    // Artinya ada nomor HP yang sama terdaftar di bawah outlet yang berbeda
                    $isUsed = true;
                }
            } else {
                // Jika tidak ada outlet_id yang diberikan dan nomor HP ditemukan, anggap nomor HP tersebut sudah digunakan
                $isUsed = true;
            }
        }
        
        return response()->json(['isUsed' => $isUsed]);
    }
}
