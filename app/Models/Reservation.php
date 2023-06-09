<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'user_id',
        'trajet_id',
        'statut',
        'dateReservation',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function trajet(){
        return $this->belongsTo(Trajet::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
