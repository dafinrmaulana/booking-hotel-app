<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kamar;
use App\Models\fasilitasHotel;
use App\Models\about;
use App\Models\fasilitasKamar;
use App\Mail\contactUs;
use App\Models\tamu;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'nama_regist'=>'nullable|min:3|not_regex:/[0-9!@#$%^&*]/',
            'username_regist'=>'nullable|min:3|not_regex:/[!@#$%^&* ]/|unique:tamu,username',
            'email_regist'=>'required|email|min:3|unique:tamu,email',
            'no_hp_regist'=>'required|max:15|min:10|not_regex:/[a-zA-Z!@#$%^&*]/',
            'password_regist'=>'required|min:6|max:1024|same:password_confirmation_regist|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
        ]);
        tamu::create([
            'nama'=>$request->nama_regist,
            'email'=>$request->email_regist,
            'no_hp'=>$request->no_hp_regist,
            'password'=>$request->password_regist,
        ]);
        return back()->with('regist', 'regist');
    }
}
