<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anneescolaire extends Model
{
    use HasFactory;
    protected $table='anneescolaire';
    protected $fillable =[

        'date_deb',
        'date_fin'

    ];
    public function classe()
{
    return $this->belongsTo(Classe::class);
}
}
 