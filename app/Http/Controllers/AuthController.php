<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
    
        try {
            DB::beginTransaction();
    
            $user =  User::create([
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
            DB::commit();
    
            return response()->json(["message"=>"L'utilisateur a été créé avec succes."]);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
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

    public function all()
    {
            $users= User::all();
        return response()->json([ 'data' => $users ]);
    }
    
    public function getUser(int $userId)
    {
        return response()->json([ 'data' => User::find($userId)->first() ]);
    }
    
    public function edit(UpdateUserRequest $request, int $userId)
    {
        $user = User::find($userId);
    
        //$user->update($request->except(['password']));
        try {
            $user->update($request->validated());
    
            return response()->json(["message"=>"L'utilisateur a été modifié avec succès."]);
        } catch (\Throwable $throwable) {
            Log::error($throwable);
            throw $throwable;
        }
    }
    
    public function delete(int $userId) {
       $user = User::find($userId);
       if($user->id !== Auth::user()->id) {
           return response()->json(["error"=> "Opération dangereuse!!!"], 403);
       }
       $user->delete();
       return response()->json(["message"=>"Utilisateur a été supprimé avec succès."]);
    }
}







