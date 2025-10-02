<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
    'title' => 'Na Drini ćuprija',
    'author' => 'Ivo Andrić',
    'content' => str_repeat("Ovo je sadržaj knjige Na Drini ćuprija.\n", 50),
    'image' => 'https://via.placeholder.com/300x400?text=Na+Drini+Cuprija',
    'user_id' => 1,
]);

Book::create([
    'title' => 'Seobe',
    'author' => 'Miloš Crnjanski',
    'content' => str_repeat("Ovo je sadržaj knjige Seobe.\n", 50),
    'image' => 'https://via.placeholder.com/300x400?text=Seobe',
    'user_id' => 1,
]);

Book::create([
    'title' => 'Hazarski rečnik',
    'author' => 'Milorad Pavić',
    'content' => str_repeat("Ovo je sadržaj knjige Hazarski rečnik.\n", 50),
    'image' => 'https://via.placeholder.com/300x400?text=Hazarski+Recnik',
    'user_id' => 1,
]);

    }
}
