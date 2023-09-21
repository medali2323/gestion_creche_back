<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inscription extends Model
{
    use HasFactory;
    protected $table='inscription';
    protected $fillable =[
       'date_inscription',
        'anneescolaire_id',
        'enfant_id',
        'type_inscriptions_id'

    ];
    public function classe()
{
    return $this->belongsTo(Classe::class);
}
public function typeInscription()
{
    return $this->belongsTo(type_inscriptions::class, 'type_inscriptions_id'); // Assurez-vous que le nom du modèle est correct
}
public function enfant()
    {
        return $this->belongsTo(enfant::class, 'enfant_id');
    }
    public function ligneFacture()
{
    return $this->hasOne(ligne_facture::class, 'inscription_id');
}

}
 