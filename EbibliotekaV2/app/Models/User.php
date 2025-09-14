<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birth_year',
        'membership_level'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function favoriteBooks()
{
    return $this->belongsToMany(Book::class, 'favorite_books', 'user_id', 'book_id')->withTimestamps();
}
}