<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'id',
        'title',
        'createdAt'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    
}
