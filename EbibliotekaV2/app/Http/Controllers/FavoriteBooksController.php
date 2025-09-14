<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class FavoriteBooksController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->favoriteBooks);
    }

    public function add(Request $request, Book $book)
    {
        $request->user()->favoriteBooks()->syncWithoutDetaching([$book->id]);
        return response()->json(['message' => 'Book added to favorites']);
    }

    public function remove(Request $request, Book $book)
    {
        $request->user()->favoriteBooks()->detach($book->id);
        return response()->json(['message' => 'Book removed from favorites']);
    }
}

