<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FavoriteBooksController;

// ----------------- TEST -----------------
Route::get('/test', fn() => ['msg' => 'API radi']);

// ----------------- AUTH -----------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ----------------- PROTECTED ROUTES -----------------
Route::middleware('auth:sanctum')->group(function () {
    //  Logout & user info
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //  Books (dodavanje, brisanje)
    Route::post('/books', [BookController::class, 'store']);
    Route::delete('/books/{book}', [BookController::class, 'destroy']);

    //  Subscriptions
    Route::get('/subscriptions', [SubscriptionController::class, 'index']);
    Route::post('/subscriptions', [SubscriptionController::class, 'store']);
    Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy']);

    //  Favorites
    Route::get('/favorites', [FavoriteBooksController::class, 'index']);
    Route::post('/favorites/{book}', [FavoriteBooksController::class, 'add']);
    Route::delete('/favorites/{book}', [FavoriteBooksController::class, 'remove']);
});

// ----------------- PUBLIC BOOK ROUTES -----------------
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);
