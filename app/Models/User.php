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
    /**
     * Define one to one relationship  between user and post model
     * Retrieve all posts associated with a user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    /**
     * Retrive a user by their usaername
     * @param string $username
     */
    public static function getByUsername($username)
    {
        return static::where('username', $username)->first();
    }
    /**
     * Define a many-to-many relationship between the User and Post models for liked posts.
     * Retrieve all posts that the user has liked.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_likes')->withTimestamps();
    }
    /**
     * Define one to one relationship  between user and comment model
     * Retrieve all comments associated with a user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id')->withTimestamps();
    }
    /**
     * Follow another user.
     * This method allows the current user to follow another user.
     * @param \App\Models\User $userToFollow The user to follow.
     * @return void
     */
    public function follow(User $userToFollow)
    {
        $this->followings()->attach($userToFollow);
    }
    /**
     * unFollow another user.
     * This method allows the current user to unfollow another user.
     * @param \App\Models\User $userToUnfollow The user to follow.
     * @return void
     */
    public function unfollow(User $userToUnfollow)
    {
        $this->followings()->detach($userToUnfollow);
    }
    /**
     * Define a many-to-many relationship between the User model and other users who follow this user.
     *
     * This method allows you to retrieve a collection of users who follow the current user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
            ->withTimestamps();
    }
    /**
     * Define a many-to-many relationship between the User model and users whom this user follows.
     *
     * This method allows you to retrieve a collection of users whom the current user follows.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
            ->withTimestamps();
    }
    /**
     * Check if the current user is following another user.
     * @param \App\Models\User $user The user to check for following.
     * @return bool True if the current user is following the specified user, false otherwise.
     */
    public function isFollowing(User $user):bool
    {
        return $this->followings->contains($user);
    }
    /**
     * Retrieve posts from users that the current user is following.
     * Retrive a paginated list of posts created by users that the current user is following.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
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
        ->orderBy('id', 'desc')->simplePaginate(5);

        return $posts;
    }

}