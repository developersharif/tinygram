<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\LikeService;

class LikeController extends Controller
{
    protected $likedService;
    function __construct(LikeService $likedService){
        $this->likedService = $likedService;
    }
    function like($post_id){
        return $this->likedService->likeToPost($post_id);
    }

    function unlike($post_id){
        return $this->likedService->unlikeToPost($post_id);
    }
}