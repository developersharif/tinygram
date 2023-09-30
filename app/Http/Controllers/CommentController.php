<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = Post::find(5);
        $comments = $post->comments()->whereNull('parent_comment_id')->with('childComments')->orderBy('id','desc')->get();
        return view('comment.create',['comments' => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);

        return back();
    }


    public function reply(UpdateCommentRequest $request)
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'parent_comment_id' => $request->parent_comment_id,
            'content' => $request->content,
        ]);

        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
