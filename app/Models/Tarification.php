<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarification extends Model
{
    use HasFactory;

    public function dureeLocation() {
        return $this->belongsTo(DureeLocation::class, "duree_location_id", "id");
    }

    public function article() { // quel est l'article lié à une tarification donnée ou bien l'ensmeble des articles liés à une tarification donnée
        return $this->belongsTo(Article::class);
    }
}
