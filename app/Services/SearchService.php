<?php
namespace App\Services;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;

class SearchService{
    protected $userRepository;
    protected $postRepository;
    function __construct(UserRepository $userRepository,PostRepository $postRepository){
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }

    function getSearch(object $search){

        $searchKey = $search->q;
        if (!empty($searchKey)) {
            $users = $this->userRepository->searchUser($searchKey);
            $postsQuery = $this->postRepository->searchPost($searchKey);

        $totalFound = $postsQuery->count();
        $posts = $postsQuery->orderBy('id', 'desc')->get();
        return view('search.results',compact('users','posts','totalFound'));
        }else{
            return view('search.search');
        }
    }
}