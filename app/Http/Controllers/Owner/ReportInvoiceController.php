<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Invoice_Master_Seller;
use App\Models\Invoice_Detail_Seller;


class ReportInvoiceController extends Controller
{
    public function index(){
        $getInvoice = Invoice_Master_Seller::select(
                'invoice_master_seller.outlet_id',
                'invoice_master_seller.invoice_no',
                'invoice_master_seller.qty',
                'invoice_master_seller.amount',
                'invoice_master_seller.project_id',
                'invoice_master_seller.progress',
                'invoice_master_seller.ongkir',
                'invoice_master_seller.total',
                'invoice_master_seller.kode_unik',

                'ref_project.project_name'
            )
            ->leftJoin('ref_project','invoice_master_seller.project_id','=','ref_project.id')
            ->where('invoice_master_seller.outlet_id', Auth::user()->outlet_id)
            ->orderBy('invoice_master_seller.progress','asc')
            ->get();

        return view('owner.reportInvoice', compact('getInvoice'));
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

        return view('owner.invoice', [
            'data'    => $data,
            'details' => $details
        ]);
    }
}
