<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // ----------------------------------Admin----------------------------------
    public function view() {
        return view('auth.admin');
    }

    public function login(Request $request) {
        if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect('/admin/dashboard')->with('greeting', 'greeting');
        }
        return redirect('admin')->with('wrong', 'wrong');
    }

    public function logout() {
        if(Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        return redirect('/admin');
    }
    // ----------------------------------End Admin----------------------------------



    // ----------------------------------Guest----------------------------------
    public function login_guest(Request $request) {
        if (Auth::attempt(['email'=>$request->email_login, 'password'=>$request->password_login])) {
            return redirect('/')->with('greeting', 'greeting');
        }
        return redirect('/')->with('wrong', 'wrong');
    }

    public function logout_guest() {
        if(Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }

    // Guest not verify handle
    public function verifyNotice() {
        return view('auth.verify-guest-email');
    }

    // Guest verify email handle
    public function verifyEmailHandle(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home')->with('greetingVerified', 'greeting');
    }

    // Guest resend verify email handle
    public function resendVerifyEmail(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return redirect('/')->with('sentVerify', 'Verification link sent!');
    }

    // Guest view forgot password
    public function forgotPasswordView() {
        return view('auth.guest-forgot-password');
    }

    // Guest send reset link
    public  function sendResetPasswordLink(Request $request) {
        $request->validate(['email' => 'required|email|email:dns']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // Guest view form reset password
    public function resetPasswordView($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Guest update password handle
    public function updatePassword(Request $request) {
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
    }
    // ----------------------------------End Guest----------------------------------

}
