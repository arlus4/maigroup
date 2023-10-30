<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Invoice_Master_Pembeli;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class Invoice_Controller extends Controller
{
    public function create_invoice_master_pembeli(Request $request)
    {
        try {
            // Validasi data dari request
            $validatedData = $request->validate([
                'pembeli_id' => 'required',
                'qty' => 'required',
                'amount' => 'required',
                'outlet_id' => 'required',
                'rewards' => 'required',
                'invoice_type' => 'required',
                'project_id' => 'required'
            ]);
    
            // Generate invoice_no dan date_created
            $validatedData['invoice_no'] = 'MAI-' . strtoupper(Str::random(10));
            $validatedData['date_created'] = now();
    
            // Menyimpan data ke database
            $invoice = Invoice_Master_Pembeli::create($validatedData);
    
            // Mengembalikan respon
            return response()->json(['message' => 'Invoice berhasil dibuat', 'data' => $invoice], 201);
    
        } catch (\Exception $e) {
            // Mengembalikan pesan error saat terjadi kesalahan
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    

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
