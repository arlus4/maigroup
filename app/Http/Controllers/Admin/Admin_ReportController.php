<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class Admin_ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report_inovice(): View
    {
        return view('master.report.reportInvoice',[
            'title' => 'Report Invoice'
        ]);
    }

    public function get_data_report_invoice()
    {
        $master = DB::select("SELECT 
                outlet_id, invoice_no, amount, progress, ongkir, total, kode_unik, date_created
            FROM [maigroup].[dbo].[web.invoice_master_seller_admin] ()");

        $datas = [
            'data' => $master
        ];

        return response()->json($datas);
    }
}
