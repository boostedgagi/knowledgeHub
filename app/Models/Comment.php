<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id',
        'content',
        'parentCommentId',
        'userId',
        'postId'
    ];

    protected $casts = [
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime'
    ];

    public function getUser(){
        return $this->belongsTo(User::class);
    }
    public function getPost(){
        return $this->belongsTo(Post::class);
    }
    public function parentComment(){
        return $this->belongsTo(Comment::class);
    }
}
