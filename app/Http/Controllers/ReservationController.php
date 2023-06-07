<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
   
    public function reserver(Request $request){
        $nbReservation=Reservation::where('statut', 'confirmer')->where('trajet_id', $request->trajet_id)->count();
        $trajet=Trajet::where('id', $request->trajet_id)->first();
        
        if($nbReservation < $trajet->nbrPassager){
            Reservation::create([
                'user_id' =>$request->user()->id,
                'trajet_id' =>$request->trajet_id,
                'statut' =>'confirmer',
                'dateReservation' => $request->dateReservation,
            ]);
        }
        else{
           return response()->json(["error"=>"Y'a plus de place disponible sur ce trajet"], 422);
        }
       

        return response()->json(["message"=>"Votre réservation a été enrégistré!!"]);
    }
}
