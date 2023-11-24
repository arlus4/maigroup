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

    public function getDataInvoicePembelian(){
        $data = DB::select("SELECT 
            outlet_id,
            invoice_no,
            qty,
            amount,
            progress,
            ongkir,
            total,
            kode_unik

            FROM [maigroup].[dbo].[web.invoice_master_all] ('". Auth::user()->outlet_id ."')
        ");

        $datas = [
            'data' => $data
        ];
        
        return response()->json($datas);
    }

    public function getDataInvoicePenjualan(){
        $data = DB::select("SELECT 
            invoice_no,
            qty,
            amount,
            outlet_id,
            rewards,
            name,
            no_hp
        
            FROM [maigroup].[dbo].[web.invoice_master_pembeli] ('". Auth::user()->outlet_id ."')
        ");

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
        $data = Invoice_Master_Seller::select
        (
            'invoice_master_seller.id as idInvoiceMasterSeller',
            'invoice_master_seller.outlet_id',
            'invoice_master_seller.invoice_no',
            'invoice_master_seller.qty',
            'invoice_master_seller.amount',
            'invoice_master_seller.date_created',
            'invoice_master_seller.ongkir',
            'invoice_master_seller.total',
            'invoice_master_seller.kode_unik',
            
            'outlets.id as idOutlets',
            'outlets.user_id',
            'outlets.nama_outlet',
            
            'users_details.nomor_telfon',
            'users_details.kode_pos',
            'users_details.alamat_detail',
            
            'ref_kelurahan.kode_kelurahan',
            'ref_kelurahan.nama_kelurahan',
            'ref_kecamatan.nama_kecamatan',
            'ref_kotakab.nama_kotakab',
            'ref_propinsi.nama_propinsi',
        )
        ->leftJoin('outlets','invoice_master_seller.outlet_id','=','outlets.outlet_id')
        ->leftJoin('users_details','outlets.user_id','=','users_details.user_id')
        ->leftJoin('ref_kelurahan','users_details.kelurahan','=','ref_kelurahan.kode_kelurahan')
        ->leftJoin('ref_kecamatan','users_details.kecamatan','=','ref_kecamatan.kode_kecamatan')
        ->leftJoin('ref_kotakab','users_details.kota_kabupaten','=','ref_kotakab.kode_kotakab')
        ->leftJoin('ref_propinsi','users_details.provinsi','=','ref_propinsi.kode_propinsi')
        ->where('invoice_master_seller.invoice_no', $invoice)
        ->first();

        $details = Invoice_Detail_Seller::select(
            'invoice_detail_seller.invoice_no',
            'invoice_detail_seller.sku_id',
            'invoice_detail_seller.qty as qtyDetailSeller',
            'invoice_detail_seller.amount as amountDetailSeller',
            'invoice_detail_seller.discount',
            'invoice_detail_seller.total_amount',
            'invoice_detail_seller.project_id',
            
            'ref_produks.sku',
            'ref_produks.nama_produk',
            'ref_produks.path_thumbnail',

            'ref_project.project_name',
        )
        ->leftJoin('ref_produks', 'invoice_detail_seller.sku_id', '=', 'ref_produks.sku')
        ->leftJoin('ref_project', 'invoice_detail_seller.project_id', '=', 'ref_project.id')
        ->where('invoice_detail_seller.invoice_no', $invoice)
        ->get();

        return view('owner.report-invoice.downloadInvoice', [
            'data'    => $data,
            'details' => $details
        ]);
    }
}
