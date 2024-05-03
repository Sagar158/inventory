<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Products;
use App\Models\ProductDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->sentence(3),
            'product_number' => $this->faker->unique()->randomNumber(5),
            'supplier_id' => \App\Models\Supplier::all()->random()->id,
            'category_id' => \App\Models\Categories::all()->random()->id,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->paragraph,
        ];
    }

    /**
     * Define the model's relationships.
     *
     * @return void
     */
    public function configure()
    {
        return $this->afterCreating(function (Products $product) {
            // Associate product with details
            $product->details()->saveMany(
                ProductDetails::factory()
                    ->count($this->faker->numberBetween(3, 5)) // Generate between 3 to 5 details
                    ->make()
            );
            // Ensure at least one detail is primary
            $product->details->random()->update(['primary' => 1]);
        });
    }
}
