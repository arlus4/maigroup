<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class Invoice_Controller extends Controller
{
    public function sumPoint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
            'outlet_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        try {
            // eksekusi raw SQL query
            // Call the stored procedure
            DB::unprepared("EXEC maigroup.dbo.sum_point_user '{$request->pembeli_id}', '{$request->outlet_id}'");

            // If the stored procedure does not return a result set,
            // You can return a success message or any other appropriate response.
            return response()->json(['message' => 'Prosedur berhasil dijalankan']);
        } catch (\Exception $e) {
            // Return an error if the query fails
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function sumBonusUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
            'outlet_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        try {
            // eksekusi raw SQL query
            // Call the stored procedure
            DB::unprepared("EXEC maigroup.dbo.sum_bonus_user '{$request->pembeli_id}', '{$request->outlet_id}'");
    
            // If the stored procedure does not return a result set,
            // You can return a success message or any other appropriate response.
            return response()->json(['message' => 'Prosedur berhasil dijalankan']);
        } catch (\Exception $e) {
            // Return an error if the query fails
            return response()->json(['error' => 'Query Error: ' . $e->getMessage()], 500);
        }
    }        
}
