<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_paiment extends Model
{
    use HasFactory;
    protected $table='type_paiment';

    protected $fillable =[
        
        'type'

    ];
}
