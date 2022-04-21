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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
Route::get('/home', [TamuPageController::class, 'home'])->name('guest.home');
Route::get('/rooms', [TamuPageController::class, 'rooms'])->name('guest.rooms');
Route::get('/home/detail-rooms/{id}', [TamuPageController::class, 'detail_rooms'])->name('detail-kamar.tamu')->middleware('verified');
Route::get('/home/detail-fasilitas-hotel/{id}', [TamuPageController::class, 'detail_fasilitas_hotel'])->name('detail-fasilitas-hotel.tamu');
Route::get('/home/contact-us', [TamuPageController::class, 'kirimEmail'])->name('contact.kirim');
Route::post('/home/register-guest', [TamuPageController::class, 'register_guest'])->name('register.guest');
Route::post('/home/login-guest', [AuthController::class, 'login_guest'])->name('login.guest');
Route::get('/home/logout-guest', [AuthController::class, 'logout_guest'])->name('logout.guest');

// ----------------------------------verify email----------------------------------
Route::get('/email/verify', function () {
    return view('auth.verify-guest-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('greetingVerified', 'greeting');
})->middleware(['auth'])->name('verification.verify');

// ----------------------------------resend verify email----------------------------------
Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return redirect('/')->with('sentVerify', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ----------------------------------view send link reset password----------------------------------
Route::get('/forgot-password', function () {
    return view('auth.guest-forgot-password');
})->middleware('guest')->name('guest-password.request');


// ----------------------------------send reset password link----------------------------------
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email|email:dns']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// ----------------------------------view form reset password----------------------------------
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


// ----------------------------------reset password----------------------------------
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email|email:dns',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'token' => Str::random(60),
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('guest.home')->with('greetingReset', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

// ----------------------------------end verify email----------------------------------

Route::group(['middleware' => ['auth:admin','RoleCheck:admin,resepsionis']], function() {
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
