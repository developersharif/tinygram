<?php

use App\Http\Controllers\Web\CommentController;
use App\Http\Controllers\Web\FollowerController;
use App\Http\Controllers\Web\LikeController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\PublicProfileController;
use App\Http\Controllers\Web\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [PostController::class, 'index'])->middleware('auth')->name('home');

Route::resource('/post', PostController::class)->names([
    'create' => 'post.create',
    'store' => 'post.store',
    'index' => 'post.index',
    'show' => 'post.show',
    'edit' => 'post.edit',
    'update' => 'post.update',
    'destroy' => 'post.destroy',
])->middleware('auth');
Route::get("/posts", [PostController::class, 'indexApi'])->middleware('auth')->name("posts.api");
Route::middleware('auth')->group(function () {
    Route::resource("/comment", CommentController::class)->names([
        'create' => 'comment.create',
        'store' => 'comment.store',
        'index' => 'comment.index',
        'show' => 'comment.show',
        'edit' => 'comment.edit',
        'update' => 'comment.update',
        'destroy' => 'comment.destroy',
    ]);
    Route::post("/comment/reply/{comment_id}", [CommentController::class, 'reply'])->name("comment.reply");
});
Route::get("/search", [SearchController::class, 'search'])->name("search");
Route::prefix('like')->group(function () {
    Route::get('/{post_id}', [LikeController::class, 'like'])->name('post.like');
    Route::post('/{post_id}', [LikeController::class, 'unlike'])->name('post.unlike');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get("/@{username}", [PublicProfileController::class, 'show'])->name('user.profile');
    Route::get('/@{username}/following', [FollowerController::class, 'following'])->name('user.following');
    Route::get('/@{username}/follower', [FollowerController::class, 'follower'])->name('user.follower');
    Route::post('/user/{user}/follow', [FollowerController::class, 'follow'])->name('user.follow');
});

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('user.notifications');
    Route::get('/notifications/delete/{notification_id}', [NotificationController::class, 'deleteNotification'])->name('notification.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Require __DIR__ . '/chat.php';