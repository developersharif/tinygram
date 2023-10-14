<?php
namespace App\Services;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
class PostService{
    protected $postRepository;
    function __construct(PostRepository $postRepository){
        $this->postRepository = $postRepository;
    }

    function newsFeed(){
        $user = auth()->user();
        $posts = $user->followingPosts();
        return $posts;
    }

    function createPost(object $post){
        try {
        $postBody = $post->body;
        $photo = $post->file('photo');
        $photo->store("public/photos");
        $photoName = $photo->hashName();
        $post = $this->postRepository->create([
            "user_id" => $post->user()->id,
            "body" => $postBody,
            "image" => $photoName
        ]);
        return $post;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function singlePost($id){
        try {
            $post = $this->getPost($id);
        if (request('ref') == 'notification') {
            $notification = auth()->user()->Notifications()
            // ->where('type', PostLikedNotification::class)
                ->where('data->postId', $id)->get();
            $notification->markAsRead();
        }
            $comments = $post->comments()->whereNull('parent_comment_id')->with('childComments')->orderBy('id', 'desc')->get();
        return ["post"=>$post,"comments"=>$comments];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function getPost($id){
        try {
            $post = $this->postRepository->findById($id);
            if ($post){
                return $post;
            }else{
                return abort(404);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function updatePost($id, object $data){
        try {
            $post = $this->getPost($id);
        if ($data->hasFile('photo')) {
            $postBody = $data->body;
            $photo = $data->file('photo');
            $photo->store("public/photos");
            $photoName = $photo->hashName();
            $post->body = $postBody;
            $post->image = $photoName;
            $post->update();
            return redirect()->route('home')->with('post', 'post updated successfully');
        } else {
            $postBody = $data->body;
            $post->body = $postBody;
            $post->update();
        }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function deletePost($post){
        try {
        $post->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}