<?php

namespace App\Http\Controllers\Penjual;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Invoice_Detail_Pembeli;
use App\Models\Invoice_Master_Pembeli;

class Penjual_OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'date_created' => now()
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
                        'date_created' => now()
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice_Master_Pembeli  $invoice_Master_Pembeli
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_Master_Pembeli $invoice_Master_Pembeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice_Master_Pembeli  $invoice_Master_Pembeli
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice_Master_Pembeli $invoice_Master_Pembeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice_Master_Pembeli  $invoice_Master_Pembeli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_Master_Pembeli $invoice_Master_Pembeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice_Master_Pembeli  $invoice_Master_Pembeli
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice_Master_Pembeli $invoice_Master_Pembeli)
    {
        //
    }
}
