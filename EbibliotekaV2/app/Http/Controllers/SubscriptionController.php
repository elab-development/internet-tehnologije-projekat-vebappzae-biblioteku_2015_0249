<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->subscription);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Morate biti prijavljeni da biste se pretplatili.'], 401);
        }

        $data = $request->validate([
            'type' => 'required|string|in:monthly,6months,yearly',
        ]);

        $plan = Subscription::where('type', $data['type'])->firstOrFail();
        $endDate = now()->addDays($plan->duration_days);

        // ✅ Postavi korisniku novu pretplatu
        $user->update([
            'subscription_id' => $plan->id,
            'subscription_start' => now(),
            'subscription_end' => $endDate,
        ]);

        return response()->json([
            'message' => 'Pretplata uspešno aktivirana.',
            'subscription' => $plan,
            'active_until' => $endDate
        ]);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        $user->update([
            'subscription_id' => null,
            'subscription_start' => null,
            'subscription_end' => null,
        ]);

        return response()->json(['message' => 'Pretplata ukinuta.']);
    }
}
