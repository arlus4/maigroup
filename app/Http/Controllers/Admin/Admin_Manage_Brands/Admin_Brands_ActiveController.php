<?php

namespace App\Http\Controllers\Admin\Admin_Manage_Brands;

use App\Models\User;
use App\Models\Brand;
use App\Models\Outlet;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Brand_Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Admin_Brands_ActiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_brandActive(): View
    {
        return view('master.brands.active.daftarBrandActive');
    }
    
    /**
     * Retrieve data for active brands and return it as a JSON response.
     *
     * @return JsonResponse
     */
    public function getDatabrandActive(): JsonResponse
    {
        // Retrieve data from the 'brands' table
        $data = DB::table('brands')
            ->select(
                'brands.id',
                'brands.brand_code',
                'brands.brand_name',
                'brands.slug',
                'brands.brand_description',
                'brands.brand_image',
                'brands.brand_image_path',
                'brands.created_at',
                'brand_categories.brand_category_name',
                'users_login.name',
                'users_login.email'
            )
            ->leftJoin('users_login', 'brands.user_id', 'users_login.id') // Left join the 'users_login' table using the 'user_id' column
            ->leftJoin('brand_categories', 'brands.brand_category_code', 'brand_categories.brand_category_code') // Left join the 'brand_categories' table using the 'brand_category_code' column
            ->where('brands.is_active', 1) // Filter rows where the 'is_active' column is 1 (active)
            ->orderBy('brands.created_at', 'asc') // Order the results by the 'created_at' column in ascending order
        ->get(); // Execute the query and retrieve the result set

        // Construct the JSON response data
        $datas = [
            'data' => $data
        ];

        // Return the JSON response
        return response()->json($datas);
    }

    /**
    * Display the detail page for a specific brand.
    *
    * @param Brand $brand
    * @return View
    */
    public function detailBrands(Brand $brand): View
    {
        // Retrieve the user associated with the brand
        $user = User::where('id', $brand->user_id)->first();

        // Retrieve the category name for the brand
        $category = Brand_Category::select('brand_category_name')->where('brand_category_code', $brand->brand_category_code)->first();

        // Retrieve the outlets associated with the brand
        $outlet = Outlet::where('brand_code', $brand->brand_code)->get();

        $penjualan = DB::table('invoice_master_pembeli')
            ->leftJoin('outlets', 'outlets.outlet_code', '=', 'invoice_master_pembeli.outlet_code')
            ->where('outlets.brand_code', $brand->brand_code)
        ->sum('invoice_master_pembeli.amount');
        $pembelian = DB::table('invoice_master_pengeluaran')
            ->leftJoin('outlets', 'outlets.outlet_code', '=', 'invoice_master_pengeluaran.outlet_code')
            ->where('outlets.brand_code', $brand->brand_code)
        ->sum('invoice_master_pengeluaran.amount');

        $pendapatan = $penjualan - $pembelian;

        // Return the view 'master.brands.active.detailUserBrands' with the retrieved data
        return view('master.brands.active.detailUserBrands', [
            'user' => $user,
            'brand' => $brand,
            'categories' => $category,
            'outlets' => $outlet,
            'pendapatan' => $pendapatan
        ]);
    }

    /**
     * Display the edit page for a specific brand.
     *
     * @param Brand $brand
     * @return View
     */
    public function editBrands(Brand $brand)
    {
        // Retrieve the user associated with the brand
        $user = User::where('id', $brand->user_id)->first();

        // Retrieve all brand categories
        $getBrands = Brand_Category::all();

        // Return the view 'master.brands.active.editUserBrands' with the retrieved data
        return view('master.brands.active.editUserBrands', [
            'user' => $user,
            'brand' => $brand,
            'categories' => $getBrands
        ]);
    }
}
