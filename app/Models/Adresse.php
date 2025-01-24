<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    protected $table = 'adresses';

    protected $fillable = [
        'departement',
        'commune',
        'code_postal',
    ];

    // Relation avec Entreprise
    public function entreprises()
    {
        return $this->hasMany(Entreprise::class, 'adresse_id');
    }
}

