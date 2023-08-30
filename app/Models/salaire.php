<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class salaire extends Model
{
    use HasFactory;
    protected $table='salaire';

    protected $fillable = ['employe_id', 'salaire_brut', 'date_paiement'];

    
}
