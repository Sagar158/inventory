<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Admin', 'permissions' => '{"users.view" : "1","users.create" : "1","users.edit":"1","users.delete" : "1", "permissions.view" : "1","permissions.edit" : "1", "products.view" : "1","products.create" : "1","products.edit" : "1","products.delete" : "1","sales.view" : "1","sales.create" : "1","sales.edit" : "1","sales.delete" : "1","supplier.view" : "1","supplier.create" : "1","supplier.edit" : "1","supplier.delete" : "1","categories.view" : "1","categories.create" : "1","categories.edit" : "1","categories.delete" : "1","reporting.view" : "1","language.view" : "1","language.edit" : "1" ,"inventory.edit" : "1","slider.view" : "1","slider.create" : "1","slider.edit" : "1","slider.delete" : "1"}'],
            ['name' => 'Employee', 'permissions' => '{"users.view" : "1","users.create" : "1","users.edit":"1","users.delete" : "1", "permissions.view" : "1","permissions.edit" : "1", "products.view" : "1","products.create" : "1","products.edit" : "1","products.delete" : "1","sales.view" : "1","sales.create" : "1","sales.edit" : "1","sales.delete" : "1","supplier.view" : "1","supplier.create" : "1","supplier.edit" : "1","supplier.delete" : "1","categories.view" : "1","categories.create" : "1","categories.edit" : "1","categories.delete" : "1","reporting.view" : "1","language.view": "1","language.edit" : "1","inventory.edit" : "1","slider.view" : "1","slider.create" : "1","slider.edit" : "1","slider.delete" : "1"}'],
        ];

        UserType::truncate();
        if(!empty($data))
        {
            foreach($data as $value)
            {
                UserType::create($value);
            }
        }
    }
}
