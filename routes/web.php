<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\Check_Connection;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UtilitasController;
use App\Http\Controllers\Owner\OutletsController;
use App\Http\Controllers\Owner\RestockController;
use App\Http\Controllers\Admin\Admin_FaQController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\MenuOrderController;
use App\Http\Controllers\Admin\Admin_BankController;

use App\Http\Controllers\Owner\ClaimBonusController;
use App\Http\Controllers\Admin\Admin_OrderController;
use App\Http\Controllers\Owner\AkunSettingController;
use App\Http\Controllers\Admin\Admin_BannerController;
use App\Http\Controllers\Admin\Admin_BrandsController;
use App\Http\Controllers\Admin\Admin_OutletController;
use App\Http\Controllers\Admin\Admin_ReportController;
use App\Http\Controllers\Admin\Admin_ArtikelController;
use App\Http\Controllers\Admin\Admin_ProductController;
use App\Http\Controllers\Owner\ReportInvoiceController;
use App\Http\Controllers\Admin\Admin_UserOwnerController;
use App\Http\Controllers\Admin\Admin_UserPenjualController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Admin_Brands_CategoryController;
use App\Http\Controllers\Admin\Admin_NotificationController;
use App\Http\Controllers\Admin\Admin_PegawaiController;
use App\Http\Controllers\Admin\Admin_Point_PriceController;
use App\Http\Controllers\Admin\Admin_Product_CategoryController;
use App\Http\Controllers\Admin\Admin_SubscriberController;

Route::get('/', [HomeController::class, 'home']);
// Route::get('/', [AuthenticatedSessionController::class, 'create']);

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

Route::get('/get_data_outlet/{brand_code}', [UtilitasController::class, 'get_data_outlet']);
Route::get('/validate_bannerCode', [UtilitasController::class, 'validate_bannerCode']);

// Bagian Middleware & Prefix Admin
Route::group(['middleware' => ['admin:4', 'auth', 'verified', 'role:admin']], function () {

    // Master Data
    Route::prefix('admin')->name('admin.')->group(function() {

        Route::get('/dashboard', function () {
            return view('master.dashboard');
        })->name('dashboard-admin');

        //Kategori Produk

        //Produk
        // Route::get('/product', [Admin_ProductController::class, 'index'])->name('admin_product');
        // Route::get('/tambah-product', [Admin_ProductController::class, 'create'])->name('admin_tambah_product');
        // Route::get('/edit-product/{ref_Product:slug}', [Admin_ProductController::class, 'edit'])->name('admin_edit_product');
        // Route::post('/store_product', [Admin_ProductController::class, 'store'])->name('admin_store_product');
        // Route::post('/update_product/{ref_Product:slug}', [Admin_ProductController::class, 'update'])->name('admin_update_product');
        // Route::post('/delete_product', [Admin_ProductController::class, 'destroy'])->name('admin_delete_product');
        // Route::get('/produkSlug', [Admin_ProductController::class, 'produkSlug']);

        //User Owner
        Route::get('/user-owner', [Admin_UserOwnerController::class, 'index'])->name('admin_user_owner');
        Route::get('/tambah-user-owner', [Admin_UserOwnerController::class, 'create'])->name('admin_tambah_user_owner');
        Route::get('/manaj-brands/{username}', [Admin_UserOwnerController::class, 'showManageBrands'])->name('admin_brands_user_owner');
        Route::get('/edit-user-owner/{username}', [Admin_UserOwnerController::class, 'edit'])->name('admin_edit_user_owner');
        Route::get('/detail-user-owner/{username}', [Admin_UserOwnerController::class, 'show'])->name('admin_detail_user_owner');
        Route::post('/update-nohp-user-owner', [Admin_UserOwnerController::class, 'updatenoHPOwner']);
        Route::post('/update-email-user-owner', [Admin_UserOwnerController::class, 'updateEmailOwner']);
        Route::post('/update-password-user-owner', [Admin_UserOwnerController::class, 'updatePasswordOwner']);
        Route::post('/sign-out-users', [Admin_UserOwnerController::class, 'deleteSessionOwner']);
        Route::post('/store-user-owner', [Admin_UserOwnerController::class, 'store'])->name('admin_store_user_owner');
        Route::post('/update-user-owner', [Admin_UserOwnerController::class, 'update'])->name('admin_update_user_owner');
        Route::post('/update-toggle/{user}', [Admin_UserOwnerController::class, 'updateNotifications'])->name('admin_update_notif_user_owner');
        Route::get('/user-pending', [Admin_UserOwnerController::class, 'index_userPending'])->name('admin_user_pending');
        Route::get('/detail-user-pending/{id}', [Admin_UserOwnerController::class, 'detail_userPending'])->name('admin_detail_user_pending');
        Route::post('/approve-user-pending', [Admin_UserOwnerController::class, 'approve_UserPending'])->name('admin_approve_user_pending');
        Route::post('/reject-user-pending', [Admin_UserOwnerController::class, 'reject_UserPending'])->name('admin_reject_user_pending');
        Route::get('/user-reject', [Admin_UserOwnerController::class, 'index_userReject'])->name('admin_user_reject');

        // utilitas
        Route::get('/userSlug', [Admin_UserOwnerController::class, 'userSlug']);
        Route::get('/brandSlug', [Admin_UserOwnerController::class, 'brandSlug']);
        Route::get('/get_data_user_owner', [Admin_UserOwnerController::class, 'getDataUserOwner']);
        Route::get('/get_data_user_pending', [Admin_UserOwnerController::class, 'getDataPending']);
        Route::get('/get_data_detail_user_pending', [Admin_UserOwnerController::class, 'getDataDetailUserPending']);
        Route::get('/get_data_brand_owner/{username}', [Admin_UserOwnerController::class, 'getDataBrandOwner']);
        Route::get('/validateNoHp', [Admin_UserOwnerController::class, 'validateNoHp']);
        Route::get('/validate_Edit_NoHp', [Admin_UserOwnerController::class, 'validate_Edit_NoHp']);
        Route::get('/validateUsername', [Admin_UserOwnerController::class, 'validateUsername']);
        Route::get('/validate_Edit_Username', [Admin_UserOwnerController::class, 'validate_Edit_Username']);
        Route::get('/validateEmail', [Admin_UserOwnerController::class, 'validateEmail']);
        Route::get('/validate_Edit_Email', [Admin_UserOwnerController::class, 'validate_Edit_Email']);
        Route::get('/validateEmailPegawai', [Admin_PegawaiController::class, 'validateEmailPegawai']);
        
        // Manajemen Brand
        Route::get('/request_point_brands', [Admin_BrandsController::class, 'index_requestPoint'])->name('admin_request_point');
        Route::get('/getDataRequestPoint', [Admin_BrandsController::class, 'getDataRequestPoint']);
        Route::get('/getDataRequestLog', [Admin_BrandsController::class, 'getDataRequestLog']);
        Route::get('/detailRequestPoint/{id}', [Admin_BrandsController::class, 'detailRequestPoint']);
        Route::post('/approveRequestPoint', [Admin_BrandsController::class, 'approveRequestPoint']);
        Route::post('/rejectRequestPoint', [Admin_BrandsController::class, 'rejectRequestPoint']);
        
        Route::get('/brand-active', [Admin_BrandsController::class, 'index_brandActive'])->name('admin_brand_active');
        Route::get('/getDatabrandActive', [Admin_BrandsController::class, 'getDatabrandActive']);
        Route::get('/detail-user-brand/{brand}', [Admin_BrandsController::class, 'detailBrands'])->name('admin_brand_detail');
        Route::get('/brand-pending', [Admin_BrandsController::class, 'index_brandPending'])->name('admin_brand_pending');
        Route::get('/get_data_detail_brand_pending', [Admin_BrandsController::class, 'getDataDetailBrandPending']);
        Route::get('/getDatabrandPending', [Admin_BrandsController::class, 'getDatabrandPending']);
        Route::get('/detail-brand-pending/{brand_regis}', [Admin_BrandsController::class, 'detail_BrandPending'])->name('admin_detail_brand_detail');
        Route::post('/approve-brand-pending', [Admin_BrandsController::class, 'approve_BrandPending'])->name('admin_approve_brand_pending');
        Route::post('/reject-brand-pending', [Admin_BrandsController::class, 'reject_BrandPending'])->name('admin_reject_brand_pending');
        Route::get('/brand-reject', [Admin_BrandsController::class, 'index_brandReject'])->name('admin_brand_reject');
        Route::get('/getDatabrandReject', [Admin_BrandsController::class, 'getDatabrandReject']);

        // Brand Owner
        Route::get('/create_New_Brands/{username}', [Admin_BrandsController::class, 'create_New_Brands'])->name('admin_create_new_brands');
        Route::post('/store_New_Brands', [Admin_BrandsController::class, 'store_New_Brands'])->name('admin_store_new_brands');
        Route::get('/edit_New_Brands/{brand}', [Admin_BrandsController::class, 'edit_New_Brands'])->name('admin_edit_new_brands');
        Route::post('/update_New_Brands/{brand}', [Admin_BrandsController::class, 'update_New_Brands'])->name('admin_update_new_brands');
        Route::get('/validateNoHp_brand', [Admin_UserOwnerController::class, 'validateNoHp_brand']);
        Route::get('/validate_Edit_NoHp_brand', [Admin_UserOwnerController::class, 'validate_Edit_NoHp_brand']);

        // Brand Category
        Route::get('/brandCategory', [Admin_Brands_CategoryController::class, 'index'])->name('admin_brand_category');
        Route::get('/get_data_brandCategory', [Admin_Brands_CategoryController::class, 'get_data_brandCategory']);
        Route::get('/catBrandSlug', [Admin_Brands_CategoryController::class, 'catBrandSlug']);
        Route::post('/add_brandCategory', [Admin_Brands_CategoryController::class, 'store'])->name('admin_store_brand_category');
        Route::get('/edit_brandCategory', [Admin_Brands_CategoryController::class, 'edit'])->name('admin_edit_brandCategory');
        Route::post('/update_brandCategory', [Admin_Brands_CategoryController::class, 'update'])->name('admin_update_brand_category');
        Route::post('/delete_brandCategory', [Admin_Brands_CategoryController::class, 'destroy'])->name('admin_delete_brand_category');

        // Manajemen Outlet
        Route::get('/outlet-active', [Admin_OutletController::class, 'index_outletActive'])->name('admin_outlet_active');
        Route::get('/getDataoutletActive', [Admin_OutletController::class, 'getDataoutletActive']);
        Route::get('/detail-outlet/{outlet:slug}', [Admin_OutletController::class, 'detail_Outlet'])->name('admin_outlet_detail');
        Route::get('/getDataPegawaiOutlet/{outlet:slug}', [Admin_OutletController::class, 'getDataPegawaiOutlet']);
        Route::get('/getDataProductOutlet/{outlet:slug}', [Admin_OutletController::class, 'getDataProductOutlet']);
        Route::get('/daftar-pegawai', [Admin_PegawaiController::class, 'index'])->name('admin_pegawai_outlet');
        Route::get('/getDataListPegawai', [Admin_PegawaiController::class, 'getDataListPegawai']);
        Route::get('/detail-pegawai/{id}', [Admin_PegawaiController::class, 'show']);
        Route::get('/get_data_detail_profile_pegawai/{id}', [Admin_PegawaiController::class, 'getDataDetailProfilePegawai']);
        Route::post('/update-email-user-pegawai', [Admin_PegawaiController::class, 'updateEmailPegawai']);
        Route::post('/update-password-user-pegawai', [Admin_PegawaiController::class, 'updatePasswordPegawai']);
        Route::post('/update-status-user-pegawai', [Admin_PegawaiController::class, 'updateStatusPegawai']);
        // Jangan Dihapus!!!
        // Route::get('/outlet-pending', [Admin_OutletController::class, 'index_outletPending'])->name('admin_outlet_pending');
        // Route::get('/getDataoutletPending', [Admin_OutletController::class, 'getDataoutletPending']);
        // Route::get('/get_data_detail_outlet_pending', [Admin_OutletController::class, 'getDataDetailOutletPending']);
        // Route::get('/detail-outlet-pending/{outlet}', [Admin_OutletController::class, 'detail_OutletPending'])->name('admin_outlet_pending_detail');
        // Route::post('/approve-outlet-pending', [Admin_OutletController::class, 'approve_OutletPending'])->name('admin_approve_outlet_pending');
        // Route::post('/reject-outlet-pending', [Admin_OutletController::class, 'reject_OutletPending'])->name('admin_reject_outlet_pending');
        // Route::get('/outlet-reject', [Admin_OutletController::class, 'index_outletReject'])->name('admin_outlet_reject');
        // Route::get('/getDataoutletReject', [Admin_OutletController::class, 'getDataoutletReject']);
        // Jangan Dihapus!!!

        // Category Product
        Route::get('/category-product', [Admin_Product_CategoryController::class, 'index'])->name('admin_category_product');
        Route::get('/catProductSlug', [Admin_Product_CategoryController::class, 'catProductSlug']);
        Route::get('/getDataProductCategory', [Admin_Product_CategoryController::class, 'getDataProductCategory']);
        Route::post('/add_productCategory', [Admin_Product_CategoryController::class, 'store'])->name('admin_store_category_product');
        Route::get('/edit_productCategory', [Admin_Product_CategoryController::class, 'edit'])->name('admin_edit_category_product');
        Route::post('/update_productCategory', [Admin_Product_CategoryController::class, 'update'])->name('admin_update_category_product');
        Route::post('/delete_productCategory', [Admin_Product_CategoryController::class, 'destroy'])->name('admin_delete_category_product');
        
        
        //Banner
        Route::get('/banner', [Admin_BannerController::class, 'index'])->name('admin_banner');
        Route::get('/create_banner', [Admin_BannerController::class, 'create'])->name('admin_create_banner');
        Route::post('/store_banner', [Admin_BannerController::class, 'store'])->name('admin_store_banner');
        Route::get('/get_detail_banner/{banner}', [Admin_BannerController::class, 'get_detail_banner'])->name('admin_detail_banner');
        Route::get('/edit_banner/{banner}', [Admin_BannerController::class, 'edit'])->name('admin_edit_banner');
        Route::post('/update_banner/{banner}', [Admin_BannerController::class, 'update'])->name('admin_update_banner');
        Route::post('/destroy_banner/{banner}', [Admin_BannerController::class, 'destroy'])->name('admin_destroy_banner');

        //Setting-FaQ-Categories
        Route::get('/setting/faq/categories', [Admin_FaQController::class, 'faq_categories'])->name('admin_faq_categories');
        Route::get('/setting/faq/categories/get_data_faq_category', [Admin_FaQController::class, 'get_data_faq_category']);
        Route::get('/catFaQSlug', [Admin_FaQController::class, 'catFaQSlug']);
        Route::post('/faq_category_store', [Admin_FaQController::class, 'faq_category_store'])->name('admin_faq_category_store');
        Route::get('/setting/faq/categories/faq_category_edit', [Admin_FaQController::class, 'faq_category_edit'])->name('admin_faq_category_edit');
        Route::post('/setting/faq/categories/faq_category_update', [Admin_FaQController::class, 'faq_category_update'])->name('admin_faq_category_update');
        Route::post('/setting/faq/categories/faq_category_delete', [Admin_FaQController::class, 'faq_category_delete'])->name('admin_faq_category_delete');
        
        Route::get('/setting/faq', [Admin_FaQController::class, 'faq'])->name('admin_faq');
        //Setting-FaQ-Pembeli
        Route::get('/setting/faq/user/pembeli', [Admin_FaQController::class, 'faq_user_pembeli'])->name('admin_faq_user_pembeli');
        Route::get('/setting/faq/user/get_data_faq_user_pembeli', [Admin_FaQController::class, 'get_data_faq_user_pembeli']);
        Route::post('/setting/faq/user/faq_user_pembeli_store', [Admin_FaQController::class, 'faq_user_pembeli_store'])->name('admin_faq_user_pembeli_store');
        Route::get('/setting/faq/user/faq_user_pembeli_edit', [Admin_FaQController::class, 'faq_user_pembeli_edit'])->name('admin_faq_user_pembeli_edit');
        Route::post('/setting/faq/user/faq_user_pembeli_update', [Admin_FaQController::class, 'faq_user_pembeli_update'])->name('admin_faq_user_pembeli_update');
        Route::post('/setting/faq/user/faq_user_pembeli_delete', [Admin_FaQController::class, 'faq_user_pembeli_delete'])->name('admin_faq_user_pembeli_delete');
        //Setting-FaQ-Owner
        Route::get('/setting/faq/user/owner', [Admin_FaQController::class, 'faq_user_owner'])->name('admin_faq_user_owner');
        Route::get('/setting/faq/user/get_data_faq_user_owner', [Admin_FaQController::class, 'get_data_faq_user_owner']);
        Route::post('/setting/faq/user/faq_user_owner_store', [Admin_FaQController::class, 'faq_user_owner_store'])->name('admin_faq_user_owner_store');
        Route::get('/setting/faq/user/faq_user_owner_edit', [Admin_FaQController::class, 'faq_user_owner_edit'])->name('admin_faq_user_owner_edit');
        Route::post('/setting/faq/user/faq_user_owner_update', [Admin_FaQController::class, 'faq_user_owner_update'])->name('admin_faq_user_owner_update');
        Route::post('/setting/faq/user/faq_user_owner_delete', [Admin_FaQController::class, 'faq_user_owner_delete'])->name('admin_faq_user_owner_delete');
        //Setting-FaQ-Pegawai
        Route::get('/setting/faq/user/pegawai', [Admin_FaQController::class, 'faq_user_pegawai'])->name('admin_faq_user_pegawai');
        Route::get('/setting/faq/user/get_data_faq_user_pegawai', [Admin_FaQController::class, 'get_data_faq_user_pegawai']);
        Route::post('/setting/faq/user/faq_user_pegawai_store', [Admin_FaQController::class, 'faq_user_pegawai_store'])->name('admin_faq_user_pegawai_store');
        Route::get('/setting/faq/user/faq_user_pegawai_edit', [Admin_FaQController::class, 'faq_user_pegawai_edit'])->name('admin_faq_user_pegawai_edit');
        Route::post('/setting/faq/user/faq_user_pegawai_update', [Admin_FaQController::class, 'faq_user_pegawai_update'])->name('admin_faq_user_pegawai_update');
        Route::post('/setting/faq/user/faq_user_pegawai_delete', [Admin_FaQController::class, 'faq_user_pegawai_delete'])->name('admin_faq_user_pegawai_delete');
        //Setting-Subscribe
        Route::get('/setting/subscribe', [Admin_SubscriberController::class, 'index'])->name('admin_subscribe');
        Route::get('/setting/subscriber_detail/{id}', [Admin_SubscriberController::class, 'subscriber_detail']);
        Route::post('/setting/update_subscribe/{id}', [Admin_SubscriberController::class, 'subscriber_update']);
        //Setting-Point Price
        Route::get('/setting/point_price', [Admin_Point_PriceController::class, 'index'])->name('admin_point_price');
        Route::post('/setting/store_point_price', [Admin_Point_PriceController::class, 'store']);
        Route::get('/setting/detail_point_price/{point_Price}', [Admin_Point_PriceController::class, 'show']);
        Route::post('/setting/update_point_price', [Admin_Point_PriceController::class, 'update']);
        Route::post('/setting/delete_point_price', [Admin_Point_PriceController::class, 'destroy']);
        //Setting-Bank
        Route::get('/setting/bank', [Admin_BankController::class, 'index'])->name('admin_bank');
        Route::post('/storeUpdate_bank', [Admin_BankController::class, 'storeOrUpdate'])->name('admin_store_update_bank');
        Route::get('/edit_bank', [Admin_BankController::class, 'edit'])->name('admin_edit_bank');
        Route::post('/destroy_bank', [Admin_BankController::class, 'destroy'])->name('admin_destroy_bank');
        //Setting-Notification
        Route::get('/setting/segment', [Admin_NotificationController::class, 'segment'])->name('admin_segment_index');
        Route::get('/setting/getSegments', [Admin_NotificationController::class, 'getSegments']);
        Route::get('/setting/notification', [Admin_NotificationController::class, 'index'])->name('admin_notification_index');
        Route::get('/setting/getNotifications', [Admin_NotificationController::class, 'getNotifications']);
        Route::get('/setting/notification/createNotifications', [Admin_NotificationController::class, 'createNotifications']);
        Route::post('/setting/storeNotifications', [Admin_NotificationController::class, 'storeNotifications']);
        Route::get('/setting/notification/{id}/detail', [Admin_NotificationController::class, 'detailNotifications']);
        Route::get('/setting/notification/get_detailNotifications/{id}', [Admin_NotificationController::class, 'get_detailNotifications']);
        Route::post('/setting/deleteNotifications', [Admin_NotificationController::class, 'deleteNotifications']);

        //Order
        // Route::get('/order', [Admin_OrderController::class, 'index'])->name('admin_order');
        // Route::get('/order/new_order', [Admin_OrderController::class, 'new_order'])->name('admin_new_order');
        Route::get('/order', [Admin_OrderController::class, 'new_order'])->name('admin_order');
        Route::get('/order/waiting_payment_order', [Admin_OrderController::class, 'waiting_payment_order'])->name('admin_waiting_payment_order');
        Route::get('/order/payment_received_order', [Admin_OrderController::class, 'payment_received_order'])->name('admin_payment_received_order');
        Route::post('/store_payment_received_order/{invoice}', [Admin_OrderController::class, 'store_payment_received_order'])->name('admin_store_payment_received_order');
        Route::get('/order/approve_order', [Admin_OrderController::class, 'approve_order'])->name('admin_approve_order');
        Route::post('/store_approve_order/{invoice}', [Admin_OrderController::class, 'store_approve_order'])->name('admin_store_approve_order');
        Route::get('/order/deliver_order', [Admin_OrderController::class, 'deliver_order'])->name('admin_deliver_order');
        Route::get('/order/rejected_order', [Admin_OrderController::class, 'rejected_order'])->name('admin_rejected_order');
        Route::post('/store_ongkir', [Admin_OrderController::class, 'storeOngkir']);
        Route::post('/update_harga_paket/{invoice}', [Admin_OrderController::class, 'update_harga_paket']);
        Route::get('/order-detail/{invoice}', [Admin_OrderController::class, 'orderDetail'])->name('admin_order_detail');
        Route::get('/tambah-order', [Admin_OrderController::class, 'create'])->name('admin_tambah_order');
        Route::post('/store-order', [Admin_OrderController::class, 'store'])->name('admin_store_order');
        Route::get('/get-harga-order/{id}', [Admin_OrderController::class, 'getHargaOrder'])->name('admin_get_harga_order');
        Route::get('/download-invoice/{invoice}', [Admin_OrderController::class, 'downloadInvoice'])->name('admin.download.invoice');
        
        // Data Order
        Route::get('/data_order/{invoice}', [Admin_OrderController::class, 'get_data_order_ongkir'])->name('admin_get_data_order');
        Route::get('/order/get_data_new_order', [Admin_OrderController::class, 'get_data_new_order']);
        Route::get('/order/get_data_waiting_payment', [Admin_OrderController::class, 'get_data_waiting_payment']);
        Route::get('/order/get_data_payment_received', [Admin_OrderController::class, 'get_data_payment_received']);
        Route::get('/order/get_data_approve', [Admin_OrderController::class, 'get_data_approve']);
        Route::get('/order/get_data_deliver', [Admin_OrderController::class, 'get_data_deliver']);
        Route::get('/order/get_data_rejected', [Admin_OrderController::class, 'get_data_rejected']);

        //News Artikel
        Route::get('/artikel', [Admin_ArtikelController::class, 'index'])->name('admin_artikel');
        Route::get('/artikel/create_artikel', [Admin_ArtikelController::class, 'create'])->name('admin_create_artikel');
        Route::post('/artikel/store_artikel', [Admin_ArtikelController::class, 'store'])->name('admin_store_artikel');
        Route::get('/artikel/show_artikel/{artikel}', [Admin_ArtikelController::class, 'show'])->name('admin_show_artikel');
        Route::get('/artikel/edit_artikel/{artikel}', [Admin_ArtikelController::class, 'edit'])->name('admin_edit_artikel');
        Route::post('/artikel/update_artikel/{artikel}', [Admin_ArtikelController::class, 'update'])->name('admin_update_artikel');
        Route::post('/artikel/destroy_artikel/{artikel}', [Admin_ArtikelController::class, 'destroy'])->name('admin_destroy_artikel');
        Route::post('/artikel/destroy_image_artikel/{artikel_image}', [Admin_ArtikelController::class, 'destroy_image'])->name('admin_destroy_image_artikel');

        // Report
        Route::get('/report_invoice', [Admin_ReportController::class, 'report_inovice'])->name('admin_report_invoice');
        Route::get('/get_data_report_invoice', [Admin_ReportController::class, 'get_data_report_invoice']);
    });
});

// Route::group(['middleware' => ['penjual:2', 'auth', 'verified']], function () {

//     Route::prefix('owner')->name('owner.')->group(function() {

//         // Outlet
//         Route::get('/listOutlet', [OutletsController::class, 'index']);
//         Route::get('/get_data_listOutlet', [OutletsController::class, 'get_data_listOutlet']);
//         Route::get('/detail_user_outlet/{outlet}', [OutletsController::class, 'show']);
//         Route::get('/createOutlet', [OutletsController::class, 'create']);
//         Route::post('/storeOutlet', [OutletsController::class, 'store']);
//         Route::get('/editOutlet/{outlet}', [OutletsController::class, 'edit']);
//         Route::post('/updateOutlet/{outlet}', [OutletsController::class, 'update']);
//         Route::get('/outletSlug', [OutletsController::class, 'outletSlug']);
//         Route::get('/validateNoHp', [OutletsController::class, 'validateNoHp']);

//         // Dashboard Owner
//         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-owner');
//         Route::get('/get_data_stock_report', [DashboardController::class, 'getDataStockReport']);

//         // POS Sistem atau Menu Order
//         Route::get('/menu-order', [MenuOrderController::class, 'index'])->name('owner_menu_order');
//         Route::get('/get-produk/{produkId}', [MenuOrderController::class, 'getProduk'])->name('owner_get_produk');
//         Route::get('/getNomorHP', [MenuOrderController::class, 'getNomorHP']);
//         Route::get('/getIdPembeli', [MenuOrderController::class, 'getIdPembeli']);
//         Route::post('/store-order', [MenuOrderController::class, 'store']);

//         // Claim Bonus
//         Route::get('/claim_bonus', [ClaimBonusController::class, 'claim_bonus'])->name('owner_claim_bonus');
//         Route::get('/store_claim_bonus', [ClaimBonusController::class, 'store_claim_bonus'])->name('owner_store_claim_bonus');
//         Route::post('/konfirmasi_claim', [ClaimBonusController::class, 'konfirmasi_claim'])->name('owner_konfirmasi_claim');
//         Route::post('/update_claim', [ClaimBonusController::class, 'update_claim'])->name('owner_update_claim');
//         Route::post('/konfirmasi_gift', [ClaimBonusController::class, 'konfirmasi_gift'])->name('owner_konfirmasi_gift');
//         Route::post('/update_gift', [ClaimBonusController::class, 'update_gift'])->name('owner_update_gift');

//         Route::get('/bonus', [ClaimBonusController::class, 'new_bonus'])->name('owner_bonus');
//         Route::get('/bonus/get_data_pembeli_claim', [ClaimBonusController::class, 'get_data_pembeli_claim'])->name('get_data_pembeli_claim');
//         Route::get('/bonus_gift', [ClaimBonusController::class, 'new_bonus_gift'])->name('owner_bonus_gift');
//         Route::get('/bonus/get_data_pembeli_gift', [ClaimBonusController::class, 'get_data_pembeli_gift'])->name('get_data_pembeli_gift');

//         // Restock
//         Route::get('/restock-order', [RestockController::class, 'index'])->name('owner_restock');
//         Route::get('/get-harga-order-penjual/{id}', [RestockController::class, 'getHargaOrder'])->name('owner_get_harga_order');
//         Route::post('/store-restock-order', [RestockController::class, 'store'])->name('owner_store_restock_order');
//         Route::get('/konfirmasi-pembayaran-order', [RestockController::class, 'konfPembayaran'])->name('owner_konf_pembayaran_order');
//         Route::get('/cek-data-invoice/{invoice}', [RestockController::class, 'cekDataInvoice'])->name('owner_cek_data_invoice');
//         Route::post('/store-konfirmasi-pembayaran-order', [RestockController::class, 'storeKonfPembayaran'])->name('owner_store_konf_pembayaran_order');
//         Route::get('/status-restock', [RestockController::class, 'statusRestock'])->name('owner_status_restock');
//         Route::get('/detail-pembelian/{invoice}', [RestockController::class, 'detailPembelian'])->name('owner_detail_pembelian');
//         Route::get('/change-progress-order/{invoice}', [RestockController::class, 'changeProgressOrder'])->name('owner_change_progress_order');

//         // Report Invoice
//         Route::get('/report-invoice-pembelian', [ReportInvoiceController::class, 'invoicePembelian'])->name('owner_report_invoice_pembelian');
//         Route::get('/detail-invoice-pembelian/{invoice}', [ReportInvoiceController::class, 'detailInvoicePembelian'])->name('owner_detail_invoice_pembelian');
//         Route::get('/get-data-invoice-pembelian', [ReportInvoiceController::class, 'getDataInvoicePembelian'])->name('getDataInvoicePembelian');

//         Route::get('/report-invoice-penjualan', [ReportInvoiceController::class, 'invoicePenjualan'])->name('owner_report_invoice_penjualan');
//         Route::get('/detail-invoice-penjualan/{invoice}', [ReportInvoiceController::class, 'detailInvoicePenjualan'])->name('owner_detail_invoice_penjualan');
//         Route::get('/get-data-invoice-penjualan', [ReportInvoiceController::class, 'getDataInvoicePenjualan'])->name('getDataInvoicePenjualan');

//         Route::get('/download-invoice/{invoice}', [ReportInvoiceController::class, 'downloadInvoice'])->name('owner_download_invoice');
        

//         // Akun Setting
//         Route::get('/pengaturan-akun/{username}', [AkunSettingController::class, 'index'])->name('owner_pengaturan_akun');
//         Route::get('/pengaturan-akun/edit-profile/{username}', [AkunSettingController::class, 'editProfile'])->name('owner_edit_profile');
//         Route::post('/pengaturan-akun/update-profile/{username}', [AkunSettingController::class, 'updateProfile'])->name('owner_update_profile');
//         Route::post('/pengaturan-akun/update-password/{username}', [AkunSettingController::class, 'updatePassword'])->name('owner_update_password');
//         Route::get('/OwnervalidateNoHp', [AkunSettingController::class, 'OwnervalidateNoHp']);
//         Route::get('/OwnervalidateUsername', [AkunSettingController::class, 'OwnervalidateUsername']);
//         Route::get('/OwnervalidateEmail', [AkunSettingController::class, 'OwnervalidateEmail']);
//     });
// });