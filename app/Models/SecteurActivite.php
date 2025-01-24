<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecteurActivite extends Model
{
    use HasFactory;

    protected $table = 'secteurs_activite';

    protected $fillable = [
        'nom',
    ];

    // Relation avec Entreprise
    public function entreprises()
    {
        return $this->hasMany(Entreprise::class, 'secteur_activite_id');
    }
}

