<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kategori>
 */
class KategoriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_kategori' => fake()->randomElement([
                'Action', 'Romance', 'Comedy', 'Horror', 'Slice of life',
                'Fantasy', 'Mystery', 'Sports', 'Sci-Fi', 'Drama',
            ])
        ];
    }
}
