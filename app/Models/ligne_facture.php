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
    public function facture()
{
    return $this->belongsTo(facture::class, 'facture_id');
}
public function inscription()
{
    return $this->belongsTo(inscription::class,'inscription_id');
}


}
