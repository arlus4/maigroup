<?php

namespace App\Http\Controllers\Admin\Admin_Manage_Brands;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Brand_Category;
use App\Models\Users_Register;
use App\Models\Brands_Register;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Admin_Brands_RejectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_brandReject(): View
    {
        return view('master.brands.reject.daftarBrandReject');
    }

    /**
     * This function retrieves rejected brand data from the "brands_registers" table.
     * It performs a join operation with other tables to fetch additional information.
     * The retrieved data is then returned as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDatabrandReject(): JsonResponse
    {
        // Retrieve the rejected brand data from the "brands_registers" table
        $data = DB::table('brands_registers')
            ->select(
                'brands_registers.id',
                'brands_registers.brand_code',
                'brands_registers.brand_name',
                'brands_registers.slug',
                'brands_registers.brand_description',
                'brands_registers.brand_image',
                'brands_registers.brand_image_path',
                'brands_registers.created_at',
                'brand_categories.brand_category_name',
                DB::raw('COALESCE(users_registers.name, users_login.name) as name'),
                DB::raw('COALESCE(users_registers.email, users_login.email) as email')
            )
            ->leftJoin('users_registers', 'brands_registers.user_id', '=', 'users_registers.id')
            ->leftJoin('users_login', function($join) {
                // Perform a left join with the "users_login" table and apply a condition
                $join->on('brands_registers.user_id', '=', 'users_login.id');
                $join->whereNull('users_registers.id');
            })
            ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code')
            ->where('brands_registers.is_regis', 2)
            ->orderBy('brands_registers.created_at', 'asc')
        ->get();

        // Prepare the response data
        $datas = [
            'data' => $data
        ];

        // Return the response as JSON
        return response()->json($datas);
    }

    /**
     * Display the detail page for a specific pending brand.
     *
     * @param Brands_Register $brand_regis
     * @return View
     */
    public function detail_BrandReject(Brands_Register $brand_regis): View
    {
        // Retrieve the user associated with the brand registration
        $user = Users_Register::where('id', $brand_regis->user_id)->first();

        // Retrieve the category name for the brand registration
        $category = Brand_Category::select('brand_category_name')->where('brand_category_code', $brand_regis->brand_category_code)->first();

        // Return the view 'master.brands.reject.detailBrandReject' with the retrieved data
        return view('master.brands.reject.detailBrandReject', [
            'brand' => $brand_regis,
            'user' => $user,
            'categories' => $category
        ]);
    }
}
