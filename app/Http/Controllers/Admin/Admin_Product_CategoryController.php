<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Brand_Category;
use App\Models\Product_Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\View\View;

class Admin_Product_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $brand_category = Brand_Category::get();
        return view('master.user-owner.outlet.categoryProduct', [
            'brand_category' => $brand_category
        ]);
    }

    public function getDataProductCategory()
    {
        $data = DB::table('product_category')
            ->select(
                'product_category.id',
                'product_category.category_code',
                'product_category.category_name',
                'product_category.slug',
                'product_category.description',
                'product_category.image',
                'product_category.path_image',
                'brand_categories.brand_category_name'
            )
            ->leftJoin('brand_categories', 'brand_categories.brand_category_code', 'product_category.brand_category_code')
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
        //
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
                'brand_category_code'   => 'required',
                'category_name'         =>'required',
                'slug'                  =>'required|unique:product_category',
            ]);

            $generate = str_pad(mt_rand(0, 999), 3, "0", STR_PAD_LEFT);

            if ($request->hasFile('image')) {
                $request->validate([
                    'image'        => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'image.mimes'  => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Store the uploaded image in storage/app/storage/image directory
                $imageBrandName = Str::random(5) . '_' . $request->image->getClientOriginalName();

                $request->image->storeAs('product_category/', $imageBrandName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imageBrandPath = 'storage/product_category/' . $imageBrandName;
            } else {
                $imageBrandName = null;
                $imageBrandPath = null;
            }

            Product_Category::create([
                'brand_category_code'   => $request->brand_category_code,
                'category_code'         => 'CP-' . $generate,
                'category_name'         => $request->category_name,
                'slug'                  => $request->slug,
                'description'           => $request->description,
                'image'                 => $imageBrandName,
                'path_image'            => $imageBrandPath,
            ]);

            DB::commit(); // Commit the transaction

            return response()->json([
                'status'  => 'success',
                'message' => 'Berhasil Menambah Kategori Produk Baru'
            ]);
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
            ]);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_Category  $product_Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return response()->json(Product_Category::find($request->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_Category  $product_Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'code_category'         => 'required',
                'category_name_edit'    => 'required',
                'slug_edit'             => 'required|unique:product_category,slug,' . $request->code_category . ',category_code',
            ]);

            $image = Product_Category::select('image', 'path_image')->where('category_code', $request->code_category)->first();

            if ($request->hasFile('image')) {
                $request->validate([
                    'image'        => 'required|mimes:jpeg,png,jpg,gif',
                ], [
                    'image.mimes'  => 'Format file exception harus berupa JPG, JPEG, atau PNG.', // Pesan error
                ]);

                // Hapus gambar terkait jika ada
                if ($image->image) {
                    Storage::disk('public')->delete('product_category/' . $image->image);
                }

                // Store the uploaded image in storage/app/storage/image directory
                $imageBrandName = Str::random(5) . '_' . $request->image->getClientOriginalName();

                $request->image->storeAs('product_category/', $imageBrandName, 'public');
                
                // Generate the public URL of the stored image using storage:link
                $imageBrandPath = 'storage/product_category/' . $imageBrandName;

            } else {
                $imageBrandName = $image->image;
                $imageBrandPath = $image->path_image;
            }

            Product_Category::where('category_code', $request->code_category)->update([
                'brand_category_code'   => $request->brand_category,
                'category_name'         => $request->category_name_edit,
                'slug'                  => $request->slug_edit,
                'description'           => $request->description_edit,
                'image'                 => $imageBrandName,
                'path_image'            => $imageBrandPath,
            ]);

            DB::commit(); // Commit the transaction

            return response()->json([
                'status'  => 'success',
                'message' => 'Berhasil Mengubah Kategori Produk'
            ]);
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi Kesalahan: ' . $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_Category  $product_Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_Category $product_Category)
    {
        //
    }

    public function catProductSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product_Category::class, 'slug', $request->category_name);

        return response()->json(['slug' => $slug]);
    }
}
