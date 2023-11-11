<?php

namespace App\Http\Controllers\Owner;

use App\Models\User;
use App\Models\Ref_Produk;
use App\Models\Product_Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class POSController extends Controller
{
    public function index(){
        $dataOutlet = Product_Outlet::
            select(
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

        return view('owner.pos', [
            'title' => 'Menu Order'
        ], compact('dataOutlet'));
    }

    public function getProduk($produkId){
        $produk = Ref_Produk::select('id','nama_produk','harga','path_thumbnail')->where('id', $produkId)->first();

        return response()->json($produk);
    }

    public function getNomorHP(Request $request)
    {
        // Dapatkan term pencarian dari query string menggunakan input 'term'
        $searchTerm = $request->input('term');
    
        // Cari di database untuk nomor HP yang cocok dengan term pencarian
        // 'like' digunakan untuk pencarian yang fleksibel
        $results = User::where('users_type', 1)->where('no_hp', 'like', '%' . $searchTerm . '%')->distinct('no_hp')->pluck('no_hp');
        
    
        // Kirim kembali hasil sebagai response JSON
        return response()->json($results);
    }   

    public function store(Request $request){
        dd($request);
    }
}
