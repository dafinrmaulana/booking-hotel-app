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
// Route::get('/', function () {
//     return view('mail.invoice');
// });

Route::get('/admin', [AuthController::class, 'view'])->name('auth.index');
Route::post('/admin/login', [AuthController::class, 'login'])->name('auth.login');

// tamu
Route::get('/', [TamuPageController::class, 'home'])->name('guest.home');
Route::get('/rooms', [TamuPageController::class, 'rooms'])->name('guest.rooms');
Route::get('/home/detail-rooms/{id}', [TamuPageController::class, 'detail_rooms'])->name('detail-kamar.tamu');
Route::get('/home/detail-fasilitas-hotel/{id}', [TamuPageController::class, 'detail_fasilitas_hotel'])->name('detail-fasilitas-hotel.tamu');
Route::get('/home/contact-us', [TamuPageController::class, 'kirimEmail'])->name('contact.kirim');




Route::group(['middleware' => ['auth','RoleCheck:admin,resepsionis']], function() {
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::resource('/admin/dashboard', DashboardController::class);

    // manage pemesanan
    Route::resource('/admin/manage-pemesanan', PemesananController::class);
    Route::patch('/admin/manage-pemesanan/update-status/{id}', [PemesananController::class, 'status']);
    Route::get('/admin/manage-pemesanan/cetak/{id}', [PemesananController::class, 'cetak'])->name('manage-pemesanan.cetak');
    Route::get('/kirim-email/{id}', [PemesananController::class, 'kirimEmail'])->name('email.kirim');

});

Route::group(['middleware' => ['auth','RoleCheck:admin']], function() {
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
