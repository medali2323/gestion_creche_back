<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pointage_enfant extends Model
{
    use HasFactory;
    protected $table='pointage_enfant';

    protected $fillable =[
        'nom_activite',
        'datepointage',
        'heurepointage',
        'enfant_id',
        'employe_enfant_id',
        'enfant_id'

    ];
}
