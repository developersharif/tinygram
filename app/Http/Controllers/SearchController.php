<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $searchKey = $request->q;
        $users = User::where('name','like',"%$searchKey%")->orWhere('email','like',"%$searchKey%")->get();
        return response()->json($users);
    }
}