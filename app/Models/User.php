<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{

    /**
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'isAllowed' => 'boolean',
        'reputation' => 'integer',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime'
    ];

    public function getFullName(){
        return $this->firstName.' '.$this->lastName;
    }

    public function getComments(){
        return $this->hasMany(Comment::class);
    }

}
