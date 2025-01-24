<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    // Indiquez le nom de la table si elle ne suit pas la convention de nommage
    protected $table = 'champs_inspections';
    

    // Les champs qui peuvent être remplis 
    protected $fillable = [
        'nom_champs',
        'champs_descr',
        'icons_champs_insp',
        'dir_champs_insp',
        'Created_champs',
        'updated_champs',
        'created_at',
        'updated_at'
    ];

    // Si vous utilisez les timestamps automatiquement
    public $timestamps = true;
}
