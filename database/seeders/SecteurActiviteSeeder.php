<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecteurActiviteSeeder extends Seeder
{
    public function run()
    {
        DB::table('secteurs_activite')->insert([
            ['nom_secteur' => 'Agriculture'],
            ['nom_secteur' => 'Commerce'],
            ['nom_secteur' => 'Industrie'],
            ['nom_secteur' => 'Construction'],
            ['nom_secteur' => 'Transport'],
            ['nom_secteur' => 'Technologie'],
            ['nom_secteur' => 'Tourisme'],
            ['nom_secteur' => 'Santé'],
            ['nom_secteur' => 'Éducation'],
            ['nom_secteur' => 'Services financiers'],
            ['nom_secteur' => 'Immobilier'],
            ['nom_secteur' => 'Arts et culture'],
        ]);
    }
}
