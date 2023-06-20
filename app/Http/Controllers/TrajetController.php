<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTrajetRequest;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TrajetController extends Controller
{
    public function publier(Request $request)
    {
        $trajet=Trajet::create([
            'user_id' =>$request->user()->id,
            'depart' =>$request->depart,
            'destination' =>$request->destination,
            'dateTrajet' => $request->dateTrajet,
            'heureDepart' => $request->heureDepart,
            'nbrPassager' =>$request->nbrPassager,
            'prix' =>$request->prix,
            'conditions' =>$request->conditions,
            'numPermis' =>$request->numPermis,
            'immatriculation' =>$request->immatriculation,
        ]);

        return response()->json(["message"=>["succes"=>"Votre trajet a été publié avec succès!!"], 
                            "trajet"=>$trajet
        ]);
    }

    public function searchTrajets(Request $request)
    {
        $depart = $request->query('depart');
        $destination = $request->query('destination');
        $dateTrajet = $request->query('date');
        $nbrPassager = $request->query('nombre_passager');

        $trajets = Trajet::query();

        if ($depart) {
            $trajets->where('depart', 'LIKE', '%' . $depart . '%');
        }

        if ($destination) {
            $trajets->where('destination', 'LIKE', '%' . $destination . '%');
        }

        if ($dateTrajet) {
            $trajets->whereDate('date', $dateTrajet);
        }

        if ($nbrPassager) {
            $trajets->where('nombre_passager', $nbrPassager);
        }

        $searchTrajets = $trajets->get();

        return response()->json($searchTrajets);
    }

    public function all()
    {
            $trajets= Trajet::all();
        return response()->json([ 'data' => $trajets ]);
    }
    
    public function getTrajet(int $trajetId)
    {
        return response()->json([ 'data' => Trajet::find($trajetId)]);
    }
    
    public function edit(UpdateTrajetRequest $request, int $trajetId)
    {
        $trajet = Trajet::find($trajetId);
    
        try {
            if($trajet->user_id !== Auth::user()->id) {
                return response()->json(["error"=> "Opération dangereuse!!!"], 403);
            }
            $trajet->update($request->validated());
    
            return response()->json(["message"=>"Le trajet a été modifié avec succès."]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }

    public function delete(int $trajetId) {
        $trajet = Trajet::find($trajetId);
        if($trajet->user_id !== Auth::user()->id) {
            return response()->json(["error"=> "Opération dangereuse!!!"], 403);
        }
        //$raison=$request->input('raison');
        $trajet->delete();
        return response()->json(["message"=>"Le trajet a été supprimé avec succès."]);
    }

    public function getUserTrajets(int $user_id)
    {
        $user_id = Trajet::find($user_id);

       
           $user_id=Trajet::where($user_id == Auth::user()->id)->get();

        return response()->json($user_id);
    }

}
    