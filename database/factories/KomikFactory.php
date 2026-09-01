<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Komik;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Komik>
 */
class KomikFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(3),
            'penulis' => $this->faker->name(),
            'kategori_id' => $this->faker->numberBetween(1, 5),
            'stok' => $this->faker->numberBetween(1, 20),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'file_pdf' => $this->faker->optional(0.5)->passthrough($this->faker->word() . '.pdf'),
        ];
    }
}
