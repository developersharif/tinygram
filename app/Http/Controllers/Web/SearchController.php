<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $searchService;
    function __construct(SearchService $searchService){
        $this->searchService = $searchService;
    }
    public function search(Request $request){
        $this->validate($request,[
            'q'=>'string|max:255'
        ]);
        return $this->searchService->getSearch($request);
    }
}