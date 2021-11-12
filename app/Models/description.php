<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class description extends Model
{
    use HasFactory;

    // protected $table = "descriptions"; // Retourne tous le contenu de la table spécifier seulement
    public function service() {
        return $this->belongsTo(service::class,'services_id'); // Relation On to many description est le fils. 
        // Il a donc un seul père.
    }

    protected $fillable = ['detail', 'services_id']; // On donne la permission de remplir ces champs
}
