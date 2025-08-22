<?php
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KnjigaController;
use App\Http\Controllers\pretplataController;
use App\Http\Controllers\KorisnikController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/knjigas', KnjigaController::class);
Route::apiResource('/pretplatas', PretplataController::class);
Route::apiResource('/korisniks', KorisnikController::class);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('/auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::get('/all-knjigas', [KnjigaController::class, 'getAllBooks']);
Route::middleware('auth:sanctum')->post('/create-knjiga', [KnjigaController::class, 'createBook']);
Route::middleware('auth:sanctum')->put('/update-knjiga/{id}', [KnjigaController::class, 'updateBook']);
Route::middleware('auth:sanctum')->delete('/delete-knjiga/{id}', [KnjigaController::class, 'deleteBook']);
Route::middleware('auth:sanctum')->get('/pretplata/{id}', [PretplataController::class, 'checkSubscriptionStatus']);
Route::middleware('auth:sanctum')->get('/knjige/{id}', [KnjigaController::class, 'checkAccessToBook']);
Route::get('/knjige/{id}/preview', [KnjigaController::class, 'getBookPreview']);



//Route::get('/knjige', [KnjigaController::class, 'index']);




