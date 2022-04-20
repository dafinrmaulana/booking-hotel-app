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

<<<<<<< HEAD
        \App\Models\admin::factory(8)->create();
        \App\Models\kamar::factory(10)->create();
        \App\Models\tamu::factory(5)->create();
        \App\Models\pemesanan::factory(5)->create();
=======
        // \App\Models\admin::factory(8)->create();
        \App\Models\kamar::factory(10)->create();
        \App\Models\tamu::factory(5)->create();
        \App\Models\pemesanan::factory(100)->create();
        \App\Models\fasilitasHotel::factory(5)->create();
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
        $this->call([
            AdminSeeder::class,
            FasilitasKamarSeeder::class,
        ]);
    }
}
