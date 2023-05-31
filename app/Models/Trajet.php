<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'depart',
        'destination',
        'dateTrajet',
        'heureDepart',
        'nbrPassager',
        'prix',
        'conditions',
        'numPermis',
        'immatriculation',
    ];
}
