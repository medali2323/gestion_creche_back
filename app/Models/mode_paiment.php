<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mode_paiment extends Model
{
    use HasFactory;
    protected $table='mode_paiment';

    protected $fillable =[
       
        'mode'

    ];
}
