<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin_OrderController extends Controller
{
    public function index(){
        return view('master.order.daftarOrder');
    }
}
