<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Check_Connection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-connection', [Check_Connection::class, 'checkConnection']);
Route::get('/check-php', [Check_Connection::class, 'checkPhp']);
