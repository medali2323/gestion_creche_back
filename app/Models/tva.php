<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tva extends Model
{
    use HasFactory;
    protected $table='tva';

    protected $fillable =[
       'code',
        'taux_tva'

    ];
}
