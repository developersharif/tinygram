<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification as notification;
class NotificationController extends Controller
{
    function index(){
        $notifications = Auth::user()->notifications;
        return view("notification.index",['notifications' => $notifications]);
    }

    function deleteNotification(Request $request){
        $notification = notification::find($request->notification_id);
        if($notification->notifiable_id === auth()->user()->id){
            $notification->delete();
            return back();
        }
    }
}