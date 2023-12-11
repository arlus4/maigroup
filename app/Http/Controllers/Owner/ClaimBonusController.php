<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Models\Log_Bonus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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


    public function konfirmasi_claim(Request $request)
    {
        $outletId = Auth::user()->outlet_id;
        $bonus = Log_Bonus::select(
            'log_bonus.date_claim',
            'log_bonus.date_gift',
            'log_bonus.is_claim',
            'log_bonus.is_gift',
            'log_bonus.nomor_telfon',
            'log_bonus.outlet_id',
            'log_bonus.pembeli_id',
            'log_bonus.voucher_code',
            'users_login.name'
            )
            ->leftJoin('users_login', 'log_bonus.pembeli_id', 'users_login.pembeli_id')
            ->where('log_bonus.voucher_code', $request->voucher_code)
            ->first();

        if ($bonus->outlet_id == $outletId) {
            if ($bonus->is_claim == 0) {
                $datas = [
                    'data' => $bonus
                ];
                return response()->json($datas, 200);
            } else {
                return response()->json(['message' => 'Voucher telah dipakai'], 404);
            }
        } else {
            return response()->json(['message' => 'Voucher tidak ditemukan'], 404);
        }
    }

    public function update_claim(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'pembeli_id'    => 'required',
                'voucher_code'  => 'required',
            ]);

            $outletId = Auth::user()->outlet_id;
        
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
    
            // Call the stored procedure
            DB::unprepared("EXEC maigroup.dbo.isclaim_bonus '{$request->voucher_code}', '{$request->pembeli_id}', '{$outletId}'");
            
            DB::commit();

            return response()->json(['message' => 'Prosedur berhasil dijalankan']);

        } catch (\Throwable $th) {
            DB::rollback();
            
            return response()->json(['error' => 'Terjadi Kesalahan: ' . $th->getMessage()], 500);
        }
    }

    public function konfirmasi_gift(Request $request)
    {
        $outletId = Auth::user()->outlet_id;
        $gift = Log_Bonus::select(
            'log_bonus.date_claim',
            'log_bonus.date_gift',
            'log_bonus.is_claim',
            'log_bonus.is_gift',
            'log_bonus.nomor_telfon',
            'log_bonus.outlet_id',
            'log_bonus.pembeli_id',
            'log_bonus.voucher_code',
            'users_login.name'
            )
            ->leftJoin('users_login', 'log_bonus.pembeli_id', 'users_login.pembeli_id')
            ->where('log_bonus.voucher_code', $request->voucher_code)
            ->first();

        if ($gift->outlet_id == $outletId) {
            if ($gift->is_gift == 0) {
                $datas = [
                    'data' => $gift
                ];
                return response()->json($datas, 200);
            } else {
                return response()->json(['message' => 'Voucher telah dipakai'], 404);
            }
        } else {
            return response()->json(['message' => 'Voucher tidak ditemukan'], 404);
        }
    }

    public function update_gift(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'pembeli_id'    => 'required',
                'voucher_code'  => 'required',
            ]);

            $outletId = Auth::user()->outlet_id;
        
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
    
            // Call the stored procedure
            DB::unprepared("EXEC maigroup.dbo.isgift_bonus '{$request->voucher_code}', '{$request->pembeli_id}', '{$outletId}'");
            
            DB::commit();

            return response()->json(['message' => 'Prosedur berhasil dijalankan']);

        } catch (\Throwable $th) {
            DB::rollback();
            
            return response()->json(['error' => 'Terjadi Kesalahan: ' . $th->getMessage()], 500);
        }
    }

    public function new_bonus()
    {
        return view('owner.bonus.daftarBonus', [
            'title' => "Bonus Pembeli Claim",
            'url'   => 'get_data_pembeli_claim'
        ]);
    }

    public function get_data_pembeli_claim()
    {
        $data = DB::select("SELECT
                    voucher_code, nomor_telfon, is_claim, is_gift, date_claim, date_gift, name
                FROM [maigroup].[dbo].[web.log_bonus_pembeli_claim] ('". Auth::user()->outlet_id ."')"
            );

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }

    public function new_bonus_gift()
    {
        return view('owner.bonus.daftarBonus', [
            'title' => "Pembeli Gift",
            'url'   => 'get_data_pembeli_gift'
        ]);
    }

    public function get_data_pembeli_gift()
    {
        $data = DB::select("SELECT
                voucher_code, nomor_telfon, is_claim, is_gift, date_claim, date_gift, name
            FROM [maigroup].[dbo].[web.log_bonus_pembeli_gift] ('". Auth::user()->outlet_id ."')"
        );

        $datas = [
            'data' => $data
        ];

        return response()->json($datas);
    }
}
