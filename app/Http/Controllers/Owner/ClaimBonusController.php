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
        $data = Log_Bonus::select(
            'log_bonus.voucher_code',
            'log_bonus.nomor_telfon',
            'log_bonus.outlet_id',
            'log_bonus.is_claim',
            'log_bonus.is_gift',
            'log_bonus.date_claim',
            'log_bonus.date_gift',
            'log_bonus.date_created',

            'users_login.name',
            'users_login.email'
        )
        ->leftJoin('users_login','log_bonus.nomor_telfon','=','users_login.no_hp')
        ->where('log_bonus.outlet_id', Auth::user()->outlet_id)
        ->get();

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }
}
