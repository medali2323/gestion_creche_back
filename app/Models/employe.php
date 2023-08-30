<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employe extends Model
{   
    protected $table='employe';

    protected $fillable =[
        'nom_employe',
        'prenom_employe',
        'dateness',
        'num_cin',
        'numero_tel',
        'adresse',
        'email',
        'niveau_scolaire',
        'date_emboche',
        'role',
        'etat_actuel'
    ];
}
