<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    // protected $table = "articles"; on ajoute ceci losrqu'on créer un model vc un nom dufferent de celui de la table à laquelle fait référence

    public function type(){ // pour un article donnée appartient à un seul type
        return $this->belongsTo(TypeArticle::class, "type_article_id", "id");
    }

    public function tarifications(){ // un article peut avoir +ieurs tarifications selon qu'il soit loué pr une heure, deux heures, demi-journée, une journée ...
        return $this->hasMany(Tarification::class);
    }

    public function locations(){  // un article peut avoir +ieurs intervales de temps de location mais un article peut être loué +ieurs fois si par exemple on veut retourner et retracer l'ensemble des locations pendant une période donnée pour un article donnée et bien cette relation qui va nous fournir ce type d'information
        return $this->belongsToMany(Location::class, "article_location", "article_id", "location_id");
    }

    public function proprietes(){ // un article a également +ieurs proprietés si le type d'article est une voiture il fallait bien que lorsqu'on veut créer l'article, qu'on précise le kilométrage la couleur le moteur ... etc.
        return $this->belongsToMany(ProprieteArticle::class, "article_propriete", "article_id", "propriete_article_id");
    }

}
