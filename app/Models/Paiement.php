<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    public function user() { // l'employée qui a enregistré le paiement
        return $this->belongsTo(User::class);
    }

    public function location(){ // le paiement a été effectué pour quelle location
        return $this->belongsTo(Location::class);
    }
}
