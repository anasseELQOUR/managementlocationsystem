<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeArticle extends Model
{
    use HasFactory;

    protected $table = "type_articles";

    public function articles(){ // on aimerait savoir l'ensemble des articales par rapport à une catégorie bein donné
        return $this->hasMany(Article::class);
    }
}
