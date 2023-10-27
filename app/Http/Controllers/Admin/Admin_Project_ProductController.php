<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ref_Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;

class Admin_Project_ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataKategori = Ref_Project::select('id','project_name','slug')->get();

        return view('master.kategori-produk.index', compact('dataKategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'project_name'  => 'required|string|max:255',
                'slug'          => 'required|string|max:255|unique:ref_project',
            ]);

            Ref_Project::create([
                'project_name' => $request->project_name,
                'slug'         => $request->slug,
                'date_created' => Carbon::now('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menambah Kategori Produk. Silakan coba lagi.');
        }
        return redirect()->back()->with('success', 'Berhasil Menambah Kategori Produk!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ref_Project  $ref_Project
     * @return \Illuminate\Http\Response
     */
    public function show(Ref_Project $ref_Project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ref_Project  $ref_Project
     * @return \Illuminate\Http\Response
     */
    public function edit(Ref_Project $ref_Project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ref_Project  $ref_Project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ref_Project $ref_Project)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'project_name_edit' => 'required|string|max:255',
                'slug_edit'          => 'required|string|max:255|unique:ref_project,slug,' . $ref_Project->id,
            ]);

            Ref_Project::findOrFail($request->idKategoriProduk)->update([
                'project_name' => $request->project_name_edit,
                'slug'         => $request->slug_edit,
            ]);
            
            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Mengubah Kategori Produk. Silakan coba lagi.');
        }
        return redirect()->back()->with('success', 'Berhasil Mengubah Kategori Produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ref_Project  $ref_Project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Ref_Project $ref_Project)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id_kategori' => 'required|integer',
            ]);

            Ref_Project::findOrFail($request->id_kategori)->delete();

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menghapus Kategori Produk. Silakan coba lagi.');
        }
        return redirect()->back()->with('success', 'Kategori Produk Berhasil Dihapus.');
    }

    public function kategoriProdukSlug(Request $request)
    {
        $slug = SlugService::createSlug(Ref_Project::class, 'slug', $request->project_name);

        return response()->json(['slug' => $slug]);
    }
}
