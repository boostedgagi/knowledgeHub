<?php

namespace App\Models;

enum Roles:string
{
    case Administrator='Administrator';
    case Moderator='Moderator';
    case User='User';
}