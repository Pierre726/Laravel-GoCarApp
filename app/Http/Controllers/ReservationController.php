<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
   
    public function reserver(Request $request){
        $nbReservation=Reservation::where('statut', 'confirmer')->where('trajet_id', $request->trajet_id)->count();
        $trajet=Trajet::where('id', $request->trajet_id)->first();
        
        if($nbReservation < $trajet->nbrPassager){
            $reservation=Reservation::create([
                'user_id' =>$request->user()->id,
                'trajet_id' =>$request->trajet_id,
                'statut' =>'confirmer',
                'dateReservation' => $request->dateReservation,
            ]);
        }
        else{
           return response()->json(["error"=>"Y'a plus de place disponible sur ce trajet"], 422);
        }
       
      
        return response()->json(["message"=>["succes"=>"Votre réservation a été enrégistré!!"], 
                            "reservationId"=>$reservation
        ]);
    }

    public function all()
    {
            $reservations= Reservation::all();
        return response()->json([ 'data' => $reservations ]);
    }
    
    public function getReservation(int $reservationId)
    {
        return response()->json([ 'data' => Reservation::find($reservationId)]);
    }
    
    // public function edit(UpdateReservationRequest $request, int $reservationId)
    // {
    //     $reservation = Reservation::find($reservationId);
    
    //     try {
    //         if($reservation->user_id !== Auth::user()->id) {
    //             return response()->json(["error"=> "Opération dangereuse!!!"], 403);
    //         }
    //         $reservation->update($request->validated());
    
    //         return response()->json(["message"=>"Le reservation a été modifié avec succès."]);
    //     } catch (\Throwable $throwable) {
    //         Log::error($throwable);
    //         throw $throwable;
    //     }
    // }

    // public function delete(int $reservationId) {
    //     $reservation = Reservation::find($reservationId);
    //     if($reservation->user_id !== Auth::user()->id) {
    //         return response()->json(["error"=> "Opération dangereuse!!!"], 403);
    //     }
    //     //$raison=$request->input('raison');
    //     $reservation->delete();
    //     return response()->json(["message"=>"Le reservation a été supprimé avec succès."]);
    //  }
}
