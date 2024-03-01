<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Outlet_Category;
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
    public function index()
    {
        $dataKategori = Outlet_Category::select('id','nama_category','slug')->orderby('nama_category', 'asc')->get();

        return view('master.kategori-outlet.index',[
            'title'         => "Kategori Outlet",
            'dataKategori'  => $dataKategori,
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
                'nama_category' => 'required|string|max:255',
                'slug'          => 'required|string|max:255|unique:outlet_categories',
            ]);

            Outlet_Category::create([
                'nama_category'=> $request->nama_category,
                'slug'         => $request->slug,
                'created_at' => Carbon::now('Asia/Jakarta'),
                'updated_at' => Carbon::now('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menambah Kategori Outlet. Silakan coba lagi.');
        }
        return redirect()->back()->with('success', 'Berhasil Menambah Kategori Outlet!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet_Category  $outlet_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet_Category $outlet_id)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'nama_category_edit' => 'required|string|max:255',
                'slug_edit'          => 'required|string|max:255|unique:outlet_categories,slug,' . $outlet_id->id,
            ]);

            Outlet_Category::findOrFail($request->idKategoriOutlet)->update([
                'nama_category' => $request->nama_category_edit,
                'slug'          => $request->slug_edit,
                'updated_at'    => Carbon::now('Asia/Jakarta')
            ]);
            
            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Mengubah Kategori Outlet. Silakan coba lagi. : ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Berhasil Mengubah Kategori Outlet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outlet_Category  $outlet_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Outlet_Category $outlet_id)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id_kategori' => 'required|integer',
            ]);

            Outlet_Category::findOrFail($request->id_kategori)->delete();

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menghapus Kategori Outlet. Silakan coba lagi.');
        }
        return redirect()->back()->with('success', 'Kategori Outlet Berhasil Dihapus.');
    }

    public function kategorioutletSlug(Request $request)
    {
        $slug = SlugService::createSlug(Outlet_Category::class, 'slug', $request->nama_category);

        return response()->json(['slug' => $slug]);
    }
}
