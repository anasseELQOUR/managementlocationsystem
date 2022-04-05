<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users(){ // pour les roles on peut connaître tous les utilisateurs qui ont un rôle données en faut un rôle a +ieurs utilisateurs par exemple on peut avoir dix utilisateurs qui'on le rôle adminstrateur
        return $this->belongsToMany(User::class, "user_role", "role_id", "user_id");
    }
}
