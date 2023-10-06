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
<<<<<<< HEAD
{
    return $this->belongsTo(famille::class, 'famille_id');
}
=======
    {
        return $this->belongsTo(famille::class, 'famille_id');
    }
>>>>>>> 32bce6c456c3b6d55ff6b0d0de63934006bd1c7d
}
 