<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Banner;
use App\Models\ref_KotaKab;
use Illuminate\Support\Str;
use App\Models\Ref_Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class Admin_BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $banner = Banner::select(
            'banner_promo.id',
            'banner_promo.banner_code',
            'banner_promo.banner_name',
            'banner_promo.description',
            'banner_promo.image_name',
            'banner_promo.path',
            'banner_promo.isall',
            'banner_promo.kota_id',
            'banner_promo.start_date',
            'banner_promo.end_date',
            'banner_promo.created_date',

            'ref_kotakab.nama_kotakab'
        )
        ->leftjoin('ref_kotakab', 'ref_kotakab.kode_kotakab', '=', 'banner_promo.kota_id')
        ->where('isall', 1)
        ->get();

        return view('master.banner.daftarBanner',[
            'banners' => $banner
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $getProvinsi = Ref_Provinsi::select('kode_propinsi', 'nama_propinsi')->get();
        return view('master.banner.tambahBanner', [
            'title' => "Banner Promo",
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
                'banner_code'   => 'required',
                'banner_name'   => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'description'   => 'required'
            ]);

            if ($request->hasFile('image_name')) {
                $request->validate([
                    'image_name' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'image_name.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Store the uploaded image in storage/app/storage/image directory
                $imageName = Str::random(10) . '_' . $request->image_name->getClientOriginalName();

                $request->image_name->storeAs('banner/image/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/banner/image/' . $imageName;
            }

            if ($request->national == null) {
                $provinsi = $request->provinsi;
                $kotkab = $request->kotkab;
            } else {
                $provinsi = null;
                $kotkab = null;
            }

            Banner::create([
                'banner_code'   => $request->banner_code,
                'banner_name'   => $request->banner_name,
                'description'   => $request->description,
                'image_name'    => $imageName,
                'path'          => $imagePath,
                'isall'         => '1',
                'kota_id'       => $kotkab,
                'kode_propinsi' => $provinsi,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'created_date'  => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menambah Banner  : ' . $th->getMessage());
        }
        return redirect()->route('admin.admin_banner')->with('success', 'Berhasil Menambah Banner');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function get_detail_banner(Banner $banner)
    {
        $detail = Banner::select(
                'banner_promo.banner_code',
                'banner_promo.banner_name',
                'banner_promo.description',
                'banner_promo.image_name',
                'banner_promo.path',
                'banner_promo.isall',
                'banner_promo.kota_id',
                'banner_promo.start_date',
                'banner_promo.end_date',
                'banner_promo.created_date',

                'ref_kotakab.nama_kotakab'
            )
            ->leftjoin('ref_kotakab', 'ref_kotakab.kode_kotakab', '=', 'banner_promo.kota_id')
            ->where('banner_promo.id', $banner->id)
            ->first();

        $datas = [
            'data' => $detail
        ];

        if ($datas) {
            return response()->json($datas);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner): View
    {
        $detail = Banner::select(
            'banner_promo.id',
            'banner_promo.banner_code',
            'banner_promo.banner_name',
            'banner_promo.description',
            'banner_promo.image_name',
            'banner_promo.path',
            'banner_promo.isall',
            'banner_promo.kode_propinsi',
            'banner_promo.kota_id',
            'banner_promo.start_date',
            'banner_promo.end_date',
            'banner_promo.created_date',

            'ref_kotakab.nama_kotakab',
            'ref_propinsi.nama_propinsi'
        )
        ->leftjoin('ref_propinsi', 'ref_propinsi.kode_propinsi', '=', 'banner_promo.kode_propinsi')
        ->leftjoin('ref_kotakab', 'ref_kotakab.kode_kotakab', '=', 'banner_promo.kota_id')
        ->where('banner_promo.id', $banner->id)
        ->first();

        $getProvinsi = Ref_Provinsi::select('kode_propinsi', 'nama_propinsi')->get();
        $kotakab = ref_KotaKab::select('kode_kotakab','kode_propinsi','nama_kotakab')->where('kode_propinsi', $detail->kode_propinsi)->get();
        
        return view('master.banner.editBanner', [
            'title' => "Banner Promo $banner->banner_code - $banner->banner_name",
            'banner' => $detail,
            'getProvinsi' => $getProvinsi,
            'kotakabs' => $kotakab
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'banner_code'   => 'required',
                'banner_name'   => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'description'   => 'required'
            ]);

            if ($request->hasFile('image_name')) {
                $request->validate([
                    'image_name' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'image_name.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);
                
                // Delete the old image if it exists
                if ($banner->image_name && Storage::disk('public')->exists($banner->image_name)) {
                    Storage::disk('public')->delete($banner->path);
                }

                // Store the uploaded image in storage/app/storage/image directory
                $imageName = Str::random(10) . '_' . $request->image_name->getClientOriginalName();

                $request->image_name->storeAs('banner/image/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/banner/image/' . $imageName;
            } else {
                $imageName = $banner->image_name;
                $imagePath = $banner->path;
            }

            if ($request->national == null) {
                $provinsi = $request->provinsi;
                $kotkab = $request->kotkab;
            } else {
                $provinsi = null;
                $kotkab = null;
            }

            $banner->update([
                'banner_code'   => $request->banner_code,
                'banner_name'   => $request->banner_name,
                'description'   => $request->description,
                'image_name'    => $imageName,
                'path'          => $imagePath,
                'kota_id'       => $kotkab,
                'kode_propinsi' => $provinsi,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date
            ]);
            
            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Mengubah Banner  : ' . $th->getMessage());
        }
        return redirect()->route('admin.admin_banner')->with('success', 'Berhasil Mengubah Banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            // Menghapus gambar dari storage
            Storage::delete('banner/image/' . $banner->image_name);
        
            // Menghapus banner dari database
            $banner->delete();
        
            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception
            
            Log::error($th); // Log the exception for debugging
            
            return redirect()->back()->with('error', 'Gagal Menghapus Banner  : ' . $th->getMessage());
        }
        return redirect()->back()->with('success', 'Banner berhasil dihapus.');
    }
}
