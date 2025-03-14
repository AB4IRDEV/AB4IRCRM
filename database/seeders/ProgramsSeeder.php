<?php

namespace Database\Seeders;

use App\Models\Programs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs =['Drone Technology','Animation','Gaming','I Can Code'];
        foreach ($programs as $program) {
            Programs::firstOrCreate(['name'=>$program]);
        }
    }

  
}
