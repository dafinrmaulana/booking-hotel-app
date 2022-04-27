<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kamar;
use App\Models\pemesanan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invoice;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamar = kamar::all();
        $pemesanan = pemesanan::with('kamar')->get();
        return view('admin.manage-pemesanan', compact('kamar','pemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kamar = kamar::select('id', 'jumlah_tersedia', 'nama_kamar')->where('id', $request->kamar_id)->first();
        $jumlah = $kamar->jumlah_tersedia;
        $nama_kamar = $kamar->nama_kamar;
        $request->validate([
            'nama_pemesan' => 'required|not_regex:/[0-9!@#$%^&*]/',
            'nama_tamu' => 'required|not_regex:/[0-9!@#$%^&*]/',
            'email' => 'required|unique:pemesanan,email|email:dns',
            'no_hp' => 'required|unique:pemesanan,no_hp|min:1|max:15|not_regex:/[A-Za-z!@#$%^&*]/',
            'jumlah_kamar_dipesan' => "required|numeric|integer|min:1|max:{$jumlah}",
            'tanggal_checkin' => 'required|after:yesterday',
            'tanggal_checkout' => 'required|after:tanggal_checkin',
            'tamu_id'=>'nullable'
        ],
        [
            'nama_pemesan.required'=>'Nama pemesan harus diisi',
            'nama_pemesan.not_regex'=>'Nama pemesan tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'nama_tamu.required'=>'Nama tamu harus diisi',
            'nama_tamu.not_regex'=>'Nama tamu tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'email.required'=>'Email harus diisi',
            'email.email'=>'Email harus valid',
            'email.unique'=>'Email sudah ada',
            'no_hp.required'=>'Nomor hp harus diisi',
            'no_hp.not_regex'=>'Nomor hp tidak boleh mengandung huruf ataupun karakter spesial(!@#$%^&*)',
            'no_hp.unique'=>'Nomor hp udah ada',
            'no_hp.min'=>'Nomor hp minimal 10 digit',
            'no_hp.max'=>'Nomor hp maksimal 15 digit',
            'jumlah_kamar_dipesan.required'=>'Jumlah kamar dipesan harus diisi',
            'jumlah_kamar_dipesan.numeric'=>'Jumlah kamar dipesan harus berupa angka',
            'jumlah_kamar_dipesan.integer'=>'Jumlah kamar dipesan harus berupa angka',
            'jumlah_kamar_dipesan.max'=>"Ups kamar {$nama_kamar} sepertinya hanya tersedia {$jumlah} kamar",
            'jumlah_kamar_dipesan.min'=>'Minimal harus memesan 1 kamar',
            'tanggal_checkin.required'=>'Tanggal checkin harus diisi',
            'tanggal_checkin.after'=>'Tanggal check IN minimal hari ini dan seterusnya',
            'tanggal_checkout.required'=>'Tanggal check OUT harus diisi',
            'tanggal_checkout.after'=>'Tanggal check OUT harus lebih dari tanggal checkin',
        ]);
        $pemesanan = pemesanan::create([
            'nama_pemesan'=>$request->nama_pemesan,
            'nama_tamu'=>$request->nama_tamu,
            'email'=>$request->email,
            'no_hp'=>$request->no_hp,
            'tanggal_checkin'=>$request->tanggal_checkin,
            'tanggal_checkout'=>$request->tanggal_checkout,
            'jumlah_kamar_dipesan'=>$request->jumlah_kamar_dipesan,
            'tanggal_dipesan'=>Carbon::now(),
            'kamar_id'=>$request->kamar_id,
        ]);
        if($request->jumlah_kamar_dipesan) {
            $kamar->update([
                'jumlah_tersedia' => $kamar->jumlah_tersedia - $request->jumlah_kamar_dipesan,
                'jumlah_terisi' => $kamar->jumlah_terisi + $request->jumlah_kamar_dipesan,
            ]);
        }
        return back()->with('store', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data = pemesanan::with('kamar')->findOrFail($id);
        return view('admin.action.detail-pemesanan', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kamar = kamar::all();
        return view('admin.action.edit-pemesanan', ['data'=>pemesanan::findorfail($id), 'kamar'=>$kamar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unique = pemesanan::findorfail($id);
        $kamar = kamar::select('id', 'jumlah_tersedia','jumlah_terisi' , 'nama_kamar')->where('id', $request->kamar_id)->first();
        $jumlah_tersedia = $kamar->jumlah_tersedia;
        $jumlah_terisi = $kamar->jumlah_terisi;

        $request->validate([
            'nama_pemesan' => 'required|not_regex:/[0-9!@#$%^&*]/',
            'nama_tamu' => 'required|not_regex:/[0-9!@#$%^&*]/',
            'email' => "required|unique:pemesanan,email,{$unique->id}",
            'no_hp' => "required|unique:pemesanan,no_hp,{$unique->id}|min:1|max:15|not_regex:/[A-Za-z!@#$%^&*]/",
            'jumlah_kamar_dipesan' => "required|numeric|integer|max:{$jumlah_tersedia}|min:1",
            'tanggal_checkin' => 'required|after_or_equal:yesterday',
            'tanggal_checkout' => 'required|after_or_equal:tanggal_checkin',
        ],
        [
            'nama_pemesan.required'=>'Nama pemesan harus diisi',
            'nama_pemesan.not_regex'=>'Nama pemesan tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'nama_tamu.required'=>'Nama tamu harus diisi',
            'nama_tamu.not_regex'=>'Nama tamu tidak boleh mengandung angka ataupun karakter spesial(!@#$%^&*)',
            'email.required'=>'Email harus diisi',
            'email.unique'=>'Email sudah ada',
            'no_hp.required'=>'Nomor hp harus diisi',
            'no_hp.not_regex'=>'Nomor hp tidak boleh mengandung huruf ataupun karakter spesial(!@#$%^&*)',
            'no_hp.unique'=>'Nomor hp udah ada',
            'no_hp.min'=>'Nomor hp minimal 10 digit',
            'no_hp.max'=>'Nomor hp maksimal 15 digit',
            'jumlah_kamar_dipesan.required'=>'Jumlah kamar dipesan harus diisi',
            'jumlah_kamar_dipesan.numeric'=>'Jumlah kamar dipesan harus berupa angka',
            'jumlah_kamar_dipesan.integer'=>'Jumlah kamar dipesan harus berupa angka',
            'jumlah_kamar_dipesan.max'=>'Maksimal hanya bisa memesan 10 kamar',
            'jumlah_kamar_dipesan.min'=>'Minimal harus memesan 1 kamar',
            'tanggal_checkin.required'=>'Tanggal checkin harus diisi',
            'tanggal_checkin.after_or_equal'=>'Tanggal checkin tidak bisa tanggal kemarin atau setelah nya',
            'tanggal_checkout.required'=>'Tanggal checkout harus diisi',
            'tanggal_checkout.after_or_equal'=>'Tanggal checkout harus sama dengan tanggal checkin atau hari setelah nya',
        ]);

        $pemesanan = pemesanan::find($id)->first();
        // $kamar = kamar::where('id', $pemesanan->id)->first();
        if ($request->status == 'checkout'){
            $kamar->update([
                'jumlah_tersedia' =>$jumlah_tersedia + $pemesanan->jumlah_kamar_dipesan,
                'jumlah_terisi' =>$jumlah_terisi - $pemesanan->jumlah_kamar_dipesan
            ]);
        }
        if ($request->status == 'cancel'){
            $kamar->update([
                'jumlah_tersedia' =>$jumlah_tersedia + $pemesanan->jumlah_kamar_dipesan,
                'jumlah_terisi' =>$jumlah_terisi - $pemesanan->jumlah_kamar_dipesan
            ]);
        }
        $pemesanan = [
            'nama_pemesan'=>$request->nama_pemesan,
            'nama_tamu'=>$request->nama_tamu,
            'email'=>$request->email,
            'no_hp'=>$request->no_hp,
            'status_pemesan'=>$request->status,
            'tanggal_checkin'=>$request->tanggal_checkin,
            'tanggal_checkout'=>$request->tanggal_checkout,
            'jumlah_kamar_dipesan'=>$request->jumlah_kamar_dipesan,
            'tanggal_dipesan'=>Carbon::now(),
            'kamar_id'=>$request->kamar_id,
        ];

        pemesanan::where('id', $id)->update($pemesanan);
        return redirect('admin/manage-pemesanan')->with('update', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pemesanan')->delete($id);
        return back()->with('delete', 'delete');
    }

    public function status(Request $request, $id) {
        $kamar = kamar::select('id', 'jumlah', 'nama_kamar')->where('id', $request->kamar_id)->first();
        pemesanan::where('id', $id)->update([
            'status_pemesan' => $request->status,
        ]);
        if($request->status_pemesan == 'cancel' || 'checkout') {
            $kamar->update([
                'jumlah' => $kamar->jumlah + $pemesanan->jumlah_kamar_dipesan
            ]);
        }
    }

    public function cetak($id) {
        $data = pemesanan::with('kamar')->findOrFail($id);
        return view('admin.action.cetak', compact('data'));
    }

    public function kirimEmail($id) {
        $data = pemesanan::with('kamar')->find($id);
        Mail::to($data->email)->send(
            new invoice($data)
        );
        return redirect('admin/manage-pemesanan')->with('email', 'email');
    }

}
