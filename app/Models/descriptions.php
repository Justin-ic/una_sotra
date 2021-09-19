<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class descriptions extends Model
{
    use HasFactory;

    public function service() {
        return $this->belongsTo(services::class);
    }

    protected $fillable = ['detail', 'service_id']; // On donne la permission de remplir ces champs

}

