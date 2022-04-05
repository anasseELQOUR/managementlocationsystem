<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function locations(){ //cette relation permet de retourner toutes les locations qu'un client a efféctuée pendant une période donnée
        return $this->hasMany(Location::class);
    }
}
