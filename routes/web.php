<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasHotelController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TamuPageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SearchRoomController;

// ->middleware('verified')

Route::get('/payment', [TamuPageController::class, 'payment']);

// ----------------------------------Auth Guest/Admin----------------------------------
Route::get('/admin', [AuthController::class, 'view'])->name('auth.index');
Route::post('/admin/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/home/register-guest', [TamuPageController::class, 'register_guest'])->name('register.guest');
Route::post('/home/login-guest', [AuthController::class, 'login_guest'])->name('login.guest');
Route::get('/home/logout-guest', [AuthController::class, 'logout_guest'])->name('logout.guest');
// ----------------------------------End Auth Guest/Admin----------------------------------

// ----------------------------------Guest Page----------------------------------
Route::get('/', [TamuPageController::class, 'home'])->name('guest.home');
Route::get('/home', [TamuPageController::class, 'home'])->name('guest.home');
Route::get('/rooms', [TamuPageController::class, 'rooms'])->name('guest.rooms');
Route::get('/home/detail-rooms/{id}', [TamuPageController::class, 'detail_rooms'])->name('detail-kamar.tamu');
Route::get('/home/fasilitas-hotel', [TamuPageController::class, 'fasilitas_hotel'])->name('fasilitas-hotel.tamu');
Route::get('/home/detail-fasilitas-hotel/{id}', [TamuPageController::class, 'detail_fasilitas_hotel'])->name('detail-fasilitas-hotel.tamu');
Route::get('/home/contact-us', [TamuPageController::class, 'kirimEmail'])->name('contact.kirim');
Route::post('/home/detail-rooms/{id}', [TamuPageController::class, 'makeRoomOrder'])->name('guest.roomOrder');
Route::get('/home/make-order/{id}', [TamuPageController::class, 'makeRoomOrderDetail'])->name('guest.paymentDetail');
// ----------------------------------End Guest Page----------------------------------

// ----------------------------------Guest search room Page----------------------------------
// Route::post('/home/guest-search-room', [SearchRoomController::class, 'search'])->name('search.guest.room');
// Route::get('/home/guest-search-room/result/{id}', [SearchRoomController::class, 'searchResult'])->name('search.guest.room.result');
// Route::get('/home/guest-search-room/result/{$id}/detail-kamar/{id}/', [SearchRoomController::class, 'detailRoomsSearch'])->name('detail-kamar.tamu-search');
// ----------------------------------Guest search room Page END----------------------------------


// ----------------------------------Guest Payment----------------------------------
Route::post('/home/make-order/payment/{id}', [TamuPageController::class, 'makePayment'])->name('makePayment');
Route::get('/home/make-order/e-booking-card/{id}', [TamuPageController::class, 'makeEcard'])->name('makeEbooking');
Route::get('/home/make-order/e-booking-card/kirim-email/{id}', [TamuPageController::class, 'kirimEmailguest'])->name('email.kirim.guest');
// ----------------------------------end Guest Payment----------------------------------

// ----------------------------------guest verify email----------------------------------
Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmailHandle'])->middleware(['auth'])->name('verification.verify');
Route::get('/email/verification-notification', [AuthController::class, 'resendVerifyEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/forgot-password', [AuthController::class, 'forgotPasswordView'])->middleware('guest')->name('guest-password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetPasswordLink'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordView'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->middleware('guest')->name('password.update');
// ----------------------------------end verify email----------------------------------

// ----------------------------------Page Admin/Receptionist Role----------------------------------
Route::group(['middleware' => ['auth:admin','RoleCheck:admin,resepsionis']], function() {
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::resource('/admin/dashboard', DashboardController::class);

    // manage pemesanan
    Route::resource('/admin/manage-pemesanan', PemesananController::class);
    Route::patch('/admin/manage-pemesanan/update-status/{id}', [PemesananController::class, 'status']);
    Route::get('/admin/manage-pemesanan/cetak/{id}', [PemesananController::class, 'cetak'])->name('manage-pemesanan.cetak');
    Route::get('/kirim-email/{id}', [PemesananController::class, 'kirimEmail'])->name('email.kirim');
});
// ----------------------------------End Page Admin/Receptionist Role----------------------------------

// ----------------------------------Page Admin Role----------------------------------
Route::group(['middleware' => ['auth:admin','RoleCheck:admin']], function() {
    // manage admin
    Route::resource('/admin/manage-admin', AdminController::class);
    Route::get('search/admin', [AdminController::class, 'search'])->name('search.admin');

    // manage kamar
    Route::resource('/admin/manage-kamar', KamarController::class);
    Route::get('search/kamar', [KamarController::class, 'search'])->name('search.kamar');

    // manage tamu
    Route::resource('/admin/manage-tamu', TamuController::class);
    Route::get('search/tamu', [TamuController::class, 'search'])->name('search.tamu');

    // manage fasilitas kamar
    Route::resource('/admin/manage-fasilitas-kamar', FasilitasKamarController::class);
    Route::get('search/fasilitas-kamar', [FasilitasKamarController::class, 'search'])->name('search.fasilitas');

    // manage fasilitas hotel
    Route::resource('/admin/manage-fasilitas-hotel', FasilitasHotelController::class);
    Route::get('search/fasilitas-hotel', [FasilitasHotelController::class, 'search'])->name('search.fasilitasHotel');

    // manage about
    Route::resource('/admin/manage-about', AboutController::class);
});
// ----------------------------------end Page Admin Role----------------------------------
