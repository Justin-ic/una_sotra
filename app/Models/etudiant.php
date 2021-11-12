<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    use HasFactory;


     /**
     * cette méthode est automatiquement appellée lorsqu'on utilise une relation (Ex: le méthode with())
     * pour ce faire, le format est obligatoire.
     * ICI, services est dans clients. on sait qu'un client va demander un seul service
     * pour cela, on écrit le nom de la méthode qui est le nom de la table sans s ( service() ) et on 
     * utilise belongsTo()
     * Dans la base de donnée, la clé étrangère doit être: service_id
     *
     * @param  
     * @return \Illuminate\Http\Response
     */

     // un client demande un et un seul service
    public function service() {
        return $this->belongsTo(service::class);
    }


    // un client a un et un seul bilan par jour. Mais s'il revient une autre fois, on va stocker un autre bilanlient pour lui.
    public function bilanEtudiants() {
        return $this->hasMany(bilanEtudiant::class,'etudiants_id'); // Relation One to Many: client est le père
    }         

    protected $fillable = ['nom', 'prenom', 'genre', 'numero', 'nce','dateNaissance']; // On donne la permission de remplir ces champs

}

