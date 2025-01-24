<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeIntervention;

class TypeInterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeIntervention::insert([
            [
                'nom_type_intervention' => 'Suivi d’une Plainte',
                'dir_type_insp' => 'DCQPC',
                'icons_champs_insp' => 'icon1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_type_intervention' => 'Suivi d’une intervention précédente',
                'dir_type_insp' => 'DCRI',
                'icons_champs_insp' => 'icon2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_type_intervention' => 'Pour l’obtention d’une CIP',
                'dir_type_insp' => 'DCI',
                'icons_champs_insp' => 'icon3.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_type_intervention' => 'Suivi pour l\'obtention d\'un Certificat',
                'dir_type_insp' => 'DCQPC',
                'icons_champs_insp' => 'icon4.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_type_intervention' => 'Marchés Communaux',
                'dir_type_insp' => 'DCI',
                'icons_champs_insp' => 'icon5.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_type_intervention' => 'Inspection Régulière ou de Routine',
                'dir_type_insp' => 'DCQPC',
                'icons_champs_insp' => 'icon6.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_type_intervention' => 'Suivi d\'une Inspection Antérieure',
                'dir_type_insp' => 'DCQPC',
                'icons_champs_insp' => 'icon7.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_type_intervention' => 'Suivi pour l\'Obtention d\'une CIP',
                'dir_type_insp' => 'DCQPC',
                'icons_champs_insp' => 'icon8.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_type_intervention' => 'Echantillonnage',
                'dir_type_insp' => 'DCQPC',
                'icons_champs_insp' => 'icon9.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
