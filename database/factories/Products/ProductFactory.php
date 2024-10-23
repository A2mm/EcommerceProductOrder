<?php

namespace Database\Factories\Products;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->word,
            'description' => $this->faker->sentence,
            'thumbnail'   => 'image.png',
            'price'       => $this->faker->randomFloat(2, 1, 100),
            'in_stock'    => $this->faker->numberBetween(1, 50),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
