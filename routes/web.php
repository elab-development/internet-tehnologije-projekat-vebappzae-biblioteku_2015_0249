<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KnjigaController;
use App\Http\Controllers\IznajmljivanjeController;
use App\Http\Controllers\KorisnikController;

Route::get('/greeting', function () {
    return 'Hello World';
 });
Route::get('/', function () {
    return view('welcome');
});
Route::get('/korisnik', [KorisnikController::class,'index']);
Route::get('/korisnik/{id}', [KorisnikController::class,'show']);
Route::get('/knjige', [KnjigaController::class, 'index']);
