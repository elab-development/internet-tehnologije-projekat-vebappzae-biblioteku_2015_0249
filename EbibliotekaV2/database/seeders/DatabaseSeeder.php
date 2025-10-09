<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        // Seed korisnika 
       User::factory()->create([
    'first_name' => 'Test',
    'last_name' => 'User',
    'email' => 'test@example.com',
    'password' => bcrypt('password'), // lozinka
    'birth_year' => 1995, // 
]);


        // Dodavanje knjiga
        $this->call([
            BookSeeder::class,
        ]);
        
    $this->call([
        SubscriptionSeeder::class,
    ]);

    }
}
