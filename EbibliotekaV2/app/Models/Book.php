<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
    'title','description','author','publication_year','content','preview_text','is_published'
];
public function favoredByUsers()
{
    return $this->belongsToMany(User::class, 'favorite_books', 'book_id', 'user_id')->withTimestamps();
}
}
