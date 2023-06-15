<?php

namespace App\Http\Controllers;

use App\Models\Paiment;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaimentController extends Controller
{
    public function transaction (Request $request){
    
        try {
            DB::beginTransaction();
    
            $user =  Paiment::create([
                'user_id' =>$request->user()->id,
                'reservation_id' =>$request->reservation_id,
                'montant'=>$request->montant,
                'datePaiement'=>$request->datePaiement,
                'transactionId'=>$request->transactionId,
            ]);
            DB::commit();
    
            return response()->json(["message"=>"Votre transaction a été créé avec succes."]);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
    }
}
