<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Str;
use App\Models\tamu;

class tamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tamu::create([
            'nama_pemesan'=>'Guest test',
            'email'=>'test.guest@gmail.com',
            'password'=>bcrypt('password'),
            'remember_token'=>Str::random(46),
            'email_verified_at'=>Carbon::now(),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
    }
}
