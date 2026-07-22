<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Anggota>
 */
class AnggotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'no_hp' => fake('id_ID')->numerify('08##########'),
            'alamat' => fake()->address(),
            'tanggal_daftar' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
        ];
    }
}
