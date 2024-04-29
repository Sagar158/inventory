<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            'frontend/assets/img/banner/2.jpg',
            'frontend/assets/img/banner/3.jpg',
            'frontend/assets/img/banner/4.jpg',
            'frontend/assets/img/banner/5.jpg',
            'frontend/assets/img/banner/17.jpg',
            'frontend/assets/img/banner/18.jpg'
        ];
        return [
            'image' => $images[array_rand($images)], // You can customize the image parameters
            'title' => $this->faker->sentence, // Generates a random sentence as title
            'subtitle' => $this->faker->sentence, // Generates a random sentence as subtitle
            'description' => $this->faker->paragraph // Generates a random paragraph as description
        ];
    }
}
