<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Display_Controller extends Controller
{
    public function display_name_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
            'no_hp' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');
        $no_hp = $request->input('no_hp');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT users_type, username, no_hp, email FROM [dbo].[apps.display_name_user](?, ?)", [$pembeli_id, $no_hp]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function display_total_cup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT pembeli_id, amount, qty FROM [dbo].[apps.display_total_cup](?)", [$pembeli_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function display_total_point(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT pembeli_id, total_point, total_redeem, rewards FROM [dbo].[apps.display_total_point](?)", [$pembeli_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function notification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT pembeli_id, header, detail, tanggal FROM [dbo].[apps.notification](?)", [$pembeli_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function banner_promo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Memperbolehkan kota_kabupaten bernilai null
            'kota_kabupaten' => 'sometimes', 
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        
        // Menetapkan 'ALL' sebagai nilai default jika kota_kabupaten tidak ada atau null
        $kota_kabupaten = $request->input('kota_kabupaten', 'ALL');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT banner_code, banner_name, description, image_name, path, isall, kota_id, start_date, end_date
                FROM [dbo].[apps.banner_promo](?)", [$kota_kabupaten]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function banner_promo_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_code' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $banner_code = $request->input('banner_code');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT banner_code, banner_name, description, image_name, path
                FROM [dbo].[apps.banner_promo_detail](?)", [$banner_code]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function redeem_menu()
    {
        try {
            // Call the table-valued function
            $result = DB::select('SELECT type_title, colour, icon, isactive, err_msg FROM [maigroup].[dbo].[apps.redeem_menu]()');
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function redeem_item(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Memperbolehkan kota_kabupaten bernilai null
            'kota_kabupaten' => 'sometimes', 
            'types_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Menetapkan 'ALL' sebagai nilai default jika kota_kabupaten tidak ada atau null
        $kota_kabupaten = $request->input('kota_kabupaten', 'ALL');
        $types_id = $request->input('types_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT types_id, redeem_code, image_name, path, gift_name FROM [dbo].[apps.redeem_item](?)", [$types_id, $kota_kabupaten]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function redeem_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required',
            'point_redeem' => 'required',
            'redeem_code' => 'required',
            'amount' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Call the stored procedure
            DB::unprepared("EXEC maigroup.dbo.redeem_user '{$request->pembeli_id}', '{$request->point_redeem}', '{$request->redeem_code}', '{$request->amount}'");
            
            // Return the result
            return response()->json(['message' => 'Prosedur berhasil dijalankan']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function display_voucher(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
            'outlet_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');
        $outlet_id = $request->input('outlet_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT pembeli_id, voucher_code, outlet_id, map_location FROM [dbo].[apps.display_voucher](?, ?)", [$pembeli_id, $outlet_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function display_voucher_history(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
            'outlet_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');
        $outlet_id = $request->input('outlet_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT pembeli_id, voucher_code, tanggal_claim, nama_outlet, outlet_id FROM [dbo].[apps.display_voucher_history](?, ?)", [$pembeli_id, $outlet_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function riwayat_redeem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT pembeli_id, gift_name, redeem_no, tanggal_redeem, Point_Terpakai, status_delivery
                FROM [dbo].[apps.riwayat_redeem](?)", [$pembeli_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function riwayat_transaksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required',
            'year' => 'required',
            'month' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');
        $year = $request->input('year');
        $month = $request->input('month');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT Year, Month, project_name, invoice_no, pembeli_id, kode_outlet, nama_outlet, Tanggal, total_cup, total_harga
                FROM [dbo].[apps.riwayat_transaksi](?, ?, ?)", [$year, $month, $pembeli_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function riwayat_transaksi_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_id' => 'required',
            'year' => 'required',
            'month' => 'required',
            'outlet_id' => 'required',
            'invoice_no' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $pembeli_id = $request->input('pembeli_id');
        $year = $request->input('year');
        $month = $request->input('month');
        $outlet_id = $request->input('outlet_id');
        $invoice_no = $request->input('invoice_no');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT Year, Month, invoice_no, outlet_id, pembeli_id, kode_outlet, nama_produk, total_qty, total_harga
                FROM [dbo].[apps.riwayat_transaksi_detail](?, ?, ?, ?, ?)", [$year, $month, $pembeli_id, $outlet_id, $invoice_no]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function gerai_outlet()
    {
        try {
            // Call the table-valued function
            $result = DB::select('SELECT nama_outlet, outlet_id, image_name, path, area FROM [maigroup].[dbo].[apps.gerai_outlet]()');
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function gerai_outlet_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'outlet_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $outlet_id = $request->input('outlet_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT outlet_id, alamat_detail, map_location FROM [dbo].[apps.gerai_outlet_detail](?)", [$outlet_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function produk_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $project_id = $request->input('project_id');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT project_id, sku, nama_produk, slug, harga, thumbnail, path_thumbnail
                FROM [dbo].[apps.produk_list](?)", [$project_id]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function produk_list_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'sku' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $project_id = $request->input('project_id');
        $sku = $request->input('sku');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT project_id, sku, nama_produk, slug, harga, thumbnail, path_thumbnail, deskripsi
                FROM [dbo].[apps.produk_list_detail](?, ?)", [$project_id, $sku]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function news_article()
    {
        try {
            // Call the table-valued function
            $result = DB::select('SELECT TOP 5 news_code, image_name, path, headline, caption FROM [maigroup].[dbo].[apps.news_article]()');
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function news_article_img(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_code' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $news_code = $request->input('news_code');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT news_code, image_name, path FROM [dbo].[apps.news_article_img](?)", [$news_code]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }

    public function news_article_content(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_code' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $news_code = $request->input('news_code');

        try {
            // Call the table-valued function
            $result = DB::select("SELECT news_code, headline, news_content, tanggal FROM [dbo].[apps.news_article_content](?)", [$news_code]);
            
            // Return the result
            return response()->json($result, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Query Error: ' . $th->getMessage()], 500);
        }
    }
}
