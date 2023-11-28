<?php

namespace App\Http\Controllers\Web;

use App\Events\ChatMessagePublished;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class MessageController extends Controller
{
    public function conversations(){
        $senderUsers = Message::where('receiver_id', Auth::user()->id)
        ->with('sender')
        ->groupBy('sender_id')
        ->selectRaw('sender_id, MAX(created_at) as last_message_timestamp')
        ->get();
    $result = $senderUsers->map(function ($sender) {
        $last_message = Message::where('receiver_id', Auth::user()->id)->where('sender_id',$sender->sender_id)->orderBy('id','desc')->latest()->first();
        return [
            'id' => $sender->sender->id,
            'name' => $sender->sender->name,
            'userName'=>$sender->sender->username,
            'avatar' => $sender->sender->avatar,
            'status' => 'available',
            'lastMessage' => Str::limit($last_message->message,20),
            'timestamp' => $sender->last_message_timestamp,
        ];
    })->toArray();
        return response()->json($result);
    }

    public function getChatMessagesById($id){
        try {
            $messageData = Message::where(function ($query) use ($id) {
             $query->where('sender_id', Auth::user()->id)
                 ->where('receiver_id', $id);
         })
         ->orWhere(function ($query) use ($id) {
             $query->where('sender_id', $id)
                 ->where('receiver_id', Auth::user()->id);
         })
         ->with(['sender:id,name,avatar,status','receiver:id,name,avatar'])
         ->limit(50)
         // ->orderBy('created_at', 'asc')
         ->get();
         $sender = User::find($id);

         $result = [
         'status'=>200,
         'messagesList' => $messageData->map(function ($message) {
             return [
                 'id' => $message->id,
                 'senderId' => $message->sender_id,
                 'text' => $message->message,
                 'timestamp' => $message->created_at,
             ];
             })->toArray(),
         ];
         return response()->json($result);
         } catch (Exception $e) {
             return response()->json(['error'=>$e->getMessage(),'status'=>404],404);
         }
    }

    public function storeChatMessage($id, Request $request){
        try {
            $request->validate([
                'text' => 'required',
            ]);
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $id,
                'message' => $request->text,
            ]);
            $receiver = User::find($id);
            if ($message) {
                $formattedResponse = [
                    'id' => $message->id,
                    'senderId' => $message->sender_id,
                    'text' => $message->message,
                    'timestamp' => $message->created_at->toIso8601String(),
                ];
                broadcast(new ChatMessagePublished(['message'=>$formattedResponse],$receiver))->toOthers();
                return response()->json(['message' => $formattedResponse]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 404, 'message' =>$formattedResponse,'error'=> $e->getMessage()]);
        }
    }
}