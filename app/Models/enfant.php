<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enfant extends Model
{
    use HasFactory;
    protected $table='enfant';
    protected $fillable =[
        'nom',
        'prenom',
        'dateness',
        'etamedical',
        'adresse',
        'famille_id'

    ];
    public function classe()
{
    return $this->belongsTo(Classe::class);
}
}
 