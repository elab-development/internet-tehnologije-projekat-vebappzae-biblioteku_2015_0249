<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Metod za registraciju korisnika
    public function register(Request $request)
    {
        // Validacija podataka
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Kreiranje novog korisnika
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Vraćanje tokena
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    // Metod za prijavu korisnika
    public function login(Request $request)
    {
        // Validacija podataka
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Pronalaženje korisnika prema email-u
        $user = User::where('email', $request->email)->first();

        // Provera da li je korisnik validan
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Kreiranje tokena za prijavljenog korisnika
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Metod za odjavu korisnika
    public function logout(Request $request)
    {
        // Brisanje tokena koji je korisnik koristio za autentifikaciju
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
