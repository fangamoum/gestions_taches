<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taches extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'priorite',
        'status',
    ];
}
