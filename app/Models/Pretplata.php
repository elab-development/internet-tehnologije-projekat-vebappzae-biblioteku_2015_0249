<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pretplata extends Model
{
    protected $fillable = [
        'korisnik_id', // Id korisnika
        'pocetak_pretplate',
        'kraj_pretplate',
        'status_pretplate'
    ];
}
