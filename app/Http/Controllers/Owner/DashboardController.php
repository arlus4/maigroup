<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Models\Product_Outlet;
use App\Models\ref_KuotaPoint;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $dataProdukOutlet = Product_Outlet::select(
            'product_outlets.outlet_id',
            'product_outlets.category_id',
            'product_outlets.product_id',
            'product_outlets.jumlah',

            'ref_project.project_name',

            'ref_produks.sku',
            'ref_produks.nama_produk',
            'ref_produks.path_thumbnail'
        )
        ->leftJoin('ref_project','product_outlets.category_id','=','ref_project.id')
        ->leftJoin('ref_produks','product_outlets.product_id','=','ref_produks.id')
        ->where('outlet_id', Auth::user()->outlet_id)
        ->get();

        $totalRefKuotaPoint = ref_KuotaPoint::select(
                'outlet_id',
                'kuota_point',
            )
            ->where('outlet_id', Auth::user()->outlet_id)
            ->first();

        return view('owner.dashboard', compact('dataProdukOutlet', 'totalRefKuotaPoint'));
    }

    public function getDataStockReport(){
        $dataProdukOutlet = Product_Outlet::select(
            'product_outlets.outlet_id',
            'product_outlets.category_id',
            'product_outlets.product_id',
            'product_outlets.jumlah',

            'ref_project.project_name',

            'ref_produks.sku',
            'ref_produks.nama_produk',
            'ref_produks.path_thumbnail'
        )
        ->leftJoin('ref_project','product_outlets.category_id','=','ref_project.id')
        ->leftJoin('ref_produks','product_outlets.product_id','=','ref_produks.id')
        ->where('outlet_id', Auth::user()->outlet_id)
        ->get();

        $datas = [
            'data' => $dataProdukOutlet
        ];

        return response()->json($datas);
    }
}
