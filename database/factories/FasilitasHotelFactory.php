<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\fasilitasHotel>
 */
class FasilitasHotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
<<<<<<< HEAD
            //
=======
            'nama_fasilitas_hotel'=>$this->faker->company(),
            'foto'=>null,
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
        ];
    }
}
