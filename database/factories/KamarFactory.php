<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_kamar'=>$this->faker->company(),
            'jumlah'=>rand(1, 999),
            'harga'=>rand(100000, 1000000),
            'keterangan'=>$this->faker->sentence(10),
            // 'fasilitasKamar_id'=>rand(1, 2),
            'foto'=> null
        ];
    }
}
