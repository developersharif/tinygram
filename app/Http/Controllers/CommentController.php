<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCommenteddNotification;
use App\Notifications\PostRepliedNotification;
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
     * Show the form for creating a new resource. (Demo only)
     */
    public function create()
    {
        // $post = Post::find(5);
        // $comments = $post->comments()->whereNull('parent_comment_id')->with('childComments')->orderBy('id','desc')->get();
        // return view('comment.create',['comments' => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $post = Post::find($request->post_id);
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);
        if($post->user_id != Auth::user()->id){
            $post->user->notify(new PostCommenteddNotification($post->id));
        }
        return back();
    }


    public function reply(UpdateCommentRequest $request)
    {
        $comment = Comment::find($request->parent_comment_id);
        $user = User::find($comment->user_id);
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'parent_comment_id' => $request->parent_comment_id,
            'content' => $request->content,
        ]);
        if($comment->user_id != Auth::user()->id){
        $user->notify(new PostRepliedNotification($comment->post_id));
        }
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
        $post =Post::find($comment->post_id);
        $this->authorize("delete",$comment);
        $comment->delete();
        $post->user->Notifications()->where('type', PostCommenteddNotification::class)
        ->orWhere('type',PostRepliedNotification::class)
                ->where('data->postId', $post->id)->delete();
        return back();
    }
}