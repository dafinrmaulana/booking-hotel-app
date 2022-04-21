<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kamar;
use App\Models\fasilitasHotel;
use App\Models\about;
use App\Models\fasilitasKamar;
use App\Models\tamu;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class TamuPageController extends Controller
{
    public function home() {
        $kamar = kamar::paginate(6);
        $fasilitas = fasilitasHotel::paginate(4);
        $about = about::first();
        return view('tamu.home', compact('kamar', 'fasilitas', 'about'));
    }


    public function rooms() {
        $kamar = kamar::paginate(6);
        return view('tamu.rooms', compact('kamar'));
    }


    public function detail_rooms($id) {
        $kamar = kamar::with('fasilitas')->where('id', $id)->first();
        $about = about::first();
        $faska = fasilitasKamar::all();
        return view('tamu.detail-rooms', compact('kamar', 'about', 'faska'));
    }


    public function detail_fasilitas_hotel($id) {
        $fasilitas = fasilitasHotel::findorfail($id);
        return view('tamu.detail-fasilitas-hotel', compact('fasilitas'));
    }


    public function kirimEmail(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
            'phone'=>'required',
        ]);
        $data = $request->all();
        Mail::send('mail.contact-us', array(

            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'],
            'subject' => $data['subject'],
            'pesan' => $data['message'],

        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('admin@ketaksaanhotel.com', 'Admin')->subject($request->get('subject'));

        });
        return back()->with('email', 'email');
    }

    public function register_guest(Request $request) {
        $request->validate([
            'nama_regist'=>'required|min:3|not_regex:/[0-9!@#$%^&*]/',
            'email_regist'=>'required|email|min:3|unique:tamu,email|email:dns',
            'no_hp_regist'=>'nullable|max:15|min:10|not_regex:/[a-zA-Z!@#$%^&*]/',
            'password_regist'=>'required|min:6|max:1024|same:password_confirmation_regist|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
        ]);
        $user = tamu::create([
            'nama_tamu'=>$request->nama_regist,
            'email'=>$request->email_regist,
            'no_hp'=>$request->no_hp_regist,
            'password'=>bcrypt($request->password_regist),
            'remember_token'=>Str::random(40),
            'token'=>Str::random(46),
        ]);
        event(new Registered($user));
        Auth::login($user);

        return redirect('/')->with('regist', 'regist');
    }
}
