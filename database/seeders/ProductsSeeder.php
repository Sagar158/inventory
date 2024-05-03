<?php

namespace Database\Seeders;

use App\Models\ProductDetails;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::truncate();
        ProductDetails::truncate();
        Products::factory()
        ->count(20) // Generate 10 products
        ->create();
    }
}
