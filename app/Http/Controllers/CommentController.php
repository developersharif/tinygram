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
     * create comment to post
     * @param StoreCommentRequest $request (post_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        //Find the post associated with the $request->post_id
        $post = Post::find($request->post_id);
        // Create a new comment
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);
        // Check if the user replying to the comment is not the same as the user who made the parent comment
        if($post->user_id != Auth::user()->id){
            $post->user->notify(new PostCommenteddNotification($post->id));
        }
        return back();
    }

   /**
     * Reply to a comment.
     *
     * @param UpdateCommentRequest $request (parent_comment_id)
     * @return \Illuminate\Http\RedirectResponse
    */
    public function reply(UpdateCommentRequest $request)
    {
        // Find the parent comment based on the provided parent_comment_id
        $comment = Comment::find($request->parent_comment_id);
        // Find the user who created the parent comment
        $user = User::find($comment->user_id);
        // Create a new comment with the provided data
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'parent_comment_id' => $request->parent_comment_id,
            'content' => $request->content,
        ]);
        // Check if the user replying to the comment is not the same as the user who made the parent comment
        if($comment->user_id != Auth::user()->id){
        // Notify the user who made the parent comment about the reply
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
     * Delete a comment and associated notifications.
     *
     * @param Comment $comment (post_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        // Find the associated post of the comment
        $post =Post::find($comment->post_id);
        // Authorize the deletion of the comment
        $this->authorize("delete",$comment);
        // Delete the comment
        $comment->delete();
        // Delete notifications related to the post
        $post->user->Notifications()->where('type', PostCommenteddNotification::class)
        ->orWhere('type',PostRepliedNotification::class)
                ->where('data->postId', $post->id)->delete();
        // Redirect back to the previous page
        return back();
    }
}