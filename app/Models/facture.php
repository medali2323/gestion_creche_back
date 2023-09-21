<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    use HasFactory;
    protected $table='facture';
    protected $fillable =[
        'code',
        'montant_total',
        'date_facturation',
        'tva_id'

    ];
    public function lignesFacture()
{
    return $this->hasMany(ligne_facture::class);
}
}
