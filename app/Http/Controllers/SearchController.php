<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $this->validate($request,[
            'q'=>'string|max:255'
        ]);
        $searchKey = $request->q;
        if (!empty($searchKey)) {
            $users = User::where('name','like',"%$searchKey%")->orWhere('email','like',"%$searchKey%")->limit(45)->get();
        $postsQuery = Post::with('user')
        ->with("likedBy")
        ->where('status', 1)
        ->where(function ($query) use ($searchKey) {
            $query->orWhere('body', 'like', "%$searchKey%");
        })
        ->whereHas('user', function ($query) {
            $query->where('status', 1);
        });

    $totalFound = $postsQuery->count();
    $posts = $postsQuery->orderBy('id', 'desc')->get();
        return view('search.results',compact('users','posts','totalFound'));
        }else{
            return view('search.search');
        }

    }
}