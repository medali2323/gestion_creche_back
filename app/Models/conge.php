<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conge extends Model
{
    use HasFactory;
    protected $table='conge';
    protected $fillable =[
        'code',
        'date_deb',
        'date_fin',
        'employe_id'

    ];

}
