<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Outlet;
use App\Models\User;
use App\Models\Users_Pelanggan;
use App\Models\Users_Register;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Admin_DashboardController extends Controller
{
    public function index(): View
    {
        $totalOutlet = Outlet::all();
        $totalBrands = Brand::all();
        $totalUsers = User::where('users_type', 2)->get();
        $totalPembeli = Users_Pelanggan::all();
        return view('master.dashboard', [
            'totalOutlet' => $totalOutlet,
            'totalBrands' => $totalBrands,
            'totalUsers' => $totalUsers,
            'totalPembeli' => $totalPembeli,
        ]);
    }
}
