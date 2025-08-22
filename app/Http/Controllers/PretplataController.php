<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PretplataController extends Controller
{
    public function checkSubscriptionStatus($id)
{
    $pretplata = Pretplata::findOrFail($id);

    $today = now(); // Trenutni datum

    if ($pretplata->status_pretplate === 'nema_pretplatu' || $pretplata->kraj_pretplate < $today) {
        return response()->json(['status' => 'istekla'], 200);
    }

    if ($pretplata->status_pretplate === 'nedeljna' && $today->diffInDays($pretplata->pocetak_pretplate) < 7) {
        return response()->json(['status' => 'aktivna'], 200);
    }

    if ($pretplata->status_pretplate === 'mesecna' && $today->diffInMonths($pretplata->pocetak_pretplate) < 1) {
        return response()->json(['status' => 'aktivna'], 200);
    }

    if ($pretplata->status_pretplate === 'godisnja' && $today->diffInYears($pretplata->pocetak_pretplate) < 1) {
        return response()->json(['status' => 'aktivna'], 200);
    }

    return response()->json(['status' => 'istekla'], 200);
}
    public function index()
    {
        $iznajmljivanja = pretplata::all();
        return response()->json($iznajmljivanja);
    }

    // Prikazuje jedno pretplata po ID-u
    public function show($id)
    {
        $pretplata = pretplata::find($id);

        if (!$pretplata) {
            return response()->json(['message' => 'pretplata nije pronađeno'], 404);
        }

        return response()->json($pretplata);
    }

    // Kreira novo pretplata
    public function store(Request $request)
    {
        $this->validate($request, [
            'knjiga_id' => 'required|integer|exists:knjige,id',
            'korisnik_id' => 'required|integer|exists:korisnici,id',
            'pocetak_pretplate' => 'required|date',
            'kraj_pretplate' => 'nullable|date|after_or_equal:pocetak_pretplate'
        ]);

        $pretplata = pretplata::create($request->all());
        return response()->json($pretplata, 201);
    }

    // Ažurira postojeće pretplata
    public function update(Request $request, $id)
    {
        $pretplata = pretplata::find($id);

        if (!$pretplata) {
            return response()->json(['message' => 'pretplata nije pronađeno'], 404);
        }

        $pretplata->update($request->all());
        return response()->json($pretplata);
    }

    // Briše pretplata
    public function destroy($id)
    {
        $pretplata = pretplata::find($id);

        if (!$pretplata) {
            return response()->json(['message' => 'pretplata nije pronađeno'], 404);
        }

        $pretplata->delete();
        return response()->json(['message' => 'pretplata je uspešno obrisano']);
    }
}
