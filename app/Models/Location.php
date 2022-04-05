<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function user(){ // quel est l'employée qui a enregistré une location pour un client donné
        return $this->belongsTo(User::class);
    }

    public function client(){ // de même on aimerait être capable de retourner le client qu'a fait la location
        return $this->belongsTo(Client::class);
    }

    public function statut(){ // quel est le statut de cette location
        return $this->belongsTo(StatutLocation::class, "statut_location_id", "id");
    }

    public function paiements(){ // quel sont les différents paiements qui ont été effectués pour cette loaction
        return $this->hasMany(Paiement::class);
    }

    public function articles(){ // et puis quels sont les articles qui sont louées pour cette location
        return $this->belongsToMany(Article::class, "article_location", "location_id", "article_id");
    }
}
