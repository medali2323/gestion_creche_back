<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activite_enfant extends Model
{
    use HasFactory;
    protected $table='inscription';
    protected $fillable =[
       
        'activite_id',
        'enfant_id'

    ];}
