<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Log_Bonus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Invoice_Detail_Pembeli;
use App\Models\Invoice_Master_Pembeli;
use Illuminate\Support\Facades\Validator;

class Invoice_Controller extends Controller
{
    public function create_invoice_master_pembeli(Request $request)
    {
        DB::beginTransaction(); // Mulai transaksi database
        try {
            // Validasi data dari request
            $validatedData = $request->validate([
                'pembeli_id' => 'required|integer',
                'qty' => 'required|array',
                'amount' => 'required|array',
                'outlet_id' => 'required|string',
                'rewards' => 'required|integer',
                'invoice_type' => 'required|string',
                'project_id' => 'required|array',
                'sku_id' => 'required|array'
            ]);

            // Hitung total qty dan amount
            $totalQty = array_sum($validatedData['qty']);
            $totalAmount = array_sum($validatedData['amount']);

            // Generate invoice_no dan date_created
            $invoiceData = [
                'pembeli_id' => $validatedData['pembeli_id'],
                'qty' => $totalQty,
                'amount' => $totalAmount,
                'outlet_id' => $validatedData['outlet_id'],
                'rewards' => $validatedData['rewards'],
                'invoice_type' => $validatedData['invoice_type'],
                'invoice_no' => 'MAI-' . strtoupper(Str::random(10)),
                'date_created' => Carbon::now()->timezone('Asia/Jakarta')
            ];

            // Menyimpan data ke database
            $invoice = Invoice_Master_Pembeli::create($invoiceData);

            // Menggunakan data invoice yang baru saja dibuat untuk membuat detail invoice
            $detailData = [
                'invoice_no' => $invoice->invoice_no,
                'sku_id' => $validatedData['sku_id'],
                'amount' => $validatedData['amount'],
                'project_id' => $validatedData['project_id'],
                'qty' => $validatedData['qty']
            ];

            $dataToInsert = [];
    
            foreach ($detailData['sku_id'] as $index => $sku) {
                for ($i = 0; $i < $detailData['qty'][$index]; $i++) {
                    $dataToInsert[] = [
                        'invoice_no' => $invoice->invoice_no,
                        'pembeli_id' => $invoice->pembeli_id,
                        'outlet_id' => $invoice->outlet_id,
                        'sku_id' => $sku,
                        'qty' => 1,
                        'amount' => $detailData['amount'][$index],
                        'project_id' => $detailData['project_id'][$index],
                        'isbonus' => 0,
                        'ispoint' => 0,
                        'date_created' => Carbon::now()->timezone('Asia/Jakarta')
                    ];
                }
            }

            // Menyimpan data ke database
            Invoice_Detail_Pembeli::insert($dataToInsert);

            // Memanggil stored procedure untuk Update data
            DB::unprepared("EXEC maigroup.dbo.sum_point_user '{$invoice->pembeli_id}', '{$invoice->outlet_id}'");
            DB::unprepared("EXEC maigroup.dbo.sum_bonus_user '{$invoice->pembeli_id}', '{$invoice->outlet_id}'");

            DB::commit(); // Commit transaksi jika semua proses berhasil

            // Mengembalikan respon
            return response()->json(['message' => 'Invoice berhasil dibuat', 'data' => $invoice], 201);
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
            // Mengembalikan pesan error saat terjadi kesalahan
            return response()->json(['message' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }

    public function update_claim(Request $request)
    {
        try {
            DB::beginTransaction(); // Mulai transaksi database
            
            // Validasi request
            $validatedData = $request->validate([
                'voucher_code' => 'required|exists:log_bonus,voucher_code', // pastikan voucher_code ada di database
            ]);

            // Cari Log_Bonus berdasarkan voucher_code
            $logBonus = Log_Bonus::where('voucher_code', $request->voucher_code)->first();

            // Jika logBonus tidak ditemukan, kembalikan response error
            if (!$logBonus) {
                return response()->json(['message' => 'Voucher tidak ditemukan'], 404);
            }

            // Update is_claim menjadi 1 dan date_claim menjadi waktu sekarang
            $logBonus->is_claim = 1;
            $logBonus->date_claim = Carbon::now()->timezone('Asia/Jakarta');
            $logBonus->save();

            DB::commit(); // Commit transaksi jika semua proses berhasil

            // Kembalikan response berhasil
            return response()->json([
                'message' => 'Voucher berhasil di-claim',
                'log_bonus' => $logBonus
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
            // Mengembalikan pesan error saat terjadi kesalahan
            return response()->json(['message' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }

    // public function create_invoice_detail_pembeli($detailData)
    // {
    //     try {
    //         // Mengambil data invoice dari tabel invoice_master_pembeli
    //         $invoice = Invoice_Master_Pembeli::where('invoice_no', $detailData['invoice_no'])->first();
    
    //         if (!$invoice) {
    //             return response()->json(['message' => 'Invoice tidak ditemukan'], 404);
    //         }
    
    //         $dataToInsert = [];
    
    //         foreach ($detailData['sku_id'] as $index => $sku) {
    //             for ($i = 0; $i < $detailData['qty'][$index]; $i++) {
    //                 $dataToInsert[] = [
    //                     'invoice_no' => $invoice->invoice_no,
    //                     'pembeli_id' => $invoice->pembeli_id,
    //                     'outlet_id' => $invoice->outlet_id,
    //                     'sku_id' => $sku,
    //                     'qty' => 1,
    //                     'amount' => $detailData['amount'][$index],
    //                     'project_id' => $detailData['project_id'][$index],
    //                     'isbonus' => 0,
    //                     'ispoint' => 0,
    //                     'date_created' => Carbon::now()->timezone('Asia/Jakarta')
    //                 ];
    //             }
    //         }
    
    //         // Menyimpan data ke database
    //         Invoice_Detail_Pembeli::insert($dataToInsert);

    //         // Memanggil stored procedure untuk Update data
    //         // DB::unprepared("EXEC maigroup.dbo.sum_point_user '{$invoice->pembeli_id}', '{$invoice->outlet_id}'");
    //         // DB::unprepared("EXEC maigroup.dbo.sum_bonus_user '{$invoice->pembeli_id}', '{$invoice->outlet_id}'");
    
    //         // Mengembalikan respon
    //         return response()->json(['message' => 'Detail invoice berhasil dibuat'], 201);
    
    //     } catch (\Exception $e) {
    //         // Mengembalikan pesan error saat terjadi kesalahan
    //         return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    //     }
    // }

    // public function sumPoint(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'pembeli_id' => 'required|string|max:255',
    //         'outlet_id' => 'required|string|max:255',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }
    
    //     try {
    //         // eksekusi raw SQL query
    //         // Call the stored procedure
    //         DB::unprepared("EXEC maigroup.dbo.sum_point_user '{$request->pembeli_id}', '{$request->outlet_id}'");

    //         // If the stored procedure does not return a result set,
    //         // You can return a success message or any other appropriate response.
    //         return response()->json(['message' => 'Prosedur berhasil dijalankan']);
    //     } catch (\Exception $e) {
    //         // Return an error if the query fails
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
    
    // public function sumBonusUser(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'pembeli_id' => 'required|string|max:255',
    //         'outlet_id' => 'required|string|max:255',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }
    
    //     try {
    //         // eksekusi raw SQL query
    //         // Call the stored procedure
    //         DB::unprepared("EXEC maigroup.dbo.sum_bonus_user '{$request->pembeli_id}', '{$request->outlet_id}'");
    
    //         // If the stored procedure does not return a result set,
    //         // You can return a success message or any other appropriate response.
    //         return response()->json(['message' => 'Prosedur berhasil dijalankan']);
    //     } catch (\Exception $e) {
    //         // Return an error if the query fails
    //         return response()->json(['error' => 'Query Error: ' . $e->getMessage()], 500);
    //     }
    // }        
}
