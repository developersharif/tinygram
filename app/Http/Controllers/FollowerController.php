<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(User $user)
{
    if (!auth()->user()->isFollowing($user)) {
        auth()->user()->followings()->attach($user);
        return back();
    }
    auth()->user()->followings()->detach($user);
    return back();
}


    public function following($username)
{
    $user = User::where('username',$username)->where('status', 1)->first();
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }
    $following = $user->followings;

    return view("profile.follow",['user' => $user, 'following' => $following]);
}
public function follower($username)
{
    $user = User::where('username',$username)->where('status', 1)->first();
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }
    $followers = $user->followers;

    return view("profile.follow",['user' => $user, 'followers' => $followers]);
}

}