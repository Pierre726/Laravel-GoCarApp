<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TrajetController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get("/me", function (Request $request) {
    return $request->user();
});

Route::post("/register",[AuthController::class,'register']);
Route::post("/login", [Authcontroller::class,'login']); 
Route::middleware('auth:sanctum')->group(function(){
Route::get("/users",[AuthController::class,'all']);
Route::get("/user/{id}", [Authcontroller::class,'getUser']);
Route::put("/user/{id}", [Authcontroller::class,'edit']);
Route::delete("/user/{id}", [Authcontroller::class,'delete']);
});


Route::get("trajet/search", [TrajetController::class, 'searchTrajets']);
Route::middleware('auth:sanctum')->group(function(){
Route::post("/publier", [TrajetController::class,'publier']);
Route::get("/trajets",[TrajetController::class,'all']);
Route::get("/trajet/{id}", [TrajetController::class,'getTrajet']);
Route::put("/trajet/{id}", [TrajetController::class,'edit']);
Route::delete("/trajet/{id}", [Trajetcontroller::class,'delete']);
});

Route::middleware('auth:sanctum')->post("/reserver", [ReservationController::class,'reserver']);
