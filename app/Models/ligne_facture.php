<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ligne_facture extends Model
{
    use HasFactory;
    protected $table='ligne_facture';
    protected $fillable =[
        'code',
        'inscription_id',
        'facture_id',
        'mois_facturation'

    ];
}
