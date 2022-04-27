<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kamar;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        kamar::create([
            'nama'=>'deluxe',
            'jumlah'=>'200',
            'jumlah_tersedia'=>'200',
            'jumlah_terisi'=>'0',
            'harga'=>'200000',
            'foto'=>('/KamarSeeder/room-1.jpg'),
            'keterangan'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum cupiditate odio dolores quam porro dolorem nemo ad praesentium omnis totam eveniet eius',
        ]);
        kamar::create([
            'nama'=>'premium',
            'jumlah'=>'200',
            'jumlah_tersedia'=>'200',
            'jumlah_terisi'=>'0',
            'harga'=>'200000',
            'foto'=>('/KamarSeeder/room-2.jpg'),
            'keterangan'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum cupiditate odio dolores quam porro dolorem nemo ad praesentium omnis totam eveniet eius',
        ]);
        kamar::create([
            'nama'=>'Standar',
            'jumlah'=>'200',
            'jumlah_tersedia'=>'200',
            'jumlah_terisi'=>'0',
            'harga'=>'200000',
            'foto'=>('/KamarSeeder/room-3.jpg'),
            'keterangan'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum cupiditate odio dolores quam porro dolorem nemo ad praesentium omnis totam eveniet eius',
        ]);
        kamar::create([
            'nama'=>'prince',
            'jumlah'=>'200',
            'jumlah_tersedia'=>'200',
            'jumlah_terisi'=>'0',
            'harga'=>'200000',
            'foto'=>('/KamarSeeder/room-4.jpg'),
            'keterangan'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum cupiditate odio dolores quam porro dolorem nemo ad praesentium omnis totam eveniet eius',
        ]);
        kamar::create([
            'nama'=>'queen',
            'jumlah'=>'200',
            'jumlah_tersedia'=>'200',
            'jumlah_terisi'=>'0',
            'harga'=>'200000',
            'foto'=>('/KamarSeeder/room-5.jpg'),
            'keterangan'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum cupiditate odio dolores quam porro dolorem nemo ad praesentium omnis totam eveniet eius',
        ]);
        kamar::create([
            'nama'=>'king',
            'jumlah'=>'200',
            'jumlah_tersedia'=>'200',
            'jumlah_terisi'=>'0',
            'harga'=>'200000',
            'foto'=>('/KamarSeeder/room-6.jpg'),
            'keterangan'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum cupiditate odio dolores quam porro dolorem nemo ad praesentium omnis totam eveniet eius',
        ]);
    }
}
