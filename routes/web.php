<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Check_Connection;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Admin_Project_ProductController;
use App\Http\Controllers\Admin\Admin_ProductController;
use App\Http\Controllers\Admin\Admin_UserPenjualController;
use App\Http\Controllers\Admin\Admin_OrderController;

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

// Get Alamat
Route::get('/get_data_kotakab/{provinsi}', [AlamatController::class, 'get_data_kotakab']);
Route::get('/get_data_kecamatan/{kotakab}', [AlamatController::class, 'get_data_kecamatan']);
Route::get('/get_data_kelurahan/{kecamatan}', [AlamatController::class, 'get_data_kelurahan']);
Route::get('/get_data_kodepos/{kelurahan}', [AlamatController::class, 'get_data_kodepos']);


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
        Route::get('/edit-product/{ref_Product:slug}', [Admin_ProductController::class, 'edit'])->name('admin_edit_product');
        Route::post('/store_product', [Admin_ProductController::class, 'store'])->name('admin_store_product');
        Route::post('/update_product/{ref_Product:slug}', [Admin_ProductController::class, 'update'])->name('admin_update_product');
        Route::post('/delete_product', [Admin_ProductController::class, 'destroy'])->name('admin_delete_product');
        Route::get('/produkSlug', [Admin_ProductController::class, 'produkSlug']);        

        //User Penjual
        Route::get('/user-penjual', [Admin_UserPenjualController::class, 'index'])->name('admin_user_penjual');
        Route::get('/tambah-user-penjual', [Admin_UserPenjualController::class, 'create'])->name('admin_tambah_user_penjual');
        Route::get('/edit-user-penjual/{username}', [Admin_UserPenjualController::class, 'edit'])->name('admin_edit_user_penjual');
        Route::post('/store-user-penjual', [Admin_UserPenjualController::class, 'store'])->name('admin_store_user_penjual');
        Route::post('/update-user-penjual', [Admin_UserPenjualController::class, 'update'])->name('admin_update_user_penjual');
        Route::post('/update-toggle/{user}', [Admin_UserPenjualController::class, 'updateNotifications'])->name('admin_update_notif_user_penjual');
        Route::get('/outletSlug', [Admin_UserPenjualController::class, 'outletSlug']);

        //Order
        Route::get('/order', [Admin_OrderController::class, 'index'])->name('admin_order');

    });
});