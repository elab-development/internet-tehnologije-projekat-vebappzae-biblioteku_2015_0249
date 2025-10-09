<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Lista svih knjiga (dostupna svima)
    public function index()
    {
        return response()->json(Book::all());
    }

    // Prikaz knjige — ceo sadržaj samo za pretplaćene korisnike
    public function show(Book $book)
    {
        // Pokušaj da uzmeš korisnika iz tokena (čak i bez middleware-a)
        $user = Auth::guard('sanctum')->user();
        $isSubscribed = false;

        if ($user && $user->hasActiveSubscription()) {
            $isSubscribed = true;
        } else {
            // Ako nije pretplaćen — skrati sadržaj
            $book->content = substr($book->content, 0, 500);
        }

        // Dodaj informaciju o statusu pretplate
        $book->is_subscribed = $isSubscribed;

        return response()->json($book);
    }

    //  Dodavanje nove knjige (zaštićeno)
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

    //  Brisanje knjige (zaštićeno)
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['message' => 'Knjiga obrisana.']);
    }
}
