<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

        return response()->json(["message"=>"Le trajet a été publié avec success"]);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
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
}
