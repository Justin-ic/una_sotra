<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
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
        return $this->belongsTo(services::class);
    }


    // un client a un et un seul bilan par jour. Mais s'il revient une autre fois, on va stocker un autre bilanlient pour lui.
    public function bilanClients() {
        return $this->hasMany(bilanClients::class); // Relation One to Many: client est le père
    }


    // un client a plus tickrts; il peut en prendre aujourd'hui et revenir demeain
    public function tickets() {
        return $this->hasMany(ticket::class); // Relation One to Many: client est le père
    }
    // nom     prenom  genre   numero  nce     ticket_id   servit  created_at  updated_at          

    protected $fillable = ['nom', 'prenom', 'genre', 'numero', 'nce','debutService', 'finService', 'commentaire', 'servit']; // On donne la permission de remplir ces champs

    // nom     prenom  genre   numero  nce     debutService     finService    commentaire     servit
}



