<?php

namespace App\Http\Controllers\Admin\Admin_Manage_Brands;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Point_Deposit;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Konfirmasi_Pembayaran;
use App\Models\Point_Deposit_Request;

class Admin_Request_PointController extends Controller
{
    /**
     * Display the index page for point requests.
     *
     * @return View
     */
    public function index_requestPoint(): View
    {
        // Return the view 'master.brands.daftarRequestPoint'
        return view('master.brands.daftarRequestPoint');
    }

    /**
     * Retrieve point request data and return it as a JSON response.
     *
     * @return JsonResponse
     */
    public function getDataRequestPoint(): JsonResponse
    {
        // Retrieve data from the 'konfirmasi_pembayaran' table
        $data = DB::table('konfirmasi_pembayaran')
            ->select(
                'konfirmasi_pembayaran.id',
                'konfirmasi_pembayaran.invoice_no',
                'konfirmasi_pembayaran.point_request',
                'konfirmasi_pembayaran.jumlah_pembayaran',
                'konfirmasi_pembayaran.path_bukti_pembayaran',
                'konfirmasi_pembayaran.created_at',
                'brands.brand_code',
                'brands.brand_name',
                'brands.no_hp',
                'ref_bank.nama_bank',
                'ref_bank.nomor_rekening',
                'users_login.name',
            )
            ->join('brands', 'konfirmasi_pembayaran.brand_code', 'brands.brand_code') // Join the 'brands' table using the 'brand_code' column
            ->leftJoin('ref_bank', 'konfirmasi_pembayaran.id_bank_tokoseru', 'ref_bank.id') // Left join the 'ref_bank' table using the 'id_bank_tokoseru' column
            ->leftJoin('users_login', 'konfirmasi_pembayaran.user_request', 'users_login.id') // Left join the 'users_login' table using the 'user_request' column
            ->where('konfirmasi_pembayaran.status', 0) // Filter rows where the 'status' column is 0
            ->orderBy('konfirmasi_pembayaran.created_at', 'asc') // Order the results by the 'created_at' column in ascending order
        ->get(); // Execute the query and retrieve the result set

        // Construct the JSON response data
        $datas = [
            'data' => $data
        ];

        // Return the JSON response
        return response()->json($datas);
    }

    /**
     * Retrieve request log data and return it as a JSON response.
     *
     * @return JsonResponse
     */
    public function getDataRequestLog(): JsonResponse
    {
        $data = DB::table('konfirmasi_pembayaran')
            ->select(
                'konfirmasi_pembayaran.id',
                'konfirmasi_pembayaran.invoice_no',
                'konfirmasi_pembayaran.point_request',
                'konfirmasi_pembayaran.jumlah_pembayaran',
                'konfirmasi_pembayaran.path_bukti_pembayaran',
                'konfirmasi_pembayaran.status',
                'brands.brand_code',
                'brands.brand_name',
                'brands.no_hp',
                'ref_bank.nama_bank',
                'ref_bank.nomor_rekening',
                'users_login.name',
            )
            ->join('brands', 'konfirmasi_pembayaran.brand_code', 'brands.brand_code') // Join the 'brands' table using the 'brand_code' column
            ->leftJoin('ref_bank', 'konfirmasi_pembayaran.id_bank_tokoseru', 'ref_bank.id') // Left join the 'ref_bank' table using the 'id_bank_tokoseru' column
            ->leftJoin('users_login', 'konfirmasi_pembayaran.user_request', 'users_login.id') // Left join the 'users_login' table using the 'user_request' column
            ->whereNot('konfirmasi_pembayaran.status', 0) // Filter rows where the 'status' column is not 0
            ->orderBy('konfirmasi_pembayaran.created_at', 'asc') // Order the results by the 'created_at' column in ascending order
        ->get(); // Execute the query and retrieve the result set

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Retrieve detailed request point data for a specific ID and return it as a JSON response.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function detailRequestPoint($id): JsonResponse
    {
        $data = DB::table('konfirmasi_pembayaran')
            ->select(
                'konfirmasi_pembayaran.id',
                'konfirmasi_pembayaran.invoice_no',
                'konfirmasi_pembayaran.point_request',
                'konfirmasi_pembayaran.jumlah_pembayaran',
                'konfirmasi_pembayaran.path_bukti_pembayaran',
                'konfirmasi_pembayaran.created_at',
                'brands.brand_code',
                'brands.brand_name',
                'brands.no_hp',
                'ref_bank.nama_bank',
                'ref_bank.nomor_rekening',
                'users_login.name',
            )
            ->join('brands', 'konfirmasi_pembayaran.brand_code', 'brands.brand_code') // Join the 'brands' table using the 'brand_code' column
            ->leftJoin('ref_bank', 'konfirmasi_pembayaran.id_bank_tokoseru', 'ref_bank.id') // Left join the 'ref_bank' table using the 'id_bank_tokoseru' column
            ->leftJoin('users_login', 'konfirmasi_pembayaran.user_request', 'users_login.id') // Left join the 'users_login' table using the 'user_request' column
            ->where('konfirmasi_pembayaran.id', $id) // Filter rows where the 'id' column matches the provided ID
            ->orderBy('konfirmasi_pembayaran.created_at', 'asc') // Order the results by the 'created_at' column in ascending order
        ->first(); // Retrieve only the first result

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    /**
     * Approve a request for point deposit and update the corresponding records in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function approveRequestPoint(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $approve = Konfirmasi_Pembayaran::find($request->id); // Retrieve the request to be approved

            $deposit = Point_Deposit::where('brand_code', $approve->brand_code)->first(); // Check if a deposit record exists for the brand

            if ($deposit) {
                // If a deposit record exists, update the current point balance
                $deposit->update([
                    'point_current' => $deposit->point_current + $approve->point_request,
                    'update_by' => Auth::user()->id,
                    'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
                ]);
            } else {
                // If no deposit record exists, create a new record
                Point_Deposit::create([
                    'brand_code' => $approve->brand_code,
                    'point_current' => $approve->point_request,
                    'update_by' => Auth::user()->id,
                    'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
                    'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
                ]);
            }

            // Update the status of the point deposit request to 'approved'
            Point_Deposit_Request::where('invoice_no', $approve->invoice_no)->update(['status' => 3]);

            // Update the status of the request to 'approved'
            $approve->update(['status' => 1]);

            DB::commit(); // Commit the transaction

            return response()->json([
                'status'  => 'success',
                'message' => 'Request successfully approved.'
            ]);
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $th->getMessage()
            ]);
        }
    }

    /**
     * Reject a request for point deposit and update the corresponding records in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function rejectRequestPoint(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction(); // Begin Transaction

            $reject = Konfirmasi_Pembayaran::find($request->id); // Retrieve the request to be rejected

            // Update the reason and status of the point deposit request to 'rejected'
            Point_Deposit_Request::where('invoice_no', $reject->invoice_no)->update([
                'reason' => $request->reason,
                'status' => 4
            ]);

            // Update the reason and status of the request to 'rejected'
            $reject->update([
                'reason' => $request->reason,
                'status' => 2
            ]);

            DB::commit(); // Commit the transaction

            return response()->json([
                'status'  => 'success',
                'message' => 'Request successfully rejected.'
            ]);
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback the transaction in case of an exception

            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $th->getMessage()
            ]);
        }
    }
}
