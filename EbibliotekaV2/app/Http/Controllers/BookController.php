<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Prikaz svih knjiga – dostupno svima
    public function index()
    {
        return response()->json(Book::all());
    }

    // Prikaz jedne knjige – dostupno svima
    public function show(Book $book)
    {
        $user = auth()->user();

        if (!$user || !$user->hasActiveSubscription()) {
            // Ako nema aktivnu pretplatu → prikaži samo deo sadržaja
            $book->content = substr($book->content, 0, 10 * 1000); 
        }

        return response()->json($book);
    }

    // Dodavanje nove knjige – samo ulogovani
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    // Brisanje knjige – samo ulogovani
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['message' => 'Knjiga obrisana']);
    }
}
