<?php
namespace APp\Services;
use App\Notifications\PostLikedNotification;
use App\Repositories\PostRepository;
class LikeService{
    protected $postRepository;
    function __construct(PostRepository $postRepository){
        $this->postRepository = $postRepository;
    }

    function likeToPost($postId){
        $post = $this->postRepository->findById($postId);
        $user = auth()->user();
        if($post && $user){
            if (!$user->likedPosts->contains($post->id)) {
                $user->likedPosts()->attach($post->id);
                $post->user->notify(new PostLikedNotification($post->id));
                return back();
            } else {
                return back();
            }
        }else{
            return back();
        }
    }

    function unLikeToPost($postId){
        $post = $this->postRepository->findById($postId);
        $user = auth()->user();
        if($post && $user){
            if ($user->likedPosts->contains($post->id)) {
                $user->likedPosts()->detach($post->id);
                $post->user->Notifications()->where('type', PostLikedNotification::class)
                ->where('data->postId', $post->id)->delete();
                return back();
            } else {
                return back();
            }
        }else{
            return back();
        }
    }

}