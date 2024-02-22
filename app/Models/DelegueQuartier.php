<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelegueQuartier extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_habitant'
    ];

    public function habitant()
    {
        return $this->belongsTo(Habitant::class, 'id_habitant');
    }
}
