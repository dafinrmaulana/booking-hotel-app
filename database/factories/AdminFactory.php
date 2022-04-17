<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'nama' => $this->faker->name(),
            'role' => $this->faker->randomElement(['admin', 'resepsionis']),
            'username' => $this->faker->userName(),
            'password' => bcrypt('123123'),
            'remember_token' => Str::random(40),
        ];
    }
}
