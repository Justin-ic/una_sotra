<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientsLocation extends Model
{
    use HasFactory;

    protected $fillable= ['clientId', 'clientNumero', 'clientTicket','nbClientAvant','tAttenteEstime','nom','prenom','genre','clientLatitude', 'clientLongitude','distance'];
}
