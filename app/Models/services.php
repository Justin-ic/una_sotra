<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;

    // Le même service peut être demander par plusieurs clients
    public function clients() {
        return $this->hasMany(clients::class);
    }

    // Un service peut avoir plusieurs descriptions. anisi, dans la table description, l'ID de la table services doit être services_id; service avec s, le _ forcement. cela permet d'automatiser les choses. Normalement, le nom des tables ne doivent pas avoir des s
    public function descriptions() {
        return $this->hasMany(descriptions::class);
    }
    // Un service est attribuer à un et un seul guichet
    public function guichets() {
        return $this->hasMany(guichets::class);
    }

/*    public function guichet() {
        return $this->belongsTo(guichets::class);
    }*/

    protected $fillable = ['nom']; // On donne la permission de remplir ces champs
}
