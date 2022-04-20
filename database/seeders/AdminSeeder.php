<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\admin;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admin::create([
            'nama'=>'Administrator',
            'role'=>'admin',
            'username'=>'admin',
            'password'=>bcrypt('123123'),
            'remember_token'=>Str::random(50),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

        admin::create([
            'nama'=>'Resepsionis',
            'role'=>'resepsionis',
            'username'=>'resepsionis',
            'password'=>bcrypt('123123'),
            'remember_token'=>Str::random(50),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
    }
}
