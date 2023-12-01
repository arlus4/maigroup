<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Invoice_Master_Pembeli;
use App\Models\Invoice_Master_Seller;
use App\Models\Invoice_Detail_Seller;


class ReportInvoiceController extends Controller
{
    public function invoicePembelian(){
        return view('owner.report-invoice.reportInvoicePembelian');
    }

    public function invoicePenjualan(){
        return view('owner.report-invoice.reportInvoicePenjualan');
    }

    public function getDataInvoicePembelian()
    {
        $data = DB::select("SELECT 
                invoice_no, qty, amount, progress, ongkir, total, kode_unik, date_created 
            FROM [maigroup].[dbo].[web.invoice_master_all] ('". Auth::user()->outlet_id ."')
            ORDER BY date_created DESC");

        $datas = [
            'data' => $data
        ];
        
        return response()->json($datas);
    }

    public function getDataInvoicePenjualan()
    {
        $data = DB::select("SELECT 
                invoice_no, qty, amount, rewards, name, no_hp, date_created
            FROM [maigroup].[dbo].[web.invoice_master_pembeli] ('". Auth::user()->outlet_id ."') 
            ORDER BY date_created DESC");

        $datas = [
            'data' => $data
        ];
    
        return response()->json($datas);
    }

    public function detailInvoicePembelian($invoice){
        $datas = DB::select("SELECT 
            outlet_id,
            invoice_no,
            qty,
            amount,
            date_created_invoice,
            ongkir,
            total,
            kode_unik,
            nama_outlet,
            no_hp_outlet,
            kodepos,
            alamat_detail,
            nama_kelurahan,
            nama_kotakab,
            nama_provinsi,
            nama_kecamatan

            FROM [maigroup].[dbo].[web.invoice_master_seller] ('". $invoice ."')
        ");
        $data = $datas[0];

        $detail = DB::select("SELECT 
            invoice_no,
            sku_id,
            qty,
            amount,
            discount,
            total_amount,
            project_name,
            nama_produk,
            path_thumbnail

            FROM [maigroup].[dbo].[web.invoice_detail_seller] ('". $invoice ."')
        ");

        if (!$detail) {
            redirect()->back()->with('error', 'Tidak Ada Detail');
        }

        return view('owner.report-invoice.detailInvoicePenjualan', [
            'data'     => $data,
            'details'  => $detail
        ]);
    }

    public function detailInvoicePenjualan($invoice){
        $data = Invoice_Master_Pembeli::select(
            'invoice_master_pembeli.outlet_id',
            'invoice_master_pembeli.invoice_no',
            'invoice_master_pembeli.amount',
            'invoice_master_pembeli.date_created',
            'invoice_master_pembeli.nomor_telfon',

            'users_login.name'
        )
        ->leftJoin('users_login','invoice_master_pembeli.nomor_telfon','=','users_login.no_hp')
        ->where('invoice_master_pembeli.invoice_no', $invoice)
        ->first();
        
        $detail = DB::select("SELECT 
            invoice_no,
            sku_id,
            amount,
            qty,
            nama_produk,
            path_thumbnail,
            project_name

            FROM [maigroup].[dbo].[web.invoice_detail_pembeli] ('". $invoice ."')
        ");

        if (!$detail) {
            redirect()->back()->with('error', 'Tidak Ada Detail');
        }

        return view('owner.report-invoice.detailInvoicePembelian', [
            'data'     => $data,
            'details'  => $detail
        ]);
    }

    public function downloadInvoice($invoice)
    {
        $master = DB::select("SELECT 
                invoice_no, nama_outlet, date_created_invoice, alamat_detail, nama_kelurahan, nama_kecamatan, nama_kotakab, nama_provinsi, kodepos, 
                amount, ongkir, kode_unik, total

            FROM [maigroup].[dbo].[web.invoice_master_seller] ('". $invoice ."')");
        $masterSeller = $master[0];

        $detail = DB::select("SELECT sku_id, path_thumbnail, nama_produk, project_name, qty, total_amount
                            FROM [maigroup].[dbo].[web.invoice_detail_seller] ('" . $invoice . "')");

        return view('owner.report-invoice.downloadInvoice', [
            'data'    => $masterSeller,
            'details' => $detail
        ]);
    }
}
