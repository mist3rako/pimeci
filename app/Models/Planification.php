<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planification extends Model
{
    use HasFactory;

    protected $fillable = [
        'planificateur',
        'id_users',
        'id_users2',
        'id_users3',
        'id_users4',
        'id_entreprises',
        'id_champs_inspection',
        'id_type_intervention',
        'plan_mission_code',
        'plan_progress_statut',
        'date_inspection',
    ];

    // Relations avec les autres modèles
    public function planificateurUser()
    {
        return $this->belongsTo(User::class, 'planificateur');
    }

    public function chefDeBrigade()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function idUsers2()
    {
        return $this->belongsTo(User::class, 'id_users2');
    }

    public function idUsers3()
    {
        return $this->belongsTo(User::class, 'id_users3');
    }

    public function idUsers4()
    {
        return $this->belongsTo(User::class, 'id_users4');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprises');
    }

    public function champsInspection()
    {
        return $this->belongsTo(ChampsInspection::class, 'id_champs_inspection');
    }

    public function typeIntervention()
    {
        return $this->belongsTo(TypeIntervention::class, 'id_type_intervention');
    }
}
