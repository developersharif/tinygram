<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    function index(){
        $notifications = Auth::user()->notifications;
        return view("notification.index",['notifications' => $notifications]);
    }
}