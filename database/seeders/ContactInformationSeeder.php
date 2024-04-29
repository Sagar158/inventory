<?php

namespace Database\Seeders;

use App\Models\ContactInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInformation::truncate();
        ContactInformation::create([
            'phone' => '(+92) 315 3414695',
            'short_location' => 'Khairpur, Sindh 66000',
            'location' => 'Old National Highway near MDS mart therhi (Habibabad) Dist. Khairpur, Sindh, Pakistan.',
            'email' => 'helpdesk@unitedfoods.pk',
            'facebook' => 'https://www.facebook.com/',
            'twitter' => 'twitter.com',
            'youtube' => 'https://www.youtube.com/',
            'linkedin' => 'https://www.linkedin.com/',
        ]);
    }
}
