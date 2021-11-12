<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guichet extends Model
{
    use HasFactory;

    // Un guichet a un et un seul service. Ex: svice transaction -> description=[depot, retrait...]
    public function service() {
        return $this->belongsTo(service::class); // Relation One To One fils
    }


    // Un guichet est géer par un et un seul prsonnel
    public function personnel() {
        return $this->belongsTo(personnel::class); // Relation One To One fils
    }

    protected $fillable = ['lettre_guichet', 'service_id', 'personnel_id']; // On donne la permission de remplir ces champs
}
