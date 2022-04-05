<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProprieteArticle extends Model
{
    use HasFactory;

    public function type() {
        return $this->belongsTo(TypeArticle::class, "type_article_id", "id"); //type_article_id est la clef étrangère au niveau de la table Proprite_Articles et id est l'identifiant de la table type_articles
    }
}
