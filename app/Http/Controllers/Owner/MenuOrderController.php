<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ref_Produk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product_Outlet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice_Detail_Pembeli;
use App\Models\Invoice_Master_Pembeli;
use App\Models\ref_KuotaPoint;

class MenuOrderController extends Controller
{
    public function index()
    {
        $dataOutlet = Product_Outlet::select(
                'product_outlets.outlet_id',
                'product_outlets.category_id',
                'product_outlets.product_id',
                'product_outlets.jumlah',

                'ref_produks.sku',
                'ref_produks.nama_produk',
                'ref_produks.harga',
                'ref_produks.path_thumbnail',

                'ref_project.project_name',

                'users_login.outlet_id'
            )
            ->leftJoin('ref_produks','product_outlets.product_id','=','ref_produks.id')
            ->leftJoin('ref_project','product_outlets.category_id','=','ref_project.id')
            ->leftJoin('users_login','product_outlets.outlet_id','=','users_login.outlet_id')
            ->where('product_outlets.outlet_id', Auth::user()->outlet_id)
            ->get();

        return view('owner.menuOrder', [
            'title' => 'Menu Order',
            'dataOutlet' => $dataOutlet
        ]);
    }

    public function getProduk($produkId)
    {
        $produk = Ref_Produk::select(
            'id',
            'project_id',
            'nama_produk',
            'sku',
            'harga',
            'path_thumbnail'
            )
            ->where('id', $produkId)
            ->first();

        return response()->json($produk);
    }

    public function getNomorHP(Request $request)
    {
        $searchTerm = $request->input('term');
        $results = User::where('users_type', 1)->where('no_hp', 'like', '%' . $searchTerm . '%')->distinct('no_hp')->pluck('no_hp');
        
        return response()->json($results);
    }

    public function getIdPembeli(Request $request)
    {
        $searchTerm = $request->input('term');
        $results = User::where('users_type', 1)->where('pembeli_id', 'like', '%' . $searchTerm . '%')->distinct('pembeli_id')->pluck('pembeli_id');
        
        return response()->json($results);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Mulai transaksi database

            // Validasi data dari request
            $validatedData = $request->validate([
                'outlet_id' => 'required|string',
                'SubTotal' => 'required|numeric',
                'product_id' => 'required|array',
                'product_id.*.product_id' => 'required|string',
                'product_id.*.qty' => 'required|numeric',
                'product_id.*.amount' => 'required|numeric',
                'product_id.*.sku' => 'required|string',
                'product_id.*.projectId' => 'required|string'
            ]);
            
            // Hitung total qty
            $totalQty = 0;
            foreach ($validatedData['product_id'] as $product) {
                $totalQty += $product['qty']; // Menghitung total qty
            }

            // Cek apakah kouta point tersedia atau tidak
            $cek_koutaPoint = ref_KuotaPoint::select('kuota_point')->where('outlet_id', $request->outlet_id)->first();
            if ($cek_koutaPoint->kuota_point - $totalQty < 0) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Transaksi Gagal : Stok Anda Tidak Cukup.'
                ], 422); // Menggunakan kode status 422 Unprocessable Entity
            }

            // Cek apakah pembeli_id atau nomor hp pembeli ada atau tidak
            $get_user = null;
            if ($request->pembeli_id != null) { // Pengecekan dengan pembeli_id
                $get_user = User::where('pembeli_id', $request->pembeli_id)->first();
                if ($get_user) {
                    $idPembeli = $get_user->pembeli_id;
                    $nomor_telfon = $get_user->no_hp;
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Transaksi Gagal : Pelanggan Belum Terdaftar.'
                    ], 422); // Menggunakan kode status 422 Unprocessable Entity
                }
            } else if ($request->noHp != null) { // Pengecekan dengan nomor hp
                $get_user = User::where('no_hp', $request->noHp)->first();
                if ($get_user) {
                    $idPembeli = $get_user->pembeli_id;
                    $nomor_telfon = $get_user->no_hp;
                } else {
                    $idPembeli = null;
                    $nomor_telfon = $request->noHp;
                }
            }

            // Generate invoice_no dan date_created
            $invoiceData = [
                'pembeli_id' => $idPembeli,
                'nomor_telfon' => $nomor_telfon,
                'qty' => $totalQty,
                'amount' => $validatedData['SubTotal'],
                'outlet_id' => $validatedData['outlet_id'],
                'rewards' => '0',
                'invoice_type' => 'I',
                'invoice_no' => 'MAI-' . strtoupper(Str::random(10)),
                'date_created' => Carbon::now()->timezone('Asia/Jakarta')
            ];
    
            // Menyimpan data ke database
            $invoice = Invoice_Master_Pembeli::create($invoiceData);
    
            $dataToInsert = [];
    
            foreach ($validatedData['product_id'] as $index => $product) {
                $qty = (int)$product['qty'];
                for ($i = 0; $i < $qty; $i++) {
                    $dataToInsert[] = [
                        'invoice_no' => $invoice->invoice_no,
                        'nomor_telfon' => $invoice->nomor_telfon,
                        'pembeli_id' => $invoice->pembeli_id,
                        'outlet_id' => $invoice->outlet_id,
                        'sku_id' => $product['sku'],
                        'qty' => 1,
                        'amount' => $product['amount'],
                        'project_id' => $product['projectId'],
                        'isbonus' => 0,
                        'ispoint' => 0,
                        'date_created' => Carbon::now()->timezone('Asia/Jakarta')
                    ];
                }
            }
    
            // Menyimpan data ke database
            Invoice_Detail_Pembeli::insert($dataToInsert);
    
            // Memanggil stored procedure untuk Update data
            DB::unprepared("EXEC maigroup.dbo.sum_point_user '{$invoice->nomor_telfon}', '{$invoice->outlet_id}'");
            DB::unprepared("EXEC maigroup.dbo.sum_bonus_user '{$invoice->nomor_telfon}', '{$invoice->outlet_id}'");
    
            DB::commit(); // Commit transaksi jika semua proses berhasil
    
            // Mengembalikan respon
            return response()->json(['message' => 'Invoice berhasil dibuat', 'data' => $invoice], 201);
        } catch (\Throwable $th) {
            // Jika terjadi kesalahan, tangkap exception dan kembalikan response error
            DB::rollback(); // Rollback the transaction in case of an exception

            Log::error($th); // Log the exception for debugging

            // Mengembalikan pesan error saat terjadi kesalahan
            return response()->json(['message' => 'Terjadi kesalahan: ' . $th->getMessage()], 500);
        }
    }
}
