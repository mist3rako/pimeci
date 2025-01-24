<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Adresse;
use App\Models\SecteurActivite;
use App\Models\Entreprise;

class EntreprisesTableSeeder extends Seeder
{
    public function run()
    {
        // Create sectors if they don't exist
        $secteurAlcil = SecteurActivite::firstOrCreate(['nom_secteur' => 'Alcil']);
        $secteurLoto = SecteurActivite::firstOrCreate(['nom_secteur' => 'Loto']);

        // Create addresses if they don't exist
        $adresseGonaves = Adresse::firstOrCreate([
            'departement' => 'Artibonite',
            'commune' => 'Gonaïves',
            'code_postal' => 'HT2326'
        ]);
        $adresseDelmas = Adresse::firstOrCreate([
            'departement' => 'Ouest',
            'commune' => 'Delmas',
            'code_postal' => 'HT1417'
        ]);

        // Insert companies with sector and address relations
        Entreprise::create([
            'code_entreprise' => 'SNC17890',
            'nom_entreprise' => 'AKO IDEAL',
            'secteur_activite_id' => $secteurAlcil->id,
            'adresse_id' => $adresseGonaves->id,
            'rue' => '5, Rigaud',
            'created_at' => '2024-07-19 22:12:53',
            'updated_at' => '2024-08-13 19:07:51',
        ]);

        Entreprise::create([
            'code_entreprise' => 'SNC4759',
            'nom_entreprise' => 'Kali Loto',
            'secteur_activite_id' => $secteurLoto->id,
            'adresse_id' => $adresseDelmas->id,
            'rue' => '34, Rue Jollo',
            'created_at' => '2024-09-19 15:52:57',
            'updated_at' => '2024-09-19 15:52:57',
        ]);
    }
}

