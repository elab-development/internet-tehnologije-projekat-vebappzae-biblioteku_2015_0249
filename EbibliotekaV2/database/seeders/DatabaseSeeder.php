<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed korisnika (ostavi ovo ako želiš default user-a)
       User::factory()->create([
    'first_name' => 'Test',
    'last_name' => 'User',
    'email' => 'test@example.com',
    'password' => bcrypt('password'), // obavezno lozinka
    'birth_year' => 1995, // možeš dodati ili izostaviti
]);


        // ✅ Dodajemo i knjige
        $this->call([
            BookSeeder::class,
        ]);
    }
}
