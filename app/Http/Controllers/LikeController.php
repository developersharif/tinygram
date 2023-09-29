<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    function like($post_id){
        $post = Post::find($post_id);
        $user = Auth::user();
        if($post && $user){
            if (!$user->likedPosts->contains($post->id)) {
                $user->likedPosts()->attach($post->id);
                return back();
            } else {
                return back();
            }
        }else{
            return back();
        }
    }

    function unlike($post_id){
        $post = Post::find($post_id);
        $user = Auth::user();
        if($post && $user){
            if ($user->likedPosts->contains($post->id)) {
                $user->likedPosts()->detach($post->id);
                return back();
            } else {
                return back();
            }
        }else{
            return back();
        }
    }
}