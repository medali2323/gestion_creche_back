<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repas_enfant extends Model
{
    use HasFactory;
    protected $table='repas_enfant';

    protected $fillable =[
        'inscription_id',
        'repas_id',

    ];
}
