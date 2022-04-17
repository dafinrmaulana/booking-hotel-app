<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FasilitasKamar;
use Illuminate\Support\Carbon;

class FasilitasKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FasilitasKamar::create([
            'nama_fasilitas' => 'akses hewan peliharaan',
            'keterangan' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        FasilitasKamar::create([
            'nama_fasilitas' => 'Kopi gratis',
            'keterangan' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        FasilitasKamar::create([
            'nama_fasilitas' => 'air mineral',
            'keterangan' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        FasilitasKamar::create([
            'nama_fasilitas' => 'kamar mandi pribadi',
            'keterangan' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        FasilitasKamar::create([
            'nama_fasilitas' => 'AC',
            'keterangan' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        FasilitasKamar::create([
            'nama_fasilitas' => 'penghangat ruangan',
            'keterangan' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        FasilitasKamar::create([
            'nama_fasilitas' => 'Babby sitter',
            'keterangan' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        FasilitasKamar::create([
            'nama_fasilitas' => 'Dapur',
            'keterangan' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
    ]);
    }
}
