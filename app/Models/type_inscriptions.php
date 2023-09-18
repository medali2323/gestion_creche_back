<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_inscriptions extends Model
{
    use HasFactory;
    protected $table='type_inscriptions';
    protected $fillable =[
       'code',
        'libelle',
        'prix_inscription'

    ];
}
