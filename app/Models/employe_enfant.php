<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employe_enfant extends Model
{
    protected $fillable =[
        'nom_employe',
        'prenom_employe',
        'dateness',
        'num_cin',
        'niveau_scolaire',

    ];
}
