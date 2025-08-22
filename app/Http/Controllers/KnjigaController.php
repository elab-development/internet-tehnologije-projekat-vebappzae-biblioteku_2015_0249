<?php

namespace App\Http\Controllers;
use App\Models\Knjiga;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Pretplata;


class KnjigaController extends Controller
{
    // Prikazuje sve knjige
    public function index()
{
    $knjige = Knjiga::all();
    return response()->json($knjige);
    /*$knjiga = Knjiga::all();
    return $knjiga;*/


}

    public function show(Knjiga $knjiga)
    {

        $knjiga = Knjiga::find($id);
        
        if (!$knjiga) {
            return response()->json(['message' => 'Knjiga nije pronađena'], 404);
        }

       // return response()->json($knjiga);
       return new PostResource($knjiga);
    }
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
           'naslov' => 'required|string|max:255',
           'autor' => 'required|string|max:255',
           'godina_izdanja' => 'required|integer'
        ]);

        $knjiga = Knjiga::create($request->all());
        return response()->json($knjiga, 201);
    }

    
    public function update(Request $request, $id)
    {
        $knjiga = Knjiga::find($id);

        if (!$knjiga) {
            return response()->json(['message' => 'Knjiga nije pronađena'], 404);
        }

        $knjiga->update($request->all());
        return response()->json($knjiga);
    }

    public function getAllBooks()
    {
        // Vraćanje svih knjiga u JSON formatu
        return response()->json(Knjiga::all(), 200);
    }
    

    
    public function destroy($id)
    {
        $knjiga = Knjiga::find($id);

        if (!$knjiga) {
            return response()->json(['message' => 'Knjiga nije pronađena'], 404);
        }

        $knjiga->delete();
        return response()->json(['message' => 'Knjiga je uspešno obrisana']);
    }
    public function createBook(Request $request)
{
    // Validacija podataka
    $validated = $request->validate([
        'naziv' => 'required|string|max:255',
        'autor' => 'required|string|max:255',
        'godina_izdanja' => 'required|integer',
        'kategorija' => 'required|string|max:255',
    ]);

    // Kreiranje nove knjige
    $knjiga = Knjiga::create([
        'naziv' => $validated['naziv'],
        'autor' => $validated['autor'],
        'godina_izdanja' => $validated['godina_izdanja'],
        'kategorija' => $validated['kategorija'],
    ]);

    // Vraćanje odgovora sa statusom 201 (Created) i novom knjigom
    return response()->json($knjiga, 201);
}
public function updateBook(Request $request, $id)
{
    // Pronalaženje knjige prema ID-u
    $knjiga = Knjiga::find($id);

    // Ako knjiga ne postoji, vraća grešku 404
    if (!$knjiga) {
        return response()->json(['message' => 'Knjiga nije pronađena'], 404);
    }

    // Validacija podataka
    $validated = $request->validate([
        'naziv' => 'sometimes|required|string|max:255',
        'autor' => 'sometimes|required|string|max:255',
        'godina_izdanja' => 'sometimes|required|integer',
        'kategorija' => 'sometimes|required|string|max:255',
    ]);

    // Ažuriranje knjige
    $knjiga->update($validated);

    // Vraćanje ažurirane knjige
    return response()->json($knjiga, 200);
}

public function deleteBook($id)
{
    // Pronalaženje knjige prema ID-u
    $knjiga = Knjiga::find($id);

    // Ako knjiga ne postoji, vraća grešku 404
    if (!$knjiga) {
        return response()->json(['message' => 'Knjiga nije pronađena'], 404);
    }

    // Brisanje knjige
    $knjiga->delete();

    // Vraćanje odgovora sa statusom 204 (No Content) jer nije potrebno vraćati telo odgovora
    return response()->json(null, 204);
}
public function checkAccessToBook($knjigaId)
    {
        $korisnik = auth()->user();
        $pretplata = $korisnik->pretplate()->latest()->first(); // Uzima poslednju pretplatu korisnika

        if ($pretplata) {
            $now = Carbon::now();
            if ($now->between($pretplata->pocetak_pretplate, $pretplata->kraj_pretplate)) {
                return response()->json([
                    'message' => 'Dozvoljen pristup svim knjigama',
                    'knjiga' => Knjiga::find($knjigaId)
                ]);
            } else {
                return response()->json([
                    'message' => 'Istekla pretplata, nemate pristup ka celoj knizi'
                ], 403);
            }
        } else {
            return response()->json([
                'message' => 'Niste ulogovani, imate ograničen pristup knjigama'
            ], 403);
        }
    }
    public function checkAccessToBookParts($knjigaId)
    {
        $korisnik = auth()->user();
        
        // Ako korisnik nije ulogovan
        if (!$korisnik) {
            return response()->json([
                'message' => 'Niste prijavljeni. Pristup je ograničen na delove knjige.'
            ], 403);
        }

        $pretplata = $korisnik->pretplate()->latest()->first(); // Uzima poslednju pretplatu korisnika

        if ($pretplata) {
            $now = Carbon::now();
            if ($now->between($pretplata->pocetak_pretplate, $pretplata->kraj_pretplate)) {
                // Ako je korisnik prijavljen i ima aktivnu pretplatu
                return response()->json([
                    'message' => 'Pristup celokupnoj knjizi je omogućen.',
                    'knjiga' => Knjiga::find($knjigaId)
                ]);
            } else {
                // Ako je pretplata istekla
                return response()->json([
                    'message' => 'Vaša pretplata je istekla, pristup je ograničen.'
                ], 403);
            }
        } else {
            // Ako korisnik nema aktivnu pretplatu
            return response()->json([
                'message' => 'Nemate aktivnu pretplatu, pristup je ograničen na delove knjige.'
            ], 403);
        }
    }

}
