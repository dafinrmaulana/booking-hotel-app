<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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
}
