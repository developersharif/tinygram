<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;
    //inject comment service
    function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }
    /**
     * create comment to post
     * @param StoreCommentRequest $request (post_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $this->commentService->createComment($request);
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
        $this->commentService->replyComment($request);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //...//
    }

    /**
     * Delete a comment and associated notifications.
     *
     * @param Comment $comment (post_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        // Authorize the deletion of the comment
        $this->authorize("delete",$comment);
        // Delete the comment
        $this->commentService->destroyComment($comment);
        // Redirect back to the previous page
        return back();
    }
}