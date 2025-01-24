<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $table = 'planifications'; // Nom de la table

    protected $casts = [
        'date_inspection' => 'datetime', // Cast date_inspection to a Carbon instance
    ];

    // Relations
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprises');
    }

    public function typeIntervention()
    {
        return $this->belongsTo(TypeIntervention::class, 'id_type_intervention');
    }

    public function planificateurUser()
    {
        return $this->belongsTo(User::class, 'planificateur'); // Vérifiez que 'planificateur' correspond à la colonne dans la table
    }
    
     

    public function chefDeBrigade()
    {
        return $this->belongsTo(User::class, 'id_users'); // Chef de brigade
    }

    public function idUsers2()
    {
        return $this->belongsTo(User::class, 'id_users2'); // Inspecteur 2
    }

    public function idUsers3()
    {
        return $this->belongsTo(User::class, 'id_users3'); // Inspecteur 3
    }

    public function idUsers4()
    {
        return $this->belongsTo(User::class, 'id_users4'); // Inspecteur 4
    }

    // Optionnel : Créez une méthode pour récupérer tous les inspecteurs
    public function inspecteurs()
    {
        return $this->hasMany(User::class, 'id', 'id_users')
                    ->orWhere('id', $this->id_users2)
                    ->orWhere('id', $this->id_users3)
                    ->orWhere('id', $this->id_users4);
    }

    public function champsInspection()
    {
        return $this->belongsTo(ChampsInspection::class, 'id_champs_inspection');
    }
}
