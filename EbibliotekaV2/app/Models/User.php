<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Fillable columns (mass assignment).
     */
    protected $fillable = [
    'first_name', 'last_name', 'email', 'password', 'birth_year'
];

    /**
     * Hidden fields when returning JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts for special columns.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth_date' => 'date',
    ];

    /**
     * Relation: one user can have many subscriptions.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
