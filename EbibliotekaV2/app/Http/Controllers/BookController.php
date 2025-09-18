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

  public function show(Book $book)
{
    $user = auth()->user();

    if(!$user || !$user->hasActiveSubscription()) {
        // Prikaži samo prvih 10 stranica
        $book->content = substr($book->content, 0, 10 * 1000); // npr. 1000 karaktera po stranici
    }

    return response()->json($book);
}



