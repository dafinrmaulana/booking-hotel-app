<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;
=======
use App\Models\fasilitasKamar;
use App\Models\kamar;
use App\Models\admin;
use App\Models\tamu;
use App\Models\pemesanan;
use Illuminate\Support\Facades\DB;

>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
=======
        $kamar = kamar::count();
        $tamu = tamu::count();
        $fasilitasKamar = fasilitasKamar::count();
        $admin = admin::where('role', 'admin')->count();
        $resepsionis = admin::where('role', 'resepsionis')->count();
        $checkin = pemesanan::where('status_pemesan', 'checkin')->count();
        $checkout = pemesanan::where('status_pemesan', 'checkout')->count();
        $unpaid = pemesanan::where('status_pemesan', 'unpaid')->count();
        return view('admin.dashboard', [
            'kamar' => $kamar,
            'tamu' => $tamu,
            'fasilitasKamar' => $fasilitasKamar,
            'admin' => $admin,
            'resepsionis' => $resepsionis,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'unpaid' => $unpaid,
            'data_chart'=>$this->data_chart()
        ]);
    }

    public function data_chart() {
        $pemesanan = pemesanan::select(
            'created_at',
            DB::raw('count(*) as jumlah_kamar_dipesan')
        )
        ->whereMonth('created_at', date('m'))
        ->orderBy('created_at')
        ->groupBy('created_at')
        ->get();

        $data = [];

        foreach($pemesanan as $pesanan){
            $data['label'][] = date('d/m/Y', strtotime($pesanan->created_at));
            $data['data'][] = $pesanan->jumlah_kamar_dipesan;
        }

        return $data;
    }

>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
}
