<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceEmail;
use App\Http\Controllers\PemesananController;

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
Route::get('/', function () {
    return view('mail.invoice');
});
Route::get('search/admin', [AdminController::class, 'search'])->name('search.admin');
Route::get('search/fasilitas-kamar', [FasilitasKamarController::class, 'search'])->name('search.fasilitasKamar');
Route::get('search/kamar', [KamarController::class, 'search'])->name('search.kamar');
Route::get('search/tamu', [TamuController::class, 'search'])->name('search.tamu');
Route::resource('/admin/dashboard', DashboardController::class);
Route::resource('/admin/manage-admin', AdminController::class);
Route::resource('/admin/manage-kamar', KamarController::class);
Route::resource('/admin/manage-tamu', TamuController::class);
Route::resource('/admin/manage-fasilitas-kamar', FasilitasKamarController::class);
Route::resource('/admin/manage-pemesanan', PemesananController::class);
Route::patch('/admin/manage-pemesanan/update-status/{id}', [PemesananController::class, 'status']);
Route::get('/admin/manage-pemesanan/cetak/{id}', [PemesananController::class, 'cetak'])->name('manage-pemesanan.cetak');
Route::get('/kirim-email/{id}', [PemesananController::class, 'kirimEmail'])->name('email.kirim');
