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
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/admin/dashboard')->with('greeting', 'greeting');
        }
        return redirect('admin')->with('wrong', 'wrong');
    }

    public function logout() {
        Auth::logout();
        return redirect('admin/');
    }
}
