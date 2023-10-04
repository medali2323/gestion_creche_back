<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $table='message';
    protected $fillable =[
        'date_message',
        'objet_message',
        'contenu',
        'famille_id',
        'etat'

    ];
    public function famille()
{
    return $this->belongsTo(famille::class, 'famille_id');
}
}
 