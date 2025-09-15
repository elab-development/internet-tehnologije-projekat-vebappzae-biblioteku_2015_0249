<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'year',
        'user_id',
    ];

    // Veza sa korisnikom koji je dodao knjigu
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

