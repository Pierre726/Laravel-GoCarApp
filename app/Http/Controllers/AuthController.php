<?php

namespace App\Http\Controllers;

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
            "email"=>$request->email

        ]);

        return response()->json(["message"=>"L'utilisateur a été créer avec success"]);
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
}

