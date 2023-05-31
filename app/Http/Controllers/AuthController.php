<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Role;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){

        $user=User::create([
            "name"=>$request->name,
            "password"=>Hash::make($request->password),
            "email"=>$request->email,
            "adress"=>$request->adress,
            "country"=>$request->country,
            "code_postal"=>$request->code_postal,
            "telephone"=>$request->telephone,
            "carte_grise"=>$request->carte_grise,
            "num_permis"=>$request->num_permis,
            "date_emission_permis"=>$request->date_emission_permis,
            "date_expiration_permis"=>$request->date_expiration_permis,
            "photo_permis"=>$request->photo_permis,
            "num_identite"=>$request->num_identite,
            "date_emission_identite"=>$request->date_emission_identite,
            "date_expiration_identite"=>$request->date_expiration_identite,
            "photo_identite"=>$request->photo_identite,
            "annee_experience_conducteur"=>$request->annee_experience_conducteur,
        ]);

        return response()->json(["message"=>"L'utilisateur a été créé avec success"]);
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
 
        $token =$user->createToken($request->email)->plainTextToken;

        return response()->json([
            "user"=>$user,
            "token"=>$token
        ]);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }

    public function vehicule()
    {
        return $this->hasOne(Vehicule::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

