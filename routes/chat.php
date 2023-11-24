<?php
use App\Events\ChatMessagePublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

Route::get("/chat", function(){
    return view("chat.index");
})->name("user.chat");

Route::get('/api/user', function () {
    return Auth::user();
})->middleware('auth');


Route::prefix('/chat/conversations')->group(function(){
    Route::get("/",function(){
        $senderUsers = Message::where('receiver_id', Auth::user()->id)
        ->with('sender')
        ->groupBy('sender_id')
        ->selectRaw('sender_id, MAX(created_at) as last_message_timestamp')
        ->get();

    $result = $senderUsers->map(function ($sender) {
        return [
            'id' => $sender->sender->id,
            'name' => $sender->sender->name,
            'avatar' => $sender->sender->avatar,
            'status' => 'online',
            'last_message' => Str::limit($sender->sender->sentMessages->first()->message,20),
            'timestamp' => $sender->last_message_timestamp,
        ];
    })->toArray();
        return response()->json($result);
    })->middleware('throttle:10000');



    Route::get('/{id}',function($id){
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
        'senderAvatar' => $sender->avatar,
        'senderStatus' => 'online',
        'senderName' => $sender->name,
        'messagesList' => $messageData->map(function ($message) {
            return [
                'id' => $message->id,
                'senderId' => $message->sender_id,
                'content' => $message->message,
                'timestamp' => $message->created_at,
            ];
            })->toArray(),
        ];
        return response()->json($result);
        } catch (Exception $e) {
            return response()->json(['error'=>$e->getMessage(),'status'=>404],404);
        }

    });

    Route::post('/{id}', function ($id, Request $request) {
        try {
            $request->validate([
                'content' => 'required',
            ]);
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $id,
                'message' => $request->content,
            ]);
            if ($message) {
                $formattedResponse = [
                    'id' => $message->id,
                    'senderId' => $message->sender_id,
                    'content' => $message->message,
                    'timestamp' => $message->created_at->toIso8601String(),
                ];
                broadcast(new ChatMessagePublished(['message'=>$formattedResponse],Auth::user()))->toOthers();
                return response()->json(['status' => 201, 'message' => $formattedResponse]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 404, 'message' => $e->getMessage()]);
        }
    });

})->middleware('auth');