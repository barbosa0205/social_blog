<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function comments_count() {
        return $this->comments()->count();
    }

    public function likes() {
        return $this->morphToMany(Like::class,"likeable");
    }

    public function isLiked() {
        return $this->hasOne(Like::class)->where('user_id', auth()->id());
    }


    public function userAuthLikePost(){
        return  $this->likes()->where('user_id', '=', auth()->id());
    }
    public function images () {
        
        return $this->morphMany(Image::class, 'imageable');
        
    }
    
}

