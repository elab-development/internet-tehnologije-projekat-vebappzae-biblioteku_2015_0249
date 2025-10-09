<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subscription;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'publication_year',
        'content',
        'image',
        'user_id',
    ];

    // Knjigu je dodao korisnik
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Knjiga pripada više planova pretplate
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'book_subscription', 'book_id', 'subscription_id');
    }
}
