<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inscription extends Model
{
    use HasFactory;
    protected $table='inscription';
    protected $fillable =[
       
        'anneescolaire_id',
        'enfant_id'

    ];
    public function classe()
{
    return $this->belongsTo(Classe::class);
}
}
 