<?php

use Illuminate\Support\Facades\Route;

Route::get('/greeting', function () {
    return 'Hello World';
 });
Route::get('/', function () {
    return view('welcome');
});
Route::get('/korisnik', [KorisnikController::class,'index']);
Route::get('/korisnik/{id}', [KorisnikController::class,'show']);
//Route::get('/knjige', [KnjigaController::class, 'index']);
