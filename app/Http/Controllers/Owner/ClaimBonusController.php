<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClaimBonusController extends Controller
{
    public function claim_bonus()
    {
        return view('owner.claimBonus');
    }
    
    public function store_claim_bonus(Request $request)
    {
        $qrCode = $request->query('code');
        // Proses QR Code di sini, misalnya mencari data dalam database

        return view('hasil_scan', ['qrCode' => $qrCode]); // Tampilkan hasil atau lakukan aksi lain
    }
}
