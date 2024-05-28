<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Admin_OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_outletActive()
    {
        return view('master.user-owner.outlet.daftarOutletActive');
    }

    public function getDataoutletActive()
    {
        $data = DB::table('outlets')
            ->select(
                'outlets.id',
                'outlets.outlet_code',
                'outlets.outlet_name',
                'outlets.slug',
                'outlets.image_name',
                'outlets.path',
                'outlets.created_at',
                'users_login.name',
                'users_login.email',
                'brands.brand_code',
                'brands.brand_name',
                'brand_categories.brand_category_name',
            )
            ->leftJoin('users_login', 'outlets.user_id', 'users_login.id')
            ->leftJoin('brands', 'outlets.brand_code', 'brands.brand_code')
            ->leftJoin('brand_categories', 'brands.brand_category_code', 'brand_categories.brand_category_code')
            ->where('outlets.is_active', 1)
            ->orderBy('outlets.created_at', 'asc')
            ->get();
        
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
    public function index_outletPending()
    {
        return view('master.user-owner.outlet.daftarOutletPending');
    }

    public function getDataoutletPending()
    {
        $data = DB::table('outlet_registers')
            ->select(
                'outlet_registers.id',
                'outlet_registers.outlet_code',
                'outlet_registers.outlet_name',
                'outlet_registers.slug',
                'outlet_registers.image_name',
                'outlet_registers.path',
                'outlet_registers.created_at',
                'users_registers.name',
                'users_registers.email',
                'brands_registers.brand_code',
                'brands_registers.brand_name',
                'brand_categories.brand_category_name',
            )
            ->leftJoin('users_registers', 'outlet_registers.user_id', 'users_registers.id')
            ->leftJoin('brands_registers', 'outlet_registers.brand_code', 'brands_registers.brand_code')
            ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
            ->where('outlet_registers.is_regis', 0)
            ->orderBy('outlet_registers.created_at', 'asc')
            ->get();
        
        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request): RedirectResponse
    // {
    //     try {
    //         DB::beginTransaction(); // Begin Transaction

    //         $request->validate([
    //             'nama_category' => 'required|string|max:255',
    //             'slug'          => 'required|string|max:255|unique:outlet_categories',
    //         ]);

    //         Outlet_Category::create([
    //             'nama_category'=> $request->nama_category,
    //             'slug'         => $request->slug,
    //             'created_at' => Carbon::now('Asia/Jakarta'),
    //             'updated_at' => Carbon::now('Asia/Jakarta')
    //         ]);

    //         DB::commit(); // Commit the transaction
    //     } catch (\Exception $e) {
    //         DB::rollback(); // Rollback the transaction in case of an exception

    //         Log::error($e); // Log the exception for debugging

    //         return redirect()->back()->with('error', 'Gagal Menambah Kategori Outlet. Silakan coba lagi.');
    //     }
    //     return redirect()->back()->with('success', 'Berhasil Menambah Kategori Outlet!');
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Outlet_Category  $outlet_id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Outlet_Category $outlet_id)
    // {
    //     try {
    //         DB::beginTransaction(); // Begin Transaction

    //         $request->validate([
    //             'nama_category_edit' => 'required|string|max:255',
    //             'slug_edit'          => 'required|string|max:255|unique:outlet_categories,slug,' . $outlet_id->id,
    //         ]);

    //         Outlet_Category::findOrFail($request->idKategoriOutlet)->update([
    //             'nama_category' => $request->nama_category_edit,
    //             'slug'          => $request->slug_edit,
    //             'updated_at'    => Carbon::now('Asia/Jakarta')
    //         ]);
            
    //         DB::commit(); // Commit the transaction
    //     } catch (\Exception $e) {
    //         DB::rollback(); // Rollback the transaction in case of an exception

    //         Log::error($e); // Log the exception for debugging

    //         return redirect()->back()->with('error', 'Gagal Mengubah Kategori Outlet. Silakan coba lagi. : ' . $e->getMessage());
    //     }
    //     return redirect()->back()->with('success', 'Berhasil Mengubah Kategori Outlet');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Outlet_Category  $outlet_id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request, Outlet_Category $outlet_id)
    // {
    //     try {
    //         DB::beginTransaction(); // Begin Transaction

    //         $request->validate([
    //             'id_kategori' => 'required|integer',
    //         ]);

    //         Outlet_Category::findOrFail($request->id_kategori)->delete();

    //         DB::commit(); // Commit the transaction
    //     } catch (\Exception $e) {
    //         DB::rollback(); // Rollback the transaction in case of an exception

    //         Log::error($e); // Log the exception for debugging

    //         return redirect()->back()->with('error', 'Gagal Menghapus Kategori Outlet. Silakan coba lagi.');
    //     }
    //     return redirect()->back()->with('success', 'Kategori Outlet Berhasil Dihapus.');
    // }

    // public function kategorioutletSlug(Request $request)
    // {
    //     $slug = SlugService::createSlug(Outlet_Category::class, 'slug', $request->nama_category);

    //     return response()->json(['slug' => $slug]);
    // }
}
