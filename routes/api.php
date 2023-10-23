<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth_Controller;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::get('/check-session', [SessionController::class, 'check']);
    return $request->user();
});
