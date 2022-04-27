<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\admin::factory(8)->create();
        // \App\Models\kamar::factory(10)->create();
        // \App\Models\tamu::factory(5)->create();
        // \App\Models\pemesanan::factory(5)->create();
        \App\Models\fasilitasHotel::factory(5)->create();
        $this->call([
            AdminSeeder::class,
            FasilitasKamarSeeder::class,
            tamuSeeder::class,
        ]);
    }
}
