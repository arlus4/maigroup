<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class UtilitasController extends Controller
{
    public function get_data_outlet($brand_code)
    {
        $data = Outlet::select('outlet_code', 'outlet_name')->where('brand_code', $brand_code)->get();
        return response()->json($data);
    }
}
