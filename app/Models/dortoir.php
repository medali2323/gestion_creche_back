<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dortoir extends Model
{
    use HasFactory;
    protected $table='dortoir';

    protected $fillable =[
       'code',
        'salle_id'

    ];
    public function enfants()
{
    return $this->hasMany(Enfant::class, 'dortoir_id');
}
}
