<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Models\Log_Bonus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


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

    // Controller untuk Input QR Code
    public function store_qr_code(Request $request){
        dd($request);
    }

    public function new_bonus(){
        return view('owner.bonus.daftarBonus', [
            'title' => "Bonus Pembeli Claim",
            'url'   => 'get_data_pembeli_claim'
        ]);
    }

    public function get_data_pembeli_claim(){
        $data = DB::select("SELECT 
            voucher_code,
            nomor_telfon,
            is_claim,
            is_gift,
            date_claim,
            date_gift,
            name

            FROM [maigroup].[dbo].[web.log_bonus_pembeli_claim] ('". Auth::user()->outlet_id ."')
        ");

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }
}
