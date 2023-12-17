<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repas_enfant extends Model
{
    use HasFactory;
    protected $table='repas_enfants';

    protected $fillable =[
        'inscription_id',
        'repas_id',

    ];
    public function inscription()
{
    return $this->belongsTo(inscription::class);
}
public function repas()
{
    return $this->belongsTo(Repas::class);
}
}
