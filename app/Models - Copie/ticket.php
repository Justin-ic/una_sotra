<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;



    // un ticket est pour un et un seul client  et un client a plus tickrts; il peut en prendre aujourd'hui et revenir demeain
    public function client() {
        return $this->belongsTo(clients::class); // Relation One to Many: ticket est le fils
    }



    // description     ticket  tAttenteEstime  nbClientAvant   created_at  updated_at  
    protected $fillable = ['description','ticket','tAttenteEstime','nbClientAvant', 'clients_id']; // On donne la permission de remplir ces champs
}
