<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paiment_enfant extends Model
{
    use HasFactory;
    protected $table='paiment_enfant';

    protected $fillable =[
        'inscription_id',
        'type_paiment_id',
        'mode_paiment_id'

    ];
}
