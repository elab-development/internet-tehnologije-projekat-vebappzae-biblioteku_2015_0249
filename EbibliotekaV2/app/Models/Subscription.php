<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'duration_days',
    ];

    // Jedan plan može imati više korisnika
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Plan se može povezati sa više knjiga
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_subscription', 'subscription_id', 'book_id');
    }
}
