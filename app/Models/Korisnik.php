<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Korisnik extends Authenticatable
{
    use HasApiTokens;
}

class Korisnik extends Model
{
    use HasFactory;
}
