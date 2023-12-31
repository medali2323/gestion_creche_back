<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\famille;
use App\Models\facture;
class famille extends Model
{
    use HasFactory;
    protected $table='famille';
    protected $fillable =[
        'nom_pere',
        'prenom_pere',
        'numero_telephone_pere',
        'numero_cin_pere',
        'email_pere',
        'adresse_pere',
        'nom_mere',
        'prenom_mere',
        'numero_telephone_mere',
        'numero_cin_mere',
        'email_mere',
        'adresse_mere'

    ];
    public function enfants()
    {
        return $this->hasMany(enfant::class);
    }

   
}