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


    // un bilanClient concerne un et un seul service  car il y a son id dessus. (Qui est utilisé ici)
    // Pour mieux voir, le même service peut se retouver dans plusieurs bilanClient (Pour expliquer)
    public function service() {
        return $this->belongsTo(service::class,'services_id'); // Relation One to Many: bilanClients est le fils
    }
    
    // On donne la permission de remplir ces champs 
    protected $fillable = ['demande', 'ticket', 'tAttenteEstime', 'nbClientAvant', 'debutService', 'finService','commentaire','etat','etudiants_id','services_id'];
}
