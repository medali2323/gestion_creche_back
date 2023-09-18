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
    public function inscriptions()
    {
        return $this->hasMany(inscription::class);
    }
    public function famille()
{
    return $this->belongsTo(famille::class, 'famille_id');
}
}
 