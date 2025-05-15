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
            //
            'name' => $this->faker->words(3, true),
            'category' => $this->faker->randomElement(['Gadgets', 'Accessories', 'Wearables']),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock_quantity' => $this->faker->numberBetween(5, 50),
        ];
    }
}
