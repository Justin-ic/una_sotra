<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnel extends Model
{
    use HasFactory;

    // Un personnel gère un et un seul guichet et personnel est le père
    public function guichet() {
        return $this->hasOne(guichet::class,'personnel_id'); // Relation One To One père
    }

    // On donne la permission de remplir ces champs
    protected $fillable = ['nom', 'prenom', 'dateNaissance', 'user', 'type', 'pass']; 
}
