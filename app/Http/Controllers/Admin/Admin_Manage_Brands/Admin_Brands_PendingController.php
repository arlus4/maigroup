<?php

namespace App\Http\Controllers\Admin\Admin_Manage_Brands;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Brand_Category;
use App\Models\Users_Register;
use App\Models\Brands_Register;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Admin_Brands_PendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_brandPending(): View
    {
        return view('master.brands.pending.daftarBrandPending');
    }

    /**
     * Retrieve data for pending brands and return it as a JSON response.
     *
     * @return JsonResponse
     */
    public function getDatabrandPending(): JsonResponse
    {
        // Retrieve data from the 'brands_registers' table
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
            ->leftJoin('users_registers', 'brands_registers.user_id', '=', 'users_registers.id') // Left join the 'users_registers' table using the 'user_id' column
            ->leftJoin('users_login', function($join) {
                $join->on('brands_registers.user_id', '=', 'users_login.id'); // Join the 'users_login' table using the 'user_id' column
                $join->whereNull('users_registers.id'); // Filter rows where the 'users_registers.id' is null
            })
            ->leftJoin('brand_categories', 'brands_registers.brand_category_code', 'brand_categories.brand_category_code') // Left join the 'brand_categories' table using the 'brand_category_code' column
            ->where('brands_registers.is_regis', 0) // Filter rows where the 'is_regis' column is 0
            ->orderBy('brands_registers.created_at', 'asc') // Order the results by the 'created_at' column in ascending order
        ->get(); // Execute the query and retrieve the result set

        // Construct the JSON response data
        $datas = [
            'data' => $data
        ];

        // Return the JSON response
        return response()->json($datas);
    }

    /**
     * Display the detail page for a specific pending brand.
     *
     * @param Brands_Register $brand_regis
     * @return View
     */
    public function detail_BrandPending(Brands_Register $brand_regis): View
    {
        // Retrieve the user associated with the brand registration
        $user = Users_Register::where('id', $brand_regis->user_id)->first();

        // Retrieve the category name for the brand registration
        $category = Brand_Category::select('brand_category_name')->where('brand_category_code', $brand_regis->brand_category_code)->first();

        // Return the view 'master.brands.pending.detailBrandPending' with the retrieved data
        return view('master.brands.pending.detailBrandPending', [
            'brand' => $brand_regis,
            'user' => $user,
            'categories' => $category
        ]);
    }

    /**
     * Retrieve the detailed data for a specific pending brand registration and return it as a JSON response.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getDataDetailBrandPending(Request $request): JsonResponse
    {
        return response()->json(Brands_Register::find($request->id));
    }

    /**
     * Approve a pending brand registration and create a new brand record in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function approve_BrandPending(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id' => 'required'
            ]);

            $regis = Brands_Register::find($request->id); // Retrieve the brand registration to be approved

            $user = Users_Register::find($regis->user_id); // Check if the user is registered

            if ($user->is_regis == 0) {
                // If the user is not registered, return an error response
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Owner is not registered'
                ]);
            }

            // Create a new brand record
            Brand::create([
                'user_id'               => $regis->user_id,
                'brand_category_code'   => $regis->brand_category_code,
                'brand_code'            => $regis->brand_code,
                'brand_name'            => $regis->brand_name,
                'slug'                  => $regis->slug,
                'no_hp'                 => $regis->whatsapp,
                'brand_description'     => $regis->brand_description,
                'brand_image'           => $regis->brand_image,
                'brand_image_path'      => $regis->brand_image_path,
                'website'               => $regis->website,
                'whatsapp'              => $regis->whatsapp,
                'facebook'              => $regis->facebook,
                'instagram'             => $regis->instagram,
                'tiktok'                => $regis->tiktok,
                'youtube'               => $regis->youtube,
                'is_active'             => 1,
                'created_at'            => Carbon::now()->timezone('Asia/Jakarta'),
                'updated_at'            => Carbon::now()->timezone('Asia/Jakarta')
            ]);

            // Update the brand registration status to 'registered'
            $regis->update([
                'is_regis' => 1
            ]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $th->getMessage()
            ]);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Brand successfully approved'
        ]);
    }

    /**
     * Reject a pending brand registration and update the 'is_regis' status to 2 in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function reject_BrandPending(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $request->validate([
                'id' => 'required'
            ]);

            $regis = Brands_Register::find($request->id); // Retrieve the brand registration to be approved

            $user = Users_Register::find($regis->user_id); // Check if the user is registered

            if ($user->is_regis == 0) {
                // If the user is not registered, return an error response
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Owner is not registered'
                ]);
            }

            $regis->update(['is_regis' => 2]);

            DB::commit(); // Commit the transaction
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $th->getMessage()
            ]);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Brand registration rejected successfully'
        ]);
    }
}
