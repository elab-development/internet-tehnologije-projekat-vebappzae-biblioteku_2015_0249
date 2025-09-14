<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //protected $fillable = ['user_id','type','status','start_at','end_at','meta'];

protected $casts = [
    'meta' => 'array',
    'start_at' => 'datetime',
    'end_at' => 'datetime',
];

public function user() {
    return $this->belongsTo(User::class);
}
}
