<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ref_Produk;
use App\Models\Ref_Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;


class Admin_ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataProduk = Ref_Produk::select(
                'ref_produks.id as id_produk',
                'ref_produks.project_id',
                'ref_produks.sku',
                'ref_produks.nama_produk',
                'ref_produks.slug',
                'ref_produks.harga',
                'ref_produks.deskripsi',
                'ref_produks.thumbnail',

                'ref_project.id as id_project',
                'ref_project.project_name',
            )
            ->leftJoin('ref_project','ref_project.id','=','ref_produks.project_id')
            ->get();

        return view('master.produk.daftarProduk', compact('dataProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getKategori  = Ref_Project::select('id','project_name','slug')->get();

        return view('master.produk.tambahProduk', compact('getKategori'));
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
                'project_id'    => 'required',
                'sku'           => 'required',
                'nama_product'  => 'required',
                'slug'          => 'required|unique:ref_produks',
                'harga'         => 'required',
                'deskripsi'     => 'required'
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
            
            Ref_Produk::create([
                'project_id'        => $request->project_id,
                'sku'               => $request->sku,
                'nama_produk'       => $request->nama_product,
                'slug'              => $request->slug,
                'harga'             => $request->harga,
                'deskripsi'         => $request->deskripsi,
                'thumbnail'         => $imageName,
                'path_thumbnail'    => $imagePath,
            ]);

            DB::commit(); // Commit the transaction

        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->route('admin.admin_product')->with('error', 'Gagal Menambah Produk. Silakan coba lagi.');
        }
        return redirect()->route('admin.admin_product')->with('success', 'Berhasil Menambah Produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ref_Produk  $ref_Produk
     * @return \Illuminate\Http\Response
     */
    public function show(Ref_Produk $ref_Produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ref_Produk  $ref_Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Ref_Produk $ref_Product)
    {
        $dataProduk = Ref_Produk::select(
            'ref_produks.id as id_produk',
            'ref_produks.project_id',
            'ref_produks.sku',
            'ref_produks.nama_produk',
            'ref_produks.slug',
            'ref_produks.harga',
            'ref_produks.deskripsi',
            'ref_produks.thumbnail',

            'ref_project.id as id_project',
            'ref_project.project_name',
        )
        ->leftJoin('ref_project','ref_project.id','=','ref_produks.project_id')
        ->where('ref_produks.slug', $ref_Product->slug)
        ->first();

        $getKategori  = Ref_Project::select('id','project_name','slug')->get();

        return view('master.produk.editProduk', compact('dataProduk','getKategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ref_Produk  $ref_Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ref_Produk $ref_Product)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'project_id'    => 'required',
                'sku'           => 'required',
                'nama_product'  => 'required',
                'slug'          => 'required|unique:ref_produks',
                'harga'         => 'required',
                'deskripsi'     => 'required'
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
                'project_id'        => $request->project_id,
                'sku'               => $request->sku,
                'nama_produk'       => $request->nama_product,
                'slug'              => $request->slug,
                'harga'             => $request->harga,
                'deskripsi'         => $request->deskripsi,
                'thumbnail'         => $imageName,
                'path_thumbnail'    => $imagePath,
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->route('admin.admin_product')->with('error', 'Gagal Mengubah Produk. Silakan coba lagi');
        }
        return redirect()->route('admin.admin_product')->with('success', 'Berhasil Mengubah Produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ref_Produk  $ref_Produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $filePath = 'storage/produk/thumbnail/' . $request->data_thumbnail;

            Log::info('Path file yang akan dihapus: ' . $filePath);

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            Ref_Produk::findOrFail($request->id_produk)->delete();

            DB::commit(); // Commit the transaction

            return redirect()->back()->with('success', 'Produk Berhasil Dihapus.');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($e); // Log the exception for debugging

            return redirect()->back()->with('error', 'Gagal Menghapus Produk. Silakan coba lagi.');
        }
    }

    public function produkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Ref_Produk::class, 'slug', $request->nama_product);

        return response()->json(['slug' => $slug]);
    }
}
