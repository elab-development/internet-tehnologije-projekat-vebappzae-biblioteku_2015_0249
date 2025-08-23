<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index() {
    $rentals = Rental::with(['user', 'book'])->get();
    return response()->json($rentals);
}

public function store(Request $request) {
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_id' => 'required|exists:books,id',
        'rented_at' => 'required|date',
    ]);

    $rental = Rental::create($validated);
    return response()->json($rental, 201);
}

public function update(Request $request, Rental $rental) {
    $validated = $request->validate([
        'returned_at' => 'nullable|date',
    ]);

    $rental->update($validated);
    return response()->json($rental);
}

public function destroy(Rental $rental) {
    $rental->delete();
    return response()->json(null, 204);
}
}
