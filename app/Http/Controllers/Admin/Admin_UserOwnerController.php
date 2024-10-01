<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Admin_UserOwnerController extends Controller
{
    public function getDataBrandOwner($username)
    {
        $getDatas = DB::select("SELECT idUserLogin FROM [maigroup].[dbo].[web.user_owner_detail] ('" . $username . "')");
        $getData = $getDatas[0];
        $brand = Brand::where('user_id', $getData->idUserLogin)->get();

        $datas = [
            'data' => $brand
        ];

        return response()->json($datas);
    }
    
    public function brandSlug(Request $request)
    {
        $slug = SlugService::createSlug(Brand::class, 'slug', $request->brand_name);

        return response()->json(['slug' => $slug]);
    }

    public function userSlug(Request $request)
    {
        $slug = SlugService::createSlug(User::class, 'username', $request->name);

        return response()->json(['username' => $slug]);
    }

    public function validateNoHp(Request $request)
    {
        $noHp   = $request->no_hp;
        $isUsed = User::where('no_hp', $noHp)->exists();

        return response()->json(['isUsed' => $isUsed]);
    }

    public function validate_Edit_NoHp(Request $request)
    {
        $noHp = $request->no_hp;
        $UserId = $request->id;
        
        // Mengecek apakah nomor HP sudah digunakan
        $user = User::where('no_hp', $noHp)->first();
    
        // Inisialisasi $isUsed sebagai false
        $isUsed = false;
    
        // Jika user ditemukan
        if ($user) {
            // Jika id diberikan dan tidak sama dengan user yang ditemukan, atau jika id tidak diberikan sama sekali
            if ($UserId !== null) {
                if ($user->id != $UserId) {
                    // Artinya ada nomor HP yang sama terdaftar di bawah user yang berbeda
                    $isUsed = true;
                }
            } else {
                // Jika tidak ada id yang diberikan dan nomor HP ditemukan, anggap nomor HP tersebut sudah digunakan
                $isUsed = false;
            }
        }
        
        return response()->json(['isUsed' => $isUsed]);
    }

    public function validateNoHp_brand(Request $request)
    {
        $noHp   = $request->no_hp;
        $isUsed = Brand::where('no_hp', $noHp)->exists();

        return response()->json(['isUsed' => $isUsed]);
    }

    public function validate_Edit_NoHp_brand(Request $request)
    {
        $noHp = $request->no_hp;
        $brandId = $request->brand_Code;
        
        // Mengecek apakah nomor HP sudah digunakan
        $brand = Brand::where('no_hp', $noHp)->first();
    
        // Inisialisasi $isUsed sebagai false
        $isUsed = false;
    
        // Jika brand ditemukan
        if ($brand) {
            // Jika brand_Code diberikan dan tidak sama dengan brand yang ditemukan, atau jika brand_Code tidak diberikan sama sekali
            if ($brandId !== null) {
                if ($brand->brand_code != $brandId) {
                    // Artinya ada nomor HP yang sama terdaftar di bawah brand yang berbeda
                    $isUsed = true;
                }
            } else {
                // Jika tidak ada brand_Code yang diberikan dan nomor HP ditemukan, anggap nomor HP tersebut sudah digunakan
                $isUsed = false;
            }
        }
        
        return response()->json(['isUsed' => $isUsed]);
    }

    public function validateUsername(Request $request)
    {
        $username = $request->username;
        $dipakai = User::where('username', $username)->exists();

        return response()->json(['dipakai' => $dipakai]);
    }

    public function validate_Edit_Username(Request $request)
    {
        $username = $request->username;
        $UserId = $request->id;
        
        // Mengecek apakah username sudah digunakan
        $user = User::where('username', $username)->first();
    
        // Inisialisasi $dipakai sebagai false
        $dipakai = false;
    
        // Jika user ditemukan
        if ($user) {
            // Jika id diberikan dan tidak sama dengan user yang ditemukan, atau jika id tidak diberikan sama sekali
            if ($UserId !== null) {
                if ($user->id != $UserId) {
                    // Artinya ada username yang sama terdaftar di bawah user yang berbeda
                    $dipakai = true;
                }
            } else {
                // Jika tidak ada id yang diberikan dan username ditemukan, anggap username tersebut sudah digunakan
                $dipakai = false;
            }
        }
        
        return response()->json(['dipakai' => $dipakai]);
    }

    public function validateEmail(Request $request)
    {
        $email = $request->email;
        $used = User::where('email', $email)->exists();

        return response()->json(['used' => $used]);
    }

    public function validate_Edit_Email(Request $request)
    {
        $email = $request->email;
        $UserId = $request->id;
        
        // Mengecek apakah email sudah digunakan
        $user = User::where('email', $email)->first();
    
        // Inisialisasi $used sebagai false
        $used = false;
    
        // Jika user ditemukan
        if ($user) {
            // Jika id diberikan dan tidak sama dengan user yang ditemukan, atau jika id tidak diberikan sama sekali
            if ($UserId !== null) {
                if ($user->id != $UserId) {
                    // Artinya ada email yang sama terdaftar di bawah user yang berbeda
                    $used = true;
                }
            } else {
                // Jika tidak ada id yang diberikan dan email ditemukan, anggap email tersebut sudah digunakan
                $used = false;
            }
        }
        
        return response()->json(['used' => $used]);
    }
}
