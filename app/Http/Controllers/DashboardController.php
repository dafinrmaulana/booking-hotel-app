<?php

namespace App\Http\Controllers;

use App\Models\fasilitasKamar;
use App\Models\kamar;
use App\Models\admin;
use App\Models\tamu;
use App\Models\pemesanan;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamar_tersedia = kamar::sum('jumlah_tersedia');
        $kamar_terisi = kamar::sum('jumlah_terisi');
        $total_kamar = kamar::sum('jumlah_kamar');
        $tamu = tamu::count();
        $fasilitasKamar = fasilitasKamar::count();
        $admin = admin::where('role', 'admin')->count();
        $resepsionis = admin::where('role', 'resepsionis')->count();
        $checkin = pemesanan::where('status_pemesan', 'checkin')->count();
        $checkout = pemesanan::where('status_pemesan', 'checkout')->count();
        $unpaid = pemesanan::where('status_pemesan', 'pending')->count();
        return view('admin.dashboard', [
            'kamar_tersedia' => $kamar_tersedia,
            'kamar_terisi' => $kamar_terisi,
            'total_kamar' => $total_kamar,
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

}
