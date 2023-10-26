<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Kategori_Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class Admin_Category_ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'nama_kategori' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:kategori_products',
            ]);

            Kategori_Product::create([
                'nama_kategori' => $request->nama_kategori,
                'slug' => $request->slug,
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menambah Kategori Produk. Silakan coba lagi.');
        }
        return redirect()->back()->with('success', 'Berhasil Menambah Kategori Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori_Product  $kategori_Product
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori_Product $kategori_Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori_Product  $kategori_Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori_Product $kategori_Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori_Product  $kategori_Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori_Product $kategori_Product): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'nama_kategori' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:kategori_products,slug,' . $kategori_Product->id,
            ]);

            Kategori_Product::findOrFail($kategori_Product->id)->update([
                'nama_kategori' => $request->nama_kategori,
                'slug' => $request->slug,
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
     * @param  \App\Models\Kategori_Product  $kategori_Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori_Product $kategori_Product): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $kategori_Product->delete();

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menghapus Kategori Produk. Silakan coba lagi.');
            // return redirect()->back()->with('error', 'Gagal Menghapus Kategori Produk: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Kategori Produk Berhasil Dihapus.');
    }
}
