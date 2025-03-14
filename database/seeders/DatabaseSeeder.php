<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create(
            [
              'name' => 'John',
                'email' => 'john@ab4ir.org',
                'password'=>'123456789'
            
        ]);

        $this->call([
            LocationsSeeder::class,
        ]);

        $this->call(
            ProgramsSeeder::class
        );
    }
}
