<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guichets extends Model
{
    use HasFactory;

    // Un guichet a un et un seul service. Ex: svice transaction -> description=[depot, retrait...]
    public function service() {
        return $this->belongsTo(services::class);
    }

    // Un guichet est géer par un et un sl rsonnel
    public function personnel() {
        return $this->belongsTo(personnels::class);
    }

    protected $fillable = ['lettre_guichet', 'service_id', 'personnel_id']; // On donne la permission de remplir ces champs

}
