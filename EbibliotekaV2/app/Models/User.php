<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Subscription;
use App\Models\Book;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birth_year',
        'subscription_id',
        'subscription_start',
        'subscription_end',
        'membership_level'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Korisnik pripada jednoj pretplati (ili nijednoj)
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    // Korisnik može imati više knjiga
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Omiljene knjige
    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'favorite_books', 'user_id', 'book_id')
                    ->withTimestamps();
    }

    // Provera aktivne pretplate
    public function hasActiveSubscription()
    {
        return $this->subscription && $this->subscription_end && now()->lt($this->subscription_end);
    }
}
