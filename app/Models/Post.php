<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['body','image','status','comment_status'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likedByUser($userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $this->likedBy()->where('user_id', $userId)->exists();
    }
    public function likedBy(){
        return $this->belongsToMany(User::class,'post_likes')->withTimestamps();
    }
}