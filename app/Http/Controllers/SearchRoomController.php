<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\pemesanan;
use App\Models\kamar;
use App\Models\fasilitasKamar;

class SearchRoomController extends Controller
{
    // public function search(Request $request)
    // {
    //     $kamar = kamar::select('id', 'jumlah', 'nama_kamar');
    //     $request->validate([
    //         'checkin' => 'required|after:yesterday',
    //         'checkout' => 'required|after:checkin',
    //         'total' => "required|numeric|integer|min:1|max:9",
    //     ]);

    //     $pemesanan = new pemesanan;
    //     $pemesanan->nama_pemesan = Auth::user()->nama_pemesan;
    //     $pemesanan->email = Auth::user()->email;
    //     $pemesanan->tanggal_checkin = ($request->checkin);
    //     $pemesanan->tanggal_checkout = ($request->checkout);
    //     $pemesanan->tanggal_dipesan = Carbon::now();
    //     $pemesanan->jumlah_kamar_dipesan = ($request->total);
    //     $pemesanan->nama_tamu = 'undifined';

    //     if($request->jumlah_kamar_dipesan) {
    //         $kamar->update([
    //             'jumlah_kamar' => $kamar->jumlah_kamar - $request->jumlah_kamar_dipesan
    //         ]);
    //     }

    //     $pemesanan->status_pemesan = 'pending';
    //     $pemesanan->no_hp = null;
    //     $pemesanan->kamar_id = '0';
    //     $pemesanan->save();


    //     if ($pemesanan) {
    //         return redirect()->route('search.guest.room.result', [$pemesanan]);
    //     }
    // }

    // public function searchResult($id) {
    //     $kamar = kamar::paginate(10);
    //     return view('tamu.search-room-result', compact('kamar'));
    // }

    // public function detailRoomsSearch($id)
    // {
    //     $pemesanan = pemesanan::findorfail($id)->first();
    //     $kamar = kamar::with('fasilitas')->where('id', $id)->first();
    //     $faska = fasilitasKamar::all();
    //     return view('tamu.detail-rooms', compact('kamar', 'faska', 'pemesanan'));
    // }
}
