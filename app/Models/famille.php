<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enfant extends Model
{
    use HasFactory;
    protected $table='famille';
    protected $fillable =[
        'nom_parent',
        'prenom_parent',
        'numero_telephone',
        'numero_cin',

    ];
    public function classe()
{
    return $this->belongsTo(Classe::class);
}
}
 