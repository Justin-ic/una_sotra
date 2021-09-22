<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnels extends Model
{
    use HasFactory;

    // Un personnel gère un et un seul guichet
    public function guichets() {
        return $this->hasMany(guichets::class);
    }

    // On donne la permission de remplir ces champs
    protected $fillable = ['nom', 'prenom', 'dateNaissance', 'user', 'type', 'pass']; 
}

    // <!-- 'nom', 'pernom', 'dateNaissance', 'user', 'pass', 'type',-->
