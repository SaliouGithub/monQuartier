<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitant extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'id_maison'
    ];

    public function maison()
    {
        return $this->belongsTo(Maison::class, 'id_maison');
    }
}
