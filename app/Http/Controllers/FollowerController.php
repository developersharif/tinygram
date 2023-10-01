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
    $user = User::getByUsername($username);
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }
    $following = $user->followings;

    return response()->json(['following' => $following]);
}
public function follower($username)
{
    $user = User::getByUsername($username);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $followers = $user->followers;

    return response()->json(['followers' => $followers]);
}

}