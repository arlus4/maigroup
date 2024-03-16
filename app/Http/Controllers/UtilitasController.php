<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Outlet;
use Illuminate\Http\Request;

class UtilitasController extends Controller
{
    public function get_data_outlet($brand_code)
    {
        $data = Outlet::select('outlet_code', 'outlet_name')->where('brand_code', $brand_code)->get();
        return response()->json($data);
    }

    public function validate_bannerCode(Request $request)
    {
        $bannerCode = $request->banner_code;
        $isUsed = Banner::where('banner_code', $bannerCode)->exists();

        return response()->json(['isUsed' => $isUsed]);
    }

    // public function validate_Edit_NoHp(Request $request)
    // {
    //     $bannerCode = $request->banner_code;
    //     $UserId = $request->id;
        
    //     // Mengecek apakah nomor HP sudah digunakan
    //     $user = Banner::where('banner_code', $bannerCode)->first();
    
    //     // Inisialisasi $isUsed sebagai false
    //     $isUsed = false;
    
    //     // Jika user ditemukan
    //     if ($user) {
    //         // Jika id diberikan dan tidak sama dengan user yang ditemukan, atau jika id tidak diberikan sama sekali
    //         if ($UserId !== null) {
    //             if ($user->id != $UserId) {
    //                 // Artinya ada nomor HP yang sama terdaftar di bawah user yang berbeda
    //                 $isUsed = true;
    //             }
    //         } else {
    //             // Jika tidak ada id yang diberikan dan nomor HP ditemukan, anggap nomor HP tersebut sudah digunakan
    //             $isUsed = false;
    //         }
    //     }
        
    //     return response()->json(['isUsed' => $isUsed]);
    // }
}
