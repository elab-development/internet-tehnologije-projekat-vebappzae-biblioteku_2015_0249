<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FavoriteBooksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Ovde registrujemo sve API rute. Sve rute u ovoj datoteci koriste "api"
| middleware grupu automatski.
|
*/

// ----------------- AUTH -----------------

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Logout – samo ulogovani
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// ----------------- BOOKS -----------------

// Svi korisnici (ulogovani ili ne) mogu da vide knjige
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);

// Samo ulogovani mogu dodavati knjige i brisati svoje
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::delete('/books/{book}', [BookController::class, 'destroy']);
});

// ----------------- SUBSCRIPTIONS -----------------

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/subscriptions', [SubscriptionController::class, 'index']);
    Route::post('/subscriptions', [SubscriptionController::class, 'store']);
    Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy']);
});

// ----------------- FAVORITE BOOKS -----------------

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/favorites', [FavoriteBooksController::class, 'index']);
    Route::post('/favorites/{book}', [FavoriteBooksController::class, 'add']);
    Route::delete('/favorites/{book}', [FavoriteBooksController::class, 'remove']);
});
