<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Check_Connection;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Admin_Project_ProductController;
use App\Http\Controllers\Admin\Admin_ProductController;

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


// Bagian Prefix Admin
Route::group(['middleware' => ['admin:4']], function () {
    Route::get('/admin/dashboard', function () {
        return view('master.dashboard');
    })->name('dashboard');

    // Master Data
    Route::prefix('admin')->name('admin.')->group(function() {

        //Kategori Produk
        Route::get('/category_product', [Admin_Project_ProductController::class, 'index'])->name('admin_category_product');
        Route::get('/edit_category_product/{kategori_Product:slug}', [Admin_Project_ProductController::class, 'edit'])->name('admin_edit_category_product');
        Route::post('/store_category_product', [Admin_Project_ProductController::class, 'store'])->name('admin_store_category_product');
        Route::post('/update_category_product', [Admin_Project_ProductController::class, 'update'])->name('admin_update_category_product');
        Route::post('/delete_category_product', [Admin_Project_ProductController::class, 'destroy'])->name('admin_delete_category_product');
        Route::get('/kategoriProdukSlug', [Admin_Project_ProductController::class, 'kategoriProdukSlug']);        

        //Produk
        Route::get('/product', [Admin_ProductController::class, 'index'])->name('admin_product');
        Route::get('/tambah-product', [Admin_ProductController::class, 'create'])->name('admin_tambah_product');
        Route::post('/store_product', [Admin_ProductController::class, 'store'])->name('admin_store_product');
        Route::post('/update_product/{ref_Product:slug}', [Admin_ProductController::class, 'update'])->name('admin_update_product');
        Route::post('/delete_product', [Admin_ProductController::class, 'destroy'])->name('admin_delete_product');
        Route::get('/produkSlug', [Admin_ProductController::class, 'produkSlug']);        

    });
});


Route::get('/dashboard/admin/tambah-produk', function () {
    return view('master.produk.tambahProduk');
})->middleware(['auth', 'verified'])->name('tambahProduk');
