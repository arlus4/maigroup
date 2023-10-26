<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ref_Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class Admin_ProductController extends Controller
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
                'category_id' => 'required',
                'sku' => 'required',
                'nama_product' => 'required',
                'slug' => 'required|unique:ref_products',
                'harga' => 'required',
                'deskripsi' => 'required'
            ]);

            if ($request->hasFile('thumbnail')) {
                $request->validate([
                    'thumbnail' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'thumbnail.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Store the uploaded image in storage/app/storage/thumbnail directory
                $imageName = Str::random(10) . '_' . $request->thumbnail->getClientOriginalName();

                $request->thumbnail->storeAs('produk/thumbnail/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/produk/thumbnail/' . $imageName;
            } else {
                $imageName = null;
                $imagePath = null;
            }
            
            Ref_Product::create([
                'category_id' => $request->category_id,
                'sku' => $request->sku,
                'nama_product' => $request->nama_product,
                'slug' => $request->slug,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'thumbnail' => $imageName,
                'path_thumbnail' => $imagePath,
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menambah Produk. Silakan coba lagi.');
        }
        return redirect()->back()->with('success', 'Berhasil Menambah Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ref_Product  $ref_Product
     * @return \Illuminate\Http\Response
     */
    public function show(Ref_Product $ref_Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ref_Product  $ref_Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Ref_Product $ref_Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ref_Product  $ref_Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ref_Product $ref_Product): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'category_id' => 'required',
                'sku' => 'required',
                'nama_product' => 'required',
                'slug' => 'required|unique:ref_products',
                'harga' => 'required',
                'deskripsi' => 'required'
            ]);
            
            if ($request->hasFile('thumbnail')) {
                $request->validate([
                    'thumbnail' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'thumbnail.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);
                
                // Store the uploaded image in storage/app/storage/thumbnail directory
                $imageName = Str::random(10) . '_' . $request->thumbnail->getClientOriginalName();

                $request->thumbnail->storeAs('produk/thumbnail/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/produk/thumbnail/' . $imageName;

                // Delete Old Image
                if (Storage::disk('public')->exists('storage/produk/thumbnail/' . $ref_Product->thumbnail)) {
                    Storage::disk('public')->delete('storage/produk/thumbnail/' . $ref_Product->thumbnail);
                }
            } else {
                $imageName = $ref_Product->thumbnail;
                $imagePath = $ref_Product->path_thumbnail;
            }
            
            $ref_Product->update([
                'category_id' => $request->category_id,
                'sku' => $request->sku,
                'nama_product' => $request->nama_product,
                'slug' => $request->slug,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'thumbnail' => $imageName,
                'path_thumbnail' => $imagePath,
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Mengubah Produk. Silakan coba lagi.');
        }
        return redirect()->back()->with('success', 'Berhasil Mengubah Produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ref_Product  $ref_Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ref_Product $ref_Product)
    {
        try {
            DB::beginTransaction(); // Begin Transaction
            
            if (Storage::disk('public')->exists('storage/produk/thumbnail/' . $ref_Product->thumbnail)) {
                Storage::disk('public')->delete('storage/produk/thumbnail/' . $ref_Product->thumbnail);
            }

            $ref_Product->delete();

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menghapus Product. Silakan coba lagi.');
            // return redirect()->back()->with('error', 'Gagal Menghapus Product: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Product Berhasil Dihapus.');
    }
}
