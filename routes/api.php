<?php
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KnjigaController;
use App\Http\Controllers\IznajmljivanjeController;
use App\Http\Controllers\KorisnikController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/knjigas', KnjigaController::class);
Route::apiResource('/iznajmljivanjes', IznajmljivanjeController::class);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('/auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::resource('posts',PostTestController::class);

//Route::get('/knjige', [KnjigaController::class, 'index']);




