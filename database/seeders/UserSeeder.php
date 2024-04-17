<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Kumar',
                'email' => 'admin@inventory.co',
                'date_of_birth' => '1996-07-05',
                'contact_number' => '03351257417',
                'address' => 'Godhu Shop Mohalla Khairpur Mir\'s',
                'age' => '26',
                'gender' => 'male',
                'password' => Hash::make('1234567890'),
                'user_type_id' => 1,
            ],
            [
                'first_name' => 'Employee',
                'last_name' => 'Kumar',
                'email' => 'employee@inventory.co',
                'date_of_birth' => '2024-07-05',
                'contact_number' => '03351257413',
                'address' => 'Godhu Shop Mohalla Khairpur Mir\'s',
                'age' => '26',
                'gender' => 'male',
                'password' => Hash::make('1234567890'),
                'user_type_id' => 2,
            ],
        ];

        if(!empty($data))
        {
            foreach($data as $value){
                User::create($value);
            }
        }
    }
}
