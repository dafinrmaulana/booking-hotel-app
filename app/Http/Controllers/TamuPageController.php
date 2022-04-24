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
use App\Models\pemesanan;
use Illuminate\Support\Carbon;
use App\Models\paymentTransaction;


class TamuPageController extends Controller
{
    // ----------------------------------Home page----------------------------------
    public function home()
    {
        $kamar = kamar::paginate(6);
        $fasilitas = fasilitasHotel::paginate(4);
        $about = about::first();
        return view('tamu.home', compact('kamar', 'fasilitas', 'about'));
    }
    // ----------------------------------End Home page----------------------------------


    // ----------------------------------Rooms page----------------------------------
    public function rooms()
    {
        $kamar = kamar::paginate(6);
        return view('tamu.rooms', compact('kamar'));
    }
    // ----------------------------------End Rooms page----------------------------------


    // ----------------------------------Rooms Detail----------------------------------
    public function detail_rooms($id)
    {
        $kamar = kamar::with('fasilitas')->where('id', $id)->first();
        $about = about::first();
        $faska = fasilitasKamar::all();
        return view('tamu.detail-rooms', compact('kamar', 'about', 'faska'));
    }
    // ----------------------------------End Rooms Detail----------------------------------


    // ----------------------------------Hotel Facilities----------------------------------
    public function detail_fasilitas_hotel($id)
    {
        $fasilitas = fasilitasHotel::findorfail($id);
        return view('tamu.detail-fasilitas-hotel', compact('fasilitas'));
    }
    // ----------------------------------End Hotel Facilities----------------------------------


    // ----------------------------------Contact Us----------------------------------
    public function kirimEmail(Request $request)
    {
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
    // ----------------------------------End Contact Us----------------------------------


    // ----------------------------------Sign IN----------------------------------
    public function register_guest(Request $request)
    {
        $request->validate([
            'nama_regist'=>'required|min:3|not_regex:/[0-9!@#$%^&*]/',
            'email_regist'=>'required|email|min:3|unique:tamu,email|email:dns',
            'no_hp_regist'=>'nullable|max:15|min:10|not_regex:/[a-zA-Z!@#$%^&*]/',
            'password_regist'=>'required|min:8|max:1024|same:password_confirmation_regist|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
        ]);
        $user = tamu::create([
            'nama_pemesan'=>$request->nama_regist,
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
    // ----------------------------------End Sign IN----------------------------------


    // ----------------------------------Make Room Order Detail----------------------------------
    public function makeRoomOrder(Request $request, $id, pemesanan $pemesanan)
    {
        $kamar = kamar::select('id', 'jumlah', 'nama_kamar')->where('id', $id)->first();
        $jumlah = $kamar->jumlah;
        $nama = $kamar->nama_kamar;
        $kamar_id = $kamar->id;

        $request->validate([
            'nama_tamu'            => 'required|not_regex:/[0-9!@#$%^&*]/|min:3',
            'jumlah_kamar_dipesan' => "required|numeric|min:1|max:{$jumlah}",
            'no_hp'                => "nullable|not_regex:/[A-Za-z]/|min:10|max:15",
        ],
        [
            'nama_tamu.required'            => 'The Guest Name field is required.',
            'nama_tamu.not_regex'           => 'The Guest Name field is cannot contain numbers or special characters. ( 0-9!@#$%^&* )',
            'nama_tamu.not_regex'           => 'The Guest Name must be at least 3 characters.',
            'jumlah_kamar_dipesan.required' => 'The Total Room Order field is required.',
            'jumlah_kamar_dipesan.numeric'  => 'The Total Room Order must be a number.',
            'jumlah_kamar_dipesan.min'      => 'At least order 1 room',
            'jumlah_kamar_dipesan.max'      => "For now there are only {$jumlah} {$nama} rooms available.",
            'no_hp.min'                     => 'The Phone number must be at least 10 digits.',
            'no_hp.max'                     => 'The Phone number must not be greater than 15.',
            'no_hp.not_regex'               => 'The Phone number field is cannot contain letters.',
        ]);

        $pemesanan = new pemesanan;
        $pemesanan->nama_pemesan = Auth::user()->nama_pemesan;
        $pemesanan->nama_tamu = ($request->nama_tamu);
        $pemesanan->email = Auth::user()->email;
        $pemesanan->tanggal_checkin = ($request->checkin);
        $pemesanan->tanggal_checkout = ($request->checkout);
        $pemesanan->tanggal_dipesan = Carbon::now();
        $pemesanan->jumlah_kamar_dipesan = ($request->jumlah_kamar_dipesan);

        if($request->jumlah_kamar_dipesan) {
            $kamar->update([
                'jumlah_kamar' => $kamar->jumlah_kamar - $request->jumlah_kamar_dipesan
            ]);
        }

        $pemesanan->status_pemesan = 'pending';
        $pemesanan->no_hp = ($request->no_hp);
        $pemesanan->kamar_id = $kamar_id;
        $pemesanan->save();


        if ($pemesanan) {
            return redirect()->route('guest.paymentDetail', [$pemesanan]);
        }
    }

    public function makeRoomOrderDetail($id)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-PZRwhhiC4fRYa1AJGU86kEs-';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $pemesanan = pemesanan::with('kamar')->find($id);
        $lamanya = $this->lamanya($pemesanan->tanggal_checkin, $pemesanan->tanggal_checkout);
        $params =
            array
            (
                'transaction_details' => array(
                'order_id' => 'IKH'.rand(),
                'gross_amount' => $pemesanan->jumlah_kamar_dipesan*$pemesanan->kamar->harga*$lamanya,
            ),
            'customer_details' => array(
                'first_name' => $pemesanan->nama_pemesan,
                'last_name' => '',
                'email' => $pemesanan->email,
                'phone' => $pemesanan->no_hp,
            ),
            'item_details' => array(
                [
                    "id"=> "R".$pemesanan->kamar->id.$pemesanan->id,
                    "price"=>$pemesanan->kamar->harga, 2, ',', '.',
                    "quantity"=> $pemesanan->jumlah_kamar_dipesan,
                    "name"=> $pemesanan->kamar->nama_kamar
                ]
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $kamar = kamar::with('fasilitas')->where('id', $id)->first();
        $faska = fasilitasKamar::all();

        return view('tamu.detail-order', compact('pemesanan', 'kamar', 'faska', 'snapToken'));
    }
    // ----------------------------------End Make Room Order Detal----------------------------------

    // ----------------------------------Make payment----------------------------------
    public function makePayment(Request $request) {
        $paymentdata = json_decode($request->get('json'));
        return $paymentdata;
    }

}
