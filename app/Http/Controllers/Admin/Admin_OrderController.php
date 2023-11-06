<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Ref_Project;
use App\Models\Ref_Produk;
use App\Models\Invoice_Master_Seller;

class Admin_OrderController extends Controller
{
    public function index(){
        $data = Invoice_Master_Seller::select(
                'invoice_master_seller.id as idInvoiceMasterSeller',
                'invoice_master_seller.outlet_id',
                'invoice_master_seller.invoice_no',
                'invoice_master_seller.qty',
                'invoice_master_seller.amount',
                'invoice_master_seller.project_id',
                'invoice_master_seller.progress',

                'ref_project.id as idProject',
                'ref_project.project_name'
            )
            ->leftJoin('ref_project','invoice_master_seller.project_id','=','ref_project.id')
            ->get();

        return view('master.order.daftarOrder', compact('data'));
    }

    public function orderDetail($invoice){
        $data = Invoice_Master_Seller::select(
                'invoice_master_seller.id as idInvoiceMasterSeller',
                'invoice_master_seller.outlet_id',
                'invoice_master_seller.invoice_no',
                'invoice_master_seller.qty',
                'invoice_master_seller.amount',
                'invoice_master_seller.project_id',
                'invoice_master_seller.progress',
                'invoice_master_seller.date_created',

                'invoice_detail_seller.id as idInvoiceDetailSeller',
                'invoice_detail_seller.invoice_no',
                'invoice_detail_seller.sku_id',
                'invoice_detail_seller.qty as qtyDetailSeller',
                'invoice_detail_seller.amount as amountDetailSeller',
                'invoice_detail_seller.discount',
                'invoice_detail_seller.total_amount',

                'ref_project.id as idProject',
                'ref_project.project_name',

                'ref_produks.id as idProduks',
                'ref_produks.sku',
                'ref_produks.nama_produk',
                'ref_produks.thumbnail',

                'outlets.id as idOutlets',
                'outlets.user_id',
                'outlets.nama_outlet',

                'users_details.id as idUserDetails',
                'users_details.user_id',
                'users_details.nomor_telfon',
                'users_details.kelurahan',
                'users_details.kecamatan',
                'users_details.kota_kabupaten',
                'users_details.provinsi',
                'users_details.kode_pos',
                'users_details.alamat_detail',

                'users_login.id as idUserLogin',
                'users_login.name',
                'users_login.username',

                'ref_kelurahan.kode_kelurahan',
                'ref_kelurahan.nama_kelurahan',

                'ref_kecamatan.kode_kecamatan',
                'ref_kecamatan.nama_kecamatan',

                'ref_kotakab.kode_kotakab',
                'ref_kotakab.nama_kotakab',

                'ref_propinsi.kode_propinsi',
                'ref_propinsi.nama_propinsi',
            )
            ->leftJoin('invoice_detail_seller','invoice_master_seller.invoice_no','=','invoice_detail_seller.invoice_no')
            ->leftJoin('ref_project','invoice_master_seller.project_id','=','ref_project.id')
            ->leftJoin('ref_produks','invoice_detail_seller.sku_id','=','ref_produks.sku')
            ->leftJoin('outlets','invoice_master_seller.outlet_id','=','outlets.outlet_id')
            ->leftJoin('users_details','outlets.user_id','=','users_details.user_id')
            ->leftJoin('users_login','users_details.user_id','=','users_login.id')
            ->leftJoin('ref_kelurahan','users_details.kelurahan','=','ref_kelurahan.kode_kelurahan')
            ->leftJoin('ref_kecamatan','users_details.kecamatan','=','ref_kecamatan.kode_kecamatan')
            ->leftJoin('ref_kotakab','users_details.kota_kabupaten','=','ref_kotakab.kode_kotakab')
            ->leftJoin('ref_propinsi','users_details.provinsi','=','ref_propinsi.kode_propinsi')
            ->where('invoice_master_seller.invoice_no', $invoice)
            ->first();
        
        return response()->json($data);
    }

    public function create(){
        $getOutlet      = Outlet::select('id','nama_outlet','outlet_id')->get();
        $getProduk      = Ref_Produk::select('id','sku','nama_produk','harga')->get();
        $getKategori    = Ref_Project::select('id','project_name')->get();

        return view('master.order.tambahOrder', compact('getOutlet','getProduk','getKategori'));
    }

    public function getHargaOrder($id)
    {
        $produk = Ref_Produk::find($id);
        $harga  = $produk->harga;

        return response()->json(['harga' => $harga]);
    }
}
