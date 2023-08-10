<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;
    protected $table='document';
    protected $fillable =[
        'nom_document',
        'pièce_jointe',
        'enfant_id'

    ];
    public function classe()
{
    return $this->belongsTo(Classe::class);
}
}
 