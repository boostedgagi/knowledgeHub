<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false;

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

    public function user(){
        return $this->belongsTo(User::class,'userId',);
    }

    public function post(){
        return $this->belongsTo(Post::class,'postId',);
    }

    public function parentComment(){
        return $this->belongsTo(Comment::class);
    }
}
