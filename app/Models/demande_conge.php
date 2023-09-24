<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demande_conge extends Model
{
    use HasFactory;
    protected $table='demande_conges';
    protected $fillable =[
        'code',
        'date_deb',
        'date_fin',
        'validation',
        'employe_id'

    ];
    public function employe()
    {
        return $this->belongsTo(employe::class);
    }
}
