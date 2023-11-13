<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth_Controller;
use App\Http\Controllers\API\Display_Controller;
use App\Http\Controllers\API\Invoice_Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [Auth_Controller::class, 'login']);
Route::post('logout', [Auth_Controller::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [Auth_Controller::class, 'register']);

Route::post('/display_name_user', [Display_Controller::class, 'display_name_user']);
Route::post('/display_total_cup', [Display_Controller::class, 'display_total_cup']);
Route::post('/display_total_point', [Display_Controller::class, 'display_total_point']);

Route::post('/notification', [Display_Controller::class, 'notification']);
Route::post('/banner_promo', [Display_Controller::class, 'banner_promo']);
Route::post('/banner_promo_detail', [Display_Controller::class, 'banner_promo_detail']);

Route::get('/redeem_menu', [Display_Controller::class, 'redeem_menu']);
Route::post('/redeem_item', [Display_Controller::class, 'redeem_item']);
Route::post('/redeem_user', [Display_Controller::class, 'redeem_user']);

Route::post('/display_voucher', [Display_Controller::class, 'display_voucher']);
Route::post('/display_voucher_history', [Display_Controller::class, 'display_voucher_history']);

Route::post('/riwayat_redeem', [Display_Controller::class, 'riwayat_redeem']);
Route::post('/riwayat_transaksi', [Display_Controller::class, 'riwayat_transaksi']);
Route::post('/riwayat_transaksi_detail', [Display_Controller::class, 'riwayat_transaksi_detail']);

Route::get('/gerai_outlet', [Display_Controller::class, 'gerai_outlet']);
Route::post('/gerai_outlet_detail', [Display_Controller::class, 'gerai_outlet_detail']);

Route::post('/produk_list', [Display_Controller::class, 'produk_list']);
Route::post('/produk_list_detail', [Display_Controller::class, 'produk_list_detail']);

Route::get('/news_article', [Display_Controller::class, 'news_article']);
Route::post('/news_article_img', [Display_Controller::class, 'news_article_img']);
Route::post('/news_article_content', [Display_Controller::class, 'news_article_content']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     Route::post('/sum_bonus_user', [Invoice_Controller::class, 'sumBonusUser']);
    //     return $request->user();
    // });
    
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sum_bonus_user', [Invoice_Controller::class, 'sumBonusUser']);
    Route::post('/sum_point', [Invoice_Controller::class, 'sumPoint']);
    Route::post('/update_claim', [Invoice_Controller::class, 'update_claim']);
});

// Route::post('/buat_invoice_master', [Invoice_Controller::class, 'create_invoice_master_pembeli']);
// Route::post('/buat_invoice_master', [Penjual_OrderController::class, 'store']);