<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function trajet(){
        return $this->belongsTo(Trajet::class);
    }

    public function reserver(Request $request){
        $reservation=Reservation::create([
            'user_id' =>$request->user()->id,
            'trajet_id' =>$request->trajet()->id,
            'lieuDepart' =>$request->lieuDepart,
            'lieuDarrive' =>$request->lieuDarrive,
            'statut' =>$request->statut,
            'dateReservation' => $request->dateReservation,
            'nbReservation' => $request->nbReservation,
        ]);

        return response()->json(["message"=>"Votre réservation a été enrégistré!!"]);
    }
}
