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
        return response()->json($book);
    }

}