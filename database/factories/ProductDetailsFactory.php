<?php

namespace Database\Factories;

use App\Models\ProductDetails;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class ProductDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => 'storage/products/' . $this->faker->image('public/storage/products', 400, 300, null, false),
            'primary' => 0,
        ];
    }
}
