<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Brand_Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Admin_Brands_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.user-owner.brandCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'nama_category' =>'required',
                'slug' =>'required|unique:brand_categories',
            ]);

            $generate = str_pad(mt_rand(0, 99), 2, "0", STR_PAD_LEFT);

            Brand_Category::create([
                'brand_category_code' => 'C-' . $generate,
                'brand_category_name' => $request->nama_category,
                'slug'                => $request->slug,
                'brand_category_description' => $request->description,
                'created_at'          => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'          => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            DB::commit(); // Commit the transaction

            return redirect()->back()->with('success', 'Berhasil Menambah Kategori Baru');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand_Category  $brand_Category
     * @return \Illuminate\Http\Response
     */
    public function show(Brand_Category $brand_Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand_Category  $brand_Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand_Category $brand_Category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand_Category  $brand_Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand_Category $brand_Category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand_Category  $brand_Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand_Category $brand_Category)
    {
        //
    }

    public function catBrandSlug(Request $request)
    {
        $slug = SlugService::createSlug(Brand_Category::class, 'slug', $request->nama_category);

        return response()->json(['slug' => $slug]);
    }
}
