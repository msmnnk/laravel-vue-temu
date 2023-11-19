<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(2, true),
            'description' => fake()->text(),
            'category' => fake()->word(),
            'fabric' => fake()->word(),
            'size' => fake()->word(),
            'price' => fake()->numberBetween(350, 99999),
            'stock' => fake()->numberBetween(1,50)
        ];
    }
}
