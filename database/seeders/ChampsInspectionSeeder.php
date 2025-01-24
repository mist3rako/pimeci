<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChampsInspection;

class ChampsInspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChampsInspection::insert([
            ['nom_champs' => 'Installations de stockage et de vente de produits alimentaires', 'champs_descr' => 'Supermarchés, dépôts, entrepôts, boutiques, ...', 'icons_champs_insp' => 'icon1.png', 'dir_champs_insp' => 'DCQPC', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Installations de production et de transformation de denrées alimentaires', 'champs_descr' => 'Tout type d\'installations de ce genre, y compris les entreprises de production d\'eau traitée & glace, de jus et de boissons de toutes sortes', 'icons_champs_insp' => 'icon2.png', 'dir_champs_insp' => 'DCQPC', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Installations de préparation et de déserte de produits alimentaires prêts à consommer', 'champs_descr' => 'Restaurants, boulangeries et pâtisseries', 'icons_champs_insp' => 'icon3.png', 'dir_champs_insp' => 'DCQPC', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Installations d\'abattage d\'entreposage et de vente de produits carnés', 'champs_descr' => 'Dépôts Chambres froides, Abattoirs & boucheries ,Charcuteries', 'icons_champs_insp' => 'icon4.png', 'dir_champs_insp' => 'DCQPC', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Métrologie', 'champs_descr' => 'Stations à essence et toute les institutions où l\'on utilise des instruments de mesure à des fins de commerce', 'icons_champs_insp' => 'icon5.png', 'dir_champs_insp' => 'DCQPC', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Pharmacies', 'champs_descr' => 'Pharmacies', 'icons_champs_insp' => 'icon6.png', 'dir_champs_insp' => 'DCQPC', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Service de l\'Inspection Commerciale', 'champs_descr' => '', 'icons_champs_insp' => 'icon7.png', 'dir_champs_insp' => 'DCI', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Pour l\'Obtention de la carte d\'Identité Professionnelle  (CIP)', 'champs_descr' => '', 'icons_champs_insp' => 'icon8.png', 'dir_champs_insp' => 'DCI', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Collecte  des Prix dans les Marchés  Communaux', 'champs_descr' => '', 'icons_champs_insp' => 'icon9.png', 'dir_champs_insp' => 'DCI', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Inspection dans les Supermarchés', 'champs_descr' => '', 'icons_champs_insp' => 'icon10.png', 'dir_champs_insp' => 'DCI', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Visite dans les Entrepôts pour le Contrôle des Stocks', 'champs_descr' => '', 'icons_champs_insp' => 'icon11.png', 'dir_champs_insp' => 'DCI', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Installations de produits,  d\'entreposage et de vente de matériaux de construction', 'champs_descr' => 'Produits, entreposage, vente de matériaux de construction', 'icons_champs_insp' => 'icon12.png', 'dir_champs_insp' => 'DCQPC', 'created_at' => now(), 'updated_at' => now()],
            ['nom_champs' => 'Marchés communaux', 'champs_descr' => 'Marchés communaux', 'icons_champs_insp' => 'icon13.png', 'dir_champs_insp' => 'DCQPC', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
