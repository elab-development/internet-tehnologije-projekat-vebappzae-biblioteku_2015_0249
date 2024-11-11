<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IznajmljivanjeController extends Controller
{
    public function index()
    {
        $iznajmljivanja = Iznajmljivanje::all();
        return response()->json($iznajmljivanja);
    }

    // Prikazuje jedno iznajmljivanje po ID-u
    public function show($id)
    {
        $iznajmljivanje = Iznajmljivanje::find($id);

        if (!$iznajmljivanje) {
            return response()->json(['message' => 'Iznajmljivanje nije pronađeno'], 404);
        }

        return response()->json($iznajmljivanje);
    }

    // Kreira novo iznajmljivanje
    public function store(Request $request)
    {
        $this->validate($request, [
            'knjiga_id' => 'required|integer|exists:knjige,id',
            'korisnik_id' => 'required|integer|exists:korisnici,id',
            'datum_iznajmljivanja' => 'required|date',
            'datum_vracanja' => 'nullable|date|after_or_equal:datum_iznajmljivanja'
        ]);

        $iznajmljivanje = Iznajmljivanje::create($request->all());
        return response()->json($iznajmljivanje, 201);
    }

    // Ažurira postojeće iznajmljivanje
    public function update(Request $request, $id)
    {
        $iznajmljivanje = Iznajmljivanje::find($id);

        if (!$iznajmljivanje) {
            return response()->json(['message' => 'Iznajmljivanje nije pronađeno'], 404);
        }

        $iznajmljivanje->update($request->all());
        return response()->json($iznajmljivanje);
    }

    // Briše iznajmljivanje
    public function destroy($id)
    {
        $iznajmljivanje = Iznajmljivanje::find($id);

        if (!$iznajmljivanje) {
            return response()->json(['message' => 'Iznajmljivanje nije pronađeno'], 404);
        }

        $iznajmljivanje->delete();
        return response()->json(['message' => 'Iznajmljivanje je uspešno obrisano']);
    }
}
