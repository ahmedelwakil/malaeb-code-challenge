<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->firstName() . '\'s Product',
            'description' => fake()->optional()->sentences(3, true),
            'price' => fake()->randomFloat(2, 1, 999),
            'rating' => fake()->randomFloat(2, 1, 5),
        ];
    }
}