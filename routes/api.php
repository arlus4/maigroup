<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth_Controller;
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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     Route::post('/sum_bonus_user', [Invoice_Controller::class, 'sumBonusUser']);
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sum_bonus_user', [Invoice_Controller::class, 'sumBonusUser']);
    Route::get('/sum_point/{pembeli_id}/{outlet_id}', [Invoice_Controller::class, 'sumPoint']);
});
