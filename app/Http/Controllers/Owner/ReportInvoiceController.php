<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Invoice_Master_Seller;


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

                'ref_project.project_name'
            )
            ->leftJoin('ref_project','invoice_master_seller.project_id','=','ref_project.id')
            ->where('invoice_master_seller.outlet_id', Auth::user()->outlet_id)
            ->orderBy('invoice_master_seller.progress','asc')
            ->get();

        return view('owner.reportInvoice', compact('getInvoice'));
    }
}
