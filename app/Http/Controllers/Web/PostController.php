<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    public function indexApi(Request $request)
    {
        $user = auth()->user();
        $posts = $user->followingPosts();
        return response()->json($posts);
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        // $posts = Post::with('user')
        // ->with("likedBy")
        // ->where('status', 1)
        // ->whereHas('user', function ($query) {
        //     $query->where('status', 1);
        // })
        // ->orderBy('id', 'desc')
        // ->get();
        $posts = $user->followingPosts();
        return view('home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
        $postBody = $request->body;
        $photo = $request->file('photo');
        $photo->store("public/photos");
        $photoName = $photo->hashName();

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->body = $postBody;
        $post->image = $photoName;
        $post->save();
        return redirect()->route('home')->with('post', 'post created successfully');
        } catch (PostTooLargeException $e) {
            throw new PostTooLargeException("Error: {$e->getMessage()}", $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $post = Post::find($id);
        if (request('ref') == 'notification') {
            $notification = auth()->user()->Notifications()
            // ->where('type', PostLikedNotification::class)
                ->where('data->postId', $id)->get();
            $notification->markAsRead();
        }
        $comments = $post->comments()->whereNull('parent_comment_id')->with('childComments')->orderBy('id', 'desc')->get();
        return view('post.view', ['post' => $post, "comments" => $comments]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        try {
            $post = Post::find($id);
        if ($request->hasFile('photo')) {
            $postBody = $request->body;
            $photo = $request->file('photo');
            $photo->store("public/photos");
            $photoName = $photo->hashName();
            $post->body = $postBody;
            $post->image = $photoName;
            $post->update();
            return redirect()->route('home')->with('post', 'post updated successfully');
        } else {
            $postBody = $request->body;
            $post->body = $postBody;
            $post->update();
            return redirect()->route('home')->with('post', 'post updated successfully');
        }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::find($id);
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}