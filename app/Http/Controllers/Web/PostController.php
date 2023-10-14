<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    protected $postService;
    function __construct(PostService $postService){
        $this->postService = $postService;
    }
    public function indexApi(Request $request)
    {
        return response()->json($this->postService->newsFeed());
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->newsFeed();
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
        $this->postService->createPost($request);
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
           $data = $this->postService->singlePost($id);
        return view('post.view', ["post" => $data["post"], "comments" => $data["comments"]]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = $this->postService->getPost($id);
        $this->authorize('update', $post);
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        try {
            $this->postService->updatePost($id, $request);
            return redirect()->route('home')->with('post', 'post updated successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $post = $this->postService->getPost($id);
            $this->authorize('delete', $post);
            $this->postService->deletePost($post);
        return redirect()->route("user.profile",$post->user->username);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}