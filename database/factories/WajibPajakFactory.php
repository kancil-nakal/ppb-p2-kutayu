<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WajibPajak>
 */
class WajibPajakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_sppt' => fake()->unique()->randomNumber(8),
            'nama' => fake()->name(),
            'tahun' => fake()->randomElement([2023,2024]),
            'rt' => fake()->numberBetween(1, 10),
            'rw' => fake()->numberBetween(1, 10),
            'alamat_pemilik' => fake()->sentence(),
            'objek_pajak' => fake()->sentence(),
            'luas_bumi' => fake()->numberBetween(100, 1000),
            'luas_bangunan' => fake()->numberBetween(50, 500),
            'pagu_pajak' => fake()->randomFloat(2, 1000000, 10000000),
            'nama_penarik' => '',
            'status' => fake()->boolean(),
        ];
    }
}
