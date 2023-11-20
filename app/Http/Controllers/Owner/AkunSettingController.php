<?php

namespace App\Http\Controllers\owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AkunSettingController extends Controller
{
    public function index($name){
        $loggedInUsername = Auth::user()->name;

        if ($loggedInUsername === $name) {
            // Jika nama pengguna cocok, lanjutkan ke tindakan yang diinginkan
            return view('owner_pengaturan_akun');
        } else {
            // Jika nama pengguna tidak cocok, arahkan ke halaman lain atau tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Nama pengguna tidak cocok');
        }
        return view('owner.pengaturanAkun');
    }
}
