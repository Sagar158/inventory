<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ContactInformationSeeder::class);
        $this->call(CountriesSeeder::class);

    }
}
