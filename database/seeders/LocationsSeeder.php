<?php

namespace Database\Seeders;

use App\Models\Locations;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $locations = [
            'Eastern Cape', 'Free State', 'Gauteng', 'KwaZulu-Natal',
            'Limpopo', 'Mpumalanga', 'North West', 'Northern Cape', 'Western Cape'
        ];

        foreach ($locations as $province) {
            Locations::firstOrCreate(['name' => $province]);
        }
    }
}
