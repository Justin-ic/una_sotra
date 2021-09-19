<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bilanClients extends Model
{
    use HasFactory;

    // un bilanClient concerne un et un seul client
    public function client() {
        return $this->belongsTo(clients::class);
    }
    
    // On donne la permission de remplir ces champs 
    protected $fillable = ['clients_id', 'etat', 'commentaire', 'tempsArrive', 'debutService', 'finService']; 
      

}
