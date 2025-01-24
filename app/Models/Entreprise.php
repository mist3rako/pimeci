<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = [
        'code_entreprise', 'nom_entreprise', 'secteur_activite_id', 'adresse_id', 'rue',
    ];

    // Relation avec l'adresse
    public function adresse()
    {
        return $this->belongsTo(Adresse::class, 'adresse_id');
    }

    // Relation avec le secteur d'activité
    public function secteurActivite()
    {
        return $this->belongsTo(SecteurActivite::class, 'secteur_activite_id');
    }
}


