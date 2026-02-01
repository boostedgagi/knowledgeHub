<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $fillable = [
        'id',
        'postId',
        'tagId'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
