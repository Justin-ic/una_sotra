<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bilanEtudiant extends Model
{
    use HasFactory;

    // un bilanClient concerne un et un seul etudiant car il y a son id dessus
    public function etudiant() {
        return $this->belongsTo(etudiant::class,'etudiants_id'); // Relation One to Many: bilanClients est le fils
    }
    
    // On donne la permission de remplir ces champs 
    protected $fillable = ['demande', 'ticket', 'tAttenteEstime', 'nbClientAvant', 'debutService', 'finService','commentaire','etat','etudiants_id','services_id'];
}
