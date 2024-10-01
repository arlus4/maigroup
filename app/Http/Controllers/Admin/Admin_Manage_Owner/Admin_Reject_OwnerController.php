<?php

namespace App\Http\Controllers\Admin\Admin_Manage_Owner;

use App\Models\Users_Register;
use App\Models\Brands_Register;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class Admin_Reject_OwnerController extends Controller
{
        /**
     * Display the index page for rejected user owners.
     *
     * @return View
     */
    public function index_userReject(): View
    {
        // Return the view 'master.user-owner.user-reject.daftarUserReject'
        return view('master.user-owner.user-reject.daftarUserReject');
    }

    /**
     * Retrieve rejected user data and return it as a JSON response.
     *
     * @return JsonResponse
     */
    public function getDataReject(): JsonResponse
    {
        // Retrieve data from the 'Users_Register' table for rejected users
        $users = Users_Register::select(
            'id', 'name', 'email', 'no_hp', 'nomor_ktp', 'is_regis', 'created_at'
        )
        ->where('is_regis', 2) // Filter rows where 'is_regis' column is 2 (rejected)
        ->orderBy('created_at', 'asc') // Order the results by 'created_at' column in ascending order
        ->get(); // Execute the query and retrieve the result set

        // Construct the JSON response data
        $datas = [
            'data' => $users
        ];

        // Return the JSON response
        return response()->json($datas);
    }

    /**
     * Display the detail page for a rejected user.
     *
     * @param Users_Register $id
     * @return View
     */
    public function detail_userReject(Users_Register $id): View
    {
        // Retrieve the brands associated with the rejected user
        $getBrands = Brands_Register::select('brand_name', 'brand_code', 'slug')->where('user_id', $id->id)->get();

        // Return the view 'master.user-owner.user-reject.detailUserReject' with the retrieved data
        return view('master.user-owner.user-reject.detailUserReject', [
            'getData' => $id,
            'getBrands' => $getBrands
        ]);
    }
}
