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
            'image' => '/images/nadrinicuprija.png',
            'user_id' => 1,
        ]);

        Book::create([
            'title' => 'Prokleta Avlija',
            'author' => 'Ivo Andrić',
            'content' => str_repeat("Ovo je sadržaj knjige Prokleta Avlija.\n", 50),
            'image' => '/images/prokletaavlija.jpg',
            'user_id' => 1,
        ]);

        Book::create([
            'title' => 'Seobe',
            'author' => 'Miloš Crnjanski',
            'content' => str_repeat("Ovo je sadržaj knjige Seobe.\n", 50),
            'image' => '/images/seobe.jpg',
            'user_id' => 1,
        ]);

        Book::create([
            'title' => 'Zona Zamfirova',
            'author' => 'Stevan Sremac',
            'content' => str_repeat("Ovo je sadržaj knjige Zona Zamfirova.\n", 50),
            'image' => '/images/zonazamfirova.jpg',
            'user_id' => 1,
        ]);

        Book::create([
            'title' => 'Ana Karenjina',
            'author' => 'Lav Tolstoj',
            'content' => str_repeat("Ovo je sadržaj knjige Ana Karenjina.\n", 50),
            'image' => '/images/anakarenjina.jpg',
            'user_id' => 1,
        ]);

        Book::create([
            'title' => 'Zločin i kazna',
            'author' => 'Fjodor Mihailovič Dostojevski',
            'content' => str_repeat("Ovo je sadržaj knjige Zločin i kazna.\n", 50),
            'image' => '/images/zlocinikazna.jpg',
            'user_id' => 1,
        ]);

        Book::create([
            'title' => 'Hazarski rečnik',
            'author' => 'Milorad Pavić',
            'content' => str_repeat("Ovo je sadržaj knjige Hazarski rečnik.\n", 50),
            'image' => '/images/hazarskirecnik.jpg',
            'user_id' => 1,
        ]);
    }
}
