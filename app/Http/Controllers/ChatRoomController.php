<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatRoomController extends Controller
{
    public function chatRoom(Request $request){
        try {
            DB::beginTransaction();
    
            $conversation=Conversation::create([
                'sender' =>$request->user()->id,
                'receiver' =>$request->receiver,
            ]);
            DB::commit();
    
            return response()->json(["message"=>["succes"=>"ChatRoom Build!!!"], "others"=>$conversation]);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable);
            throw $throwable;
        }
    }
}
