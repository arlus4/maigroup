<?php

namespace App\Http\Controllers\Owner;

use App\Models\Outlet;
use App\Models\Product_Outlet;
use App\Models\ref_KuotaPoint;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $cek_outlet = Outlet::where('user_id', Auth::user()->id)->count();
        // Jika Belum Memiliki Outlet Maka harus mendaftarkan outlet terlebih dahulu
        if ($cek_outlet == 0) {
            return redirect('/owner/createOutlet')->with('error', 'Anda Belum Memiliki Outlet Maka harus mendaftarkan outlet terlebih dahulu');
        } else {
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
