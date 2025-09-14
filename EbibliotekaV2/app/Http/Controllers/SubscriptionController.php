<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    // Prikaz pretplata korisnika
    public function index(Request $request)
    {
        return response()->json($request->user()->subscriptions);
    }

    // Kreiranje pretplate
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'status' => 'required|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);

        $subscription = $request->user()->subscriptions()->create($request->all());

        return response()->json($subscription, 201);
    }

    // Brisanje pretplate
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->json(['message' => 'Subscription deleted']);
    }
}
