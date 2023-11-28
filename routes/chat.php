<?php
use App\Http\Controllers\Web\MessageController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


Route::get("/chat", function(){
    return view("chat.index");
})->middleware('auth')->name("user.chat");

Route::get('/api/user', function () {
})->middleware('auth');

Route::prefix('/api/user')->group(function(){
    Route::get('/',function(){
        return Auth::user();
    });
    Route::get('/{id}',function(User $id){
        return $id;
    });
})->middleware('auth');

Route::prefix('/chat/conversations')->group(function(){
    Route::get("/",[MessageController::class,'conversations']);
    Route::get('/{id}',[MessageController::class,'getChatMessagesById']);
    Route::post('/{id}',[MessageController::class,'storeChatMessage']);
})->middleware(['auth','throttle:10000']);