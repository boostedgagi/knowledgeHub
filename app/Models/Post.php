<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'postContent',
        'title',
        'upVotes',
        'downVotes',
        'categoryId',
        'userId',
        'createdAt',
        'updatedAt',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class,'postId');
    }
}
