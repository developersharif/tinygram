<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::creator("components.post.layout",function($view){
            $users = User::all();
            $posts = Post::with('user')->where('status',1)->orderBy('id','desc')->get();
            $view->with("posts",$posts);
            $view->with("users",$users);
        });
    }
}