<?php

namespace App\Http\Controllers;
use App\Models\Knjiga;
use Illuminate\Http\Request;

class KnjigaController extends Controller
{
    // Prikazuje sve knjige
    public function index()
{
    //$knjige = Knjiga::all();
    //return response()->json($knjige);
    $knjiga = Knjiga::all();
    return $knjiga;


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
        //$this->validate($request, [
          //  'naslov' => 'required|string|max:255',
          //  'autor' => 'required|string|max:255',
          //  'godina_izdanja' => 'required|integer'
        //]);

        //$knjiga = Knjiga::create($request->all());
        //return response()->json($knjiga, 201);
    }

    
    public function update(Request $request, $id)
    {
        /*$knjiga = Knjiga::find($id);

        if (!$knjiga) {
            return response()->json(['message' => 'Knjiga nije pronađena'], 404);
        }

        $knjiga->update($request->all());
        return response()->json($knjiga);*/
    }

    
    public function destroy($id)
    {
        /*$knjiga = Knjiga::find($id);

        if (!$knjiga) {
            return response()->json(['message' => 'Knjiga nije pronađena'], 404);
        }

        $knjiga->delete();
        return response()->json(['message' => 'Knjiga je uspešno obrisana']);*/
    }
}
