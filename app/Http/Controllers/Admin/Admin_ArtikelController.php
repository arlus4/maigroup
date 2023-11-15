<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Artikel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Artikel_Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class Admin_ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $artikel = Artikel::select(
            'id',
            'news_code',
            'headline',
            'caption',
            'thumbnail',
            'path_thumbnail',
            'created_date'
        )->get();

        return view('master.artikel.daftarArtikel',[
            'artikels' => $artikel,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.artikel.tambahArtikel',[
            'title' => "News Artikel"
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
                'news_code' => 'required',
                'headline' => 'required',
                'caption' => 'required',
                'news_content' => 'required',
                'thumbnail' => 'required|mimes:jpeg,png,jpg,gif',
                'nama_file.*' => 'mimes:jpeg,png,jpg,gif', // Validasi untuk multiple file upload
            ], [
                'thumbnail.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                'nama_file.*.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
            ]);
    
            if ($request->hasFile('thumbnail')) {
                // Store the uploaded image in storage/app/storage/image directory
                $imageName = Str::random(10) . '_' . $request->thumbnail->getClientOriginalName();
    
                $request->thumbnail->storeAs('artikel/thumbnail/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/artikel/thumbnail/' . $imageName;
            }
    
            $artikel = Artikel::create([
                'news_code'         => $request->news_code,
                'headline'          => $request->headline,
                'caption'           => $request->caption,
                'news_content'      => $request->news_content,
                'thumbnail'         => $imageName,
                'path_thumbnail'    => $imagePath,
                'created_date'      => Carbon::now()->timezone('Asia/Jakarta')
            ]);
    
            if ($request->hasFile('nama_file')) {
                $gambars = $request->file('nama_file');
                // Looping gambar
                foreach ($gambars as $gambar) {
                    // Store the uploaded image in storage/app/storage/image directory
                    $imageName_detail = Str::random(10) . '_' . $gambar->getClientOriginalName();
    
                    $gambar->storeAs('artikel/content/', $imageName_detail, 'public');
                    
                    // Generate the public URL of the stored image using storage:link
                    $imagePath_detail = 'storage/artikel/content/' . $imageName_detail;
    
                    Artikel_Image::create([
                        'news_code'         => $artikel->news_code,
                        'image_name'        => $imageName_detail,
                        'path'              => $imagePath_detail,
                        'isthumbnail'       => '0',
                        'created_date'      => Carbon::now()->timezone('Asia/Jakarta')
                    ]);
                }
            }
    
            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception
    
            Log::error($th); // Log the exception for debugging
    
            return redirect()->back()->with('error', 'Gagal Menambah Artikel  : ' . $th->getMessage());
        }
        return redirect()->route('admin.admin_artikel')->with('success', 'Berhasil Menambah Artikel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel): View
    {
        $gambar_slider = Artikel_Image::select(
                'id',
                'image_name',
                'path',
            )
            ->where('news_code', $artikel->news_code)
            ->get();

        return view('master.artikel.lihatArtikel',[
            'title' => "Artikel $artikel->headline",
            'artikel' => $artikel,
            'sliders' => $gambar_slider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel): View
    {
        $gambar_slider = Artikel_Image::select(
                'id',
                'image_name',
                'path',
            )
            ->where('news_code', $artikel->news_code)
            ->get();

        return view('master.artikel.editArtikel',[
            'title' => "Artikel $artikel->headline",
            'artikel' => $artikel,
            'sliders' => $gambar_slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Start a database transaction

            $request->validate([
                'news_code'     => 'required',
                'headline'      => 'required',
                'caption'       => 'required',
                'news_content'  => 'required',
            ]);

            if ($request->hasFile('thumbnail')) {
                $request->validate([
                    'thumbnail' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'thumbnail.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);
                
                // Menghapus thumbnail jika ada
                if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->path_thumbnail)) {
                    Storage::disk('public')->delete($artikel->path_thumbnail);
                }
                
                // Store the uploaded image in storage/app/storage/image directory
                $imageName = Str::random(10) . '_' . $request->thumbnail->getClientOriginalName();

                $request->thumbnail->storeAs('artikel/thumbnail/', $imageName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imagePath = 'storage/artikel/thumbnail/' . $imageName;
            } else {
                $imageName = $artikel->thumbnail;
                $imagePath = $artikel->path_thumbnail;
            }

            $artikel->update([
                'news_code'         => $request->news_code,
                'headline'          => $request->headline,
                'caption'           => $request->caption,
                'news_content'      => $request->news_content,
                'thumbnail'         => $imageName,
                'path_thumbnail'    => $imagePath,
            ]);

            if ($request->hasFile('nama_file')) {
                $gambars = $request->file('nama_file');
                $request->validate([
                    'nama_file.*' => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'nama_file.*.mimes' => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);
                // Looping gambar
                foreach ($gambars as $gambar) {
                    // Store the uploaded image in storage/app/storage/image directory
                    $imageName_detail = Str::random(10) . '_' . $gambar->getClientOriginalName();
    
                    $gambar->storeAs('artikel/content/', $imageName_detail, 'public');
                    
                    // Generate the public URL of the stored image using storage:link
                    $imagePath_detail = 'storage/artikel/content/' . $imageName_detail;
    
                    Artikel_Image::create([
                        'news_code'         => $artikel->news_code,
                        'image_name'        => $imageName_detail,
                        'path'              => $imagePath_detail,
                        'isthumbnail'       => '0',
                        'created_date'      => Carbon::now()->timezone('Asia/Jakarta')
                    ]);
                }
            }

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Gagal Mengubah Artikel  : ' . $th->getMessage());
        }
        return redirect()->route('admin.admin_artikel')->with('success', 'Berhasil Mengubah Artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel): RedirectResponse
    {
        try {
            DB::beginTransaction(); // Start transaction
    
            // Menghapus gambar terkait dari storage
            $gambar_slider = Artikel_Image::where('news_code', $artikel->news_code)->get();
    
            foreach ($gambar_slider as $gambar) {
                if (Storage::disk('public')->exists($gambar->path)) {
                    Storage::disk('public')->delete($gambar->path);
                }
                $gambar->delete(); // Menghapus entri database untuk gambar
            }
    
            // Menghapus thumbnail jika ada
            if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->path_thumbnail)) {
                Storage::disk('public')->delete($artikel->path_thumbnail);
            }
    
            // Menghapus artikel dari database
            $artikel->delete();
    
            DB::commit(); // Commit the transaction
    
            return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an error
    
            return redirect()->back()->with('error', 'Gagal menghapus artikel: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel_Image  $artikel_image
     * @return \Illuminate\Http\Response
     */
    public function destroy_image(Artikel_Image $artikel_image)
    {
        try {
            DB::beginTransaction(); // Start transaction
            
            // Menghapus thumbnail jika ada
            if (Storage::disk('public')->exists($artikel_image->path)) {
                Storage::disk('public')->delete($artikel_image->path);
            }
    
            // Menghapus artikel_image dari database
            $artikel_image->delete();

            DB::commit(); // Commit the transaction

            return response()->json(['message' => 'Gambar berhasil dihapus'], 201);
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an error

            return response()->json(['message' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }
}
