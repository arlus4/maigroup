<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Check_Connection;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/check-connection', [Check_Connection::class, 'checkConnection']);
Route::get('/check-php', [Check_Connection::class, 'checkPhp']);

// Dashboard
Route::get('/dashboard', function () {
    return view('master.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/admin/kategori', function () {
    return view('master.kategori-produk.index');
})->middleware(['auth', 'verified'])->name('kategoriProduk');

Route::get('/dashboard/admin/manage-produk', function () {
    return view('master.produk.daftarProduk');
})->middleware(['auth', 'verified'])->name('daftarProduk');

Route::get('/dashboard/admin/tambah-produk', function () {
    return view('master.produk.tambahProduk');
})->middleware(['auth', 'verified'])->name('tambahProduk');
