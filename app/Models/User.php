<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public static function getByUsername($username)
    {
        return static::where('username', $username)->first();
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_likes')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id')->withTimestamps();
    }

    public function follow(User $userToFollow)
    {
        $this->followings()->attach($userToFollow);
    }

    public function unfollow(User $userToUnfollow)
    {
        $this->followings()->detach($userToUnfollow);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
            ->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
            ->withTimestamps();
    }
    public function isFollowing(User $user)
    {
        return $this->followings->contains($user);
    }
    public function followingPosts()
    {

        $following_ids = $this->followings()->pluck('users.id');

        $posts = Post::whereIn('user_id', $following_ids)
        ->with("user")
        ->withCount("comments")
        ->withCount("likedBy")
        ->with([
            'likedBy' => function ($query) {
                $query->select("name","avatar","username")
                ->limit(4);
            }
        ])
        ->orderBy('id', 'desc')->simplePaginate(2);

        return $posts;
    }

}