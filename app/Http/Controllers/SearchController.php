<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $this->validate($request,[
            'q'=>'string|max:255'
        ]);
        $searchKey = $request->q;
        $users = User::where('name','like',"%$searchKey%")->orWhere('email','like',"%$searchKey%")->limit(45)->get();
        return view('search.users',compact('users'));
    }
}
