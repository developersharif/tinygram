<?php
namespace App\Services;
use App\Notifications\PostCommenteddNotification;
use App\Notifications\PostRepliedNotification;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
class CommentService{
    protected $postRepository;
    protected $commentRepository;
    protected $userRepository;
    function __construct(CommentRepository $commentRepository,PostRepository $postRepository,UserRepository $userRepository){
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;

    }

    function createComment(object $comment){
        //Find the post associated with the $request->post_id
        $post = $this->postRepository->findById($comment->post_id);
        // Create a new comment
        $this->commentRepository->create([
            'user_id' => Auth::user()->id,
            'post_id' => $comment->post_id,
            'content' => $comment->content,
        ]);
        // Check if the user replying to the comment is not the same as the user who made the parent comment
        if($post->user_id != Auth::user()->id){
            $post->user->notify(new PostCommenteddNotification($post->id));
        }
    }

    function replyComment(object $reply){
         // Find the parent comment based on the provided parent_comment_id
         $comment = $this->commentRepository->findById($reply->parent_comment_id);
         // Find the user who created the parent comment
         $user = $this->userRepository->findById($comment->user_id);
         // Create a new comment with the provided data
         $this->commentRepository->create([
            'user_id' => Auth::user()->id,
            'post_id' => $reply->post_id,
            'parent_comment_id' => $reply->parent_comment_id,
            'content' => $reply->content,
        ]);
         // Check if the user replying to the comment is not the same as the user who made the parent comment
         if($comment->user_id != Auth::user()->id){
         // Notify the user who made the parent comment about the reply
         $user->notify(new PostRepliedNotification($comment->post_id));
         }
    }

    function destroyComment(object $comment){
        // Find the associated post of the comment
        $post =$this->postRepository->findById($comment->post_id);
        // Delete the comment
        $this->commentRepository->destroy($comment);
        // Delete notifications related to the post
        $post->user->Notifications()->where('type', PostCommenteddNotification::class)
        ->orWhere('type',PostRepliedNotification::class)
                ->where('data->postId', $post->id)->delete();
    }
}