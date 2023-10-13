<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    function show($username){
        $user = User::where('username',$username)->where('status',1)->first();
        if($user){
            return view('profile.public',['user'=>$user]);
        }
        abort(404);
    }
}
