<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chatMessage(Request $request){
        try {
            DB::beginTransaction();
    
            $user =  Message::create([
                'message' =>$request->message,
                'conversationId' =>$request->conversationId,
                'created_by' =>Auth::user()->id,
            ]);
            DB::commit();
    
            return response()->json(["message"=>"Envoyer!!!."]);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
    }
    
}
