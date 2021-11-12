<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bilanClients extends Model
{
    use HasFactory;

    // un bilanClient concerne un et un seul client car il y a son id dessus
    public function client() {
        return $this->belongsTo(clients::class); // Relation One to Many: bilanClients est le fils
    }
    
    // On donne la permission de remplir ces champs 
    protected $fillable = ['clients_id', 'etat', 'commentaire', 'tempsArrive', 'debutService', 'finService']; 
      

}
