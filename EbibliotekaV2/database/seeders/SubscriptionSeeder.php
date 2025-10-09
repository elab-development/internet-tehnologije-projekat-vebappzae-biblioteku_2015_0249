<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::insert([
            [
                'type' => 'monthly',
                'price' => 9.99,
                'duration_days' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => '6months',
                'price' => 49.99,
                'duration_days' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'yearly',
                'price' => 89.99,
                'duration_days' => 365,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
