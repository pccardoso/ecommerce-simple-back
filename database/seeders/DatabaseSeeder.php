<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'paulo.cardoso2408@gmail.com',
            'password' => 'P@ulo6085'
        ]);
    }
}
