<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class PaimentController extends Controller
{
    public function transaction(int $reservationId){
        $reservation=Reservation::find($reservationId);
    }
}
