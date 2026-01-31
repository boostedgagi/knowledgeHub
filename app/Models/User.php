<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'isAllowed',
        'reputation',
        'roles'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'isAllowed' => 'boolean',
        'reputation' => 'integer',
        'roles' => 'array',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime'
    ];

}
