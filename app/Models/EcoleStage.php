<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcoleStage extends Model
{
    
    protected $fillable = [
        'nom_ecole',
        'adresse'
    ];
}
