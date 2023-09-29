<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggested_user = User::all();
        $posts = Post::with('user')
        ->with("likedBy")
        ->where('status', 1)
        ->whereHas('user', function ($query) {
            $query->where('status', 1);
        })
        ->orderBy('id', 'desc')
        ->get();
        return view('home',['posts' => $posts,'suggested_users' => $suggested_user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
            $postBody = $request->body;
            $photo = $request->file('photo');
            $photo->store("public/photos");
            $photoName = $photo->hashName();

            $post = new Post();
            $post->user_id = Auth::user()->id;
            $post->body = $postBody;
            $post->image = $photoName;
            $post->save();
            return redirect()->route('home')->with('post','post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $this->authorize('update',$post);
        return view('post.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        $post = Post::find($id);
        if($request->hasFile('photo')){
            $postBody = $request->body;
            $photo = $request->file('photo');
            $photo->store("public/photos");
            $photoName = $photo->hashName();
            $post->body = $postBody;
            $post->image = $photoName;
            $post->update();
            return redirect()->route('home')->with('post','post updated successfully');
        }else{
            $postBody = $request->body;
            $post->body = $postBody;
            $post->update();
            return redirect()->route('home')->with('post','post updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->back();
    }
}