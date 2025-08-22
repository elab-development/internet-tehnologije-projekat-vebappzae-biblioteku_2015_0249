<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Http\Request;



class KorisnikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return response()->json(Korisnik::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'email' => 'required|email|unique:korisniks',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $korisnik = Korisnik::create($validated);

        return response()->json($korisnik, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Korisnik $korisnik_id)
    {
        $korisnik = Korisnik::find($korisnik_id);
        if(is_null($korisnik)){
            return response()->json('Data not found',404);

        }
        return response()->json($korisnik);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Korisnik $korisnik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Korisnik $korisnik)
    {
        $validated = $request->validate([
            'ime' => 'sometimes|string|max:255',
            'prezime' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:korisniks,email,' . $korisnik->id,
            'password' => 'sometimes|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $korisnik->update($validated);

        return response()->json($korisnik, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Korisnik $korisnik)
    {
        $korisnik->delete();
        return response()->json(['message' => 'Korisnik je obrisan'], 200);
    }
}
