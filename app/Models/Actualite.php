<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;
    protected $table='Actualite';
    protected $fillable =[
        'objet',
        'pièce_jointe',
        'contenu',
        'date'

    ];}
