<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PemesananKamar>
 */
class PemesananKamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $checkin = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $checkout = date('Y-m-d', strtotime('+ '.rand(1, 3). 'days', strtotime($checkin->format('Y-m-d') ) ) );
        $create = date('Y-m-d', strtotime('+ '.rand(1, 3). 'days', strtotime($checkin->format('Y-m-d') ) ) );
        return [
            'kamar_id' => rand(1, 10),
            'tamu_id' => rand(1, 10),
            'nama_pemesan'=>$this->faker->name(),
            'nama_tamu'=>$this->faker->name(),
            'no_hp'=>$this->faker->phoneNumber(),
            'email'=>$this->faker->unique()->email(),
            'status_pemesan'=>'permintaan',
            'jumlah_kamar_dipesan'=>rand(1, 10),
            'tanggal_dipesan'=>$create,
            'created_at'=>$create,
            'updated_at'=>$create,
            'tanggal_checkin'=>$checkin,
            'tanggal_checkout'=>$checkout,
        ];
    }
}
