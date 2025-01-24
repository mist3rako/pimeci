<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdressesSeeder extends Seeder
{
    public function run()
    {
        DB::table('adresses')->insert([
            // Département de l'Artibonite
            ['departement' => 'Artibonite', 'commune' => 'Anse-Rouge', 'code_postal' => 'HT2320'],
            ['departement' => 'Artibonite', 'commune' => 'Desdunes', 'code_postal' => 'HT2322'],
            ['departement' => 'Artibonite', 'commune' => 'Dessalines', 'code_postal' => 'HT2323'],
            ['departement' => 'Artibonite', 'commune' => 'Ennery', 'code_postal' => 'HT2324'],
            ['departement' => 'Artibonite', 'commune' => 'Estère', 'code_postal' => 'HT2325'],
            ['departement' => 'Artibonite', 'commune' => 'Gonaïves', 'code_postal' => 'HT2326'],
            ['departement' => 'Artibonite', 'commune' => 'Grand Saline', 'code_postal' => 'HT2327'],
            ['departement' => 'Artibonite', 'commune' => 'Gros-Morne', 'code_postal' => 'HT2328'],
            ['departement' => 'Artibonite', 'commune' => 'La Chapelle', 'code_postal' => 'HT2329'],
            ['departement' => 'Artibonite', 'commune' => 'Marmelade', 'code_postal' => 'HT2330'],
            ['departement' => 'Artibonite', 'commune' => 'Petite Rivière de l’Artibonite', 'code_postal' => 'HT2331'],
            ['departement' => 'Artibonite', 'commune' => 'Saint-Marc', 'code_postal' => 'HT2332'],
            ['departement' => 'Artibonite', 'commune' => 'Saint-Michel de l\'Attalaye', 'code_postal' => 'HT2333'],
            ['departement' => 'Artibonite', 'commune' => 'Terre-Neuve', 'code_postal' => 'HT2334'],
            ['departement' => 'Artibonite', 'commune' => 'Verrettes', 'code_postal' => 'HT2335'],

            // Département de l’Ouest
            ['departement' => 'Ouest', 'commune' => 'Anse-à-Galets', 'code_postal' => 'HT1410'],
            ['departement' => 'Ouest', 'commune' => 'Arcahaie', 'code_postal' => 'HT1411'],
            ['departement' => 'Ouest', 'commune' => 'Cabaret', 'code_postal' => 'HT1412'],
            ['departement' => 'Ouest', 'commune' => 'Carrefour', 'code_postal' => 'HT1413'],
            ['departement' => 'Ouest', 'commune' => 'Cité Soleil', 'code_postal' => 'HT1414'],
            ['departement' => 'Ouest', 'commune' => 'Cornillon', 'code_postal' => 'HT1415'],
            ['departement' => 'Ouest', 'commune' => 'Croix-des-Bouquets', 'code_postal' => 'HT1416'],
            ['departement' => 'Ouest', 'commune' => 'Delmas', 'code_postal' => 'HT1417'],
            ['departement' => 'Ouest', 'commune' => 'Fond-Verettes', 'code_postal' => 'HT1418'],
            ['departement' => 'Ouest', 'commune' => 'Ganthier', 'code_postal' => 'HT1419'],
            ['departement' => 'Ouest', 'commune' => 'Grand-Goâve', 'code_postal' => 'HT1420'],
            ['departement' => 'Ouest', 'commune' => 'Gressier', 'code_postal' => 'HT1421'],
            ['departement' => 'Ouest', 'commune' => 'Kenscoff', 'code_postal' => 'HT1422'],
            ['departement' => 'Ouest', 'commune' => 'Léogâne', 'code_postal' => 'HT1423'],
            ['departement' => 'Ouest', 'commune' => 'Pétion-Ville', 'code_postal' => 'HT1424'],
            ['departement' => 'Ouest', 'commune' => 'Petit-Goâve', 'code_postal' => 'HT1425'],
            ['departement' => 'Ouest', 'commune' => 'Pointe-à-Raquette', 'code_postal' => 'HT1426'],
            ['departement' => 'Ouest', 'commune' => 'Port-au-Prince', 'code_postal' => 'HT1427'],
            ['departement' => 'Ouest', 'commune' => 'Thomazeau', 'code_postal' => 'HT1428'],

            // Département du Nord
            ['departement' => 'Nord', 'commune' => 'Acul-du-Nord', 'code_postal' => 'HT2200'],
            ['departement' => 'Nord', 'commune' => 'Bahon', 'code_postal' => 'HT2201'],
            ['departement' => 'Nord', 'commune' => 'Bas-Limbé', 'code_postal' => 'HT2202'],
            ['departement' => 'Nord', 'commune' => 'Cap-Haïtien', 'code_postal' => 'HT2203'],
            ['departement' => 'Nord', 'commune' => 'Dondon', 'code_postal' => 'HT2204'],
            ['departement' => 'Nord', 'commune' => 'Grande Rivière du Nord', 'code_postal' => 'HT2205'],
            ['departement' => 'Nord', 'commune' => 'La Victoire', 'code_postal' => 'HT2206'],
            ['departement' => 'Nord', 'commune' => 'Le-Borgne', 'code_postal' => 'HT2207'],
            ['departement' => 'Nord', 'commune' => 'Limbé', 'code_postal' => 'HT2208'],
            ['departement' => 'Nord', 'commune' => 'Limonade', 'code_postal' => 'HT2209'],
            ['departement' => 'Nord', 'commune' => 'Milot', 'code_postal' => 'HT2210'],
            ['departement' => 'Nord', 'commune' => 'Pignon', 'code_postal' => 'HT2211'],
            ['departement' => 'Nord', 'commune' => 'Pilate', 'code_postal' => 'HT2212'],
            ['departement' => 'Nord', 'commune' => 'Plaine-du-Nord', 'code_postal' => 'HT2213'],
            ['departement' => 'Nord', 'commune' => 'Plaissance', 'code_postal' => 'HT2214'],
            ['departement' => 'Nord', 'commune' => 'Port-Margot', 'code_postal' => 'HT2215'],
            ['departement' => 'Nord', 'commune' => 'Quartier-Morin', 'code_postal' => 'HT2216'],
            ['departement' => 'Nord', 'commune' => 'Ranquitte', 'code_postal' => 'HT2217'],
            ['departement' => 'Nord', 'commune' => 'Saint-Raphaël', 'code_postal' => 'HT2218'],

            // Département du Sud
            ['departement' => 'Sud', 'commune' => 'Aquin', 'code_postal' => 'HT3430'],
            ['departement' => 'Sud', 'commune' => 'Arniquet', 'code_postal' => 'HT3431'],
            ['departement' => 'Sud', 'commune' => 'Camp-Perrin', 'code_postal' => 'HT3432'],
            ['departement' => 'Sud', 'commune' => 'Cavaillon', 'code_postal' => 'HT3433'],
            ['departement' => 'Sud', 'commune' => 'Cayes', 'code_postal' => 'HT3434'],
            ['departement' => 'Sud', 'commune' => 'Chantal', 'code_postal' => 'HT3435'],
            ['departement' => 'Sud', 'commune' => 'Chardonnières', 'code_postal' => 'HT3436'],
            ['departement' => 'Sud', 'commune' => 'Les Anglais', 'code_postal' => 'HT3437'],
            ['departement' => 'Sud', 'commune' => 'Les-Côteaux', 'code_postal' => 'HT3438'],
            ['departement' => 'Sud', 'commune' => 'Île-à-Vache', 'code_postal' => 'HT3439'],
            ['departement' => 'Sud', 'commune' => 'Maniche', 'code_postal' => 'HT3440'],
            ['departement' => 'Sud', 'commune' => 'Port-à-Piment', 'code_postal' => 'HT3441'],
            ['departement' => 'Sud', 'commune' => 'Port-Salut', 'code_postal' => 'HT3442'],
            ['departement' => 'Sud', 'commune' => 'Roche-à-Bateau', 'code_postal' => 'HT3443'],
            ['departement' => 'Sud', 'commune' => 'Saint-Jean-du-Sud', 'code_postal' => 'HT3444'],
            ['departement' => 'Sud', 'commune' => 'Saint-Louis-du-Sud', 'code_postal' => 'HT3445'],
            ['departement' => 'Sud', 'commune' => 'Tiburon', 'code_postal' => 'HT3446'],
            ['departement' => 'Sud', 'commune' => 'Torbeck', 'code_postal' => 'HT3447'],
            
            // Département du Centre
            ['departement' => 'Centre', 'commune' => 'Belladère', 'code_postal' => 'HT7310'],
            ['departement' => 'Centre', 'commune' => 'Cerca-Carvajal', 'code_postal' => 'HT7311'],
            ['departement' => 'Centre', 'commune' => 'Cerca-La-Source', 'code_postal' => 'HT7312'],
            ['departement' => 'Centre', 'commune' => 'Hinche', 'code_postal' => 'HT7313'],
            ['departement' => 'Centre', 'commune' => 'Lascohobas', 'code_postal' => 'HT7314'],
            ['departement' => 'Centre', 'commune' => 'Maïssade', 'code_postal' => 'HT7315'],
            ['departement' => 'Centre', 'commune' => 'Mirebalais', 'code_postal' => 'HT7316'],
            ['departement' => 'Centre', 'commune' => 'Savanette', 'code_postal' => 'HT7317'],
            ['departement' => 'Centre', 'commune' => 'Thomasique', 'code_postal' => 'HT7318'],
            ['departement' => 'Centre', 'commune' => 'Thomonde', 'code_postal' => 'HT7319'],
            ['departement' => 'Centre', 'commune' => 'Ville-Bonheur (Saut-d\'Eau)', 'code_postal' => 'HT7320'],

            // Département de la Grand’Anse
            ['departement' => 'Grand’Anse', 'commune' => 'Abricot', 'code_postal' => 'HT7440'],
            ['departement' => 'Grand’Anse', 'commune' => 'Anse-d\'Hainault', 'code_postal' => 'HT7441'],
            ['departement' => 'Grand’Anse', 'commune' => 'Beaumont', 'code_postal' => 'HT7442'],
            ['departement' => 'Grand’Anse', 'commune' => 'Chambellan', 'code_postal' => 'HT7443'],
            ['departement' => 'Grand’Anse', 'commune' => 'Corail', 'code_postal' => 'HT7444'],
            ['departement' => 'Grand’Anse', 'commune' => 'Dame-Marie', 'code_postal' => 'HT7445'],
            ['departement' => 'Grand’Anse', 'commune' => 'Jérémie', 'code_postal' => 'HT7446'],
            ['departement' => 'Grand’Anse', 'commune' => 'Les-Irois', 'code_postal' => 'HT7447'],
            ['departement' => 'Grand’Anse', 'commune' => 'Moron', 'code_postal' => 'HT7448'],
            ['departement' => 'Grand’Anse', 'commune' => 'Pestel', 'code_postal' => 'HT7449'],
            ['departement' => 'Grand’Anse', 'commune' => 'Roseaux', 'code_postal' => 'HT7450'],
            ['departement' => 'Grand’Anse', 'commune' => 'Trou-Bonbon', 'code_postal' => 'HT7451'],

            // Département des Nippes
            ['departement' => 'Nippes', 'commune' => 'Anse-à-Veau', 'code_postal' => 'HT7430'],
            ['departement' => 'Nippes', 'commune' => 'Barradères', 'code_postal' => 'HT7431'],
            ['departement' => 'Nippes', 'commune' => 'Fonds des Nègres', 'code_postal' => 'HT7432'],
            ['departement' => 'Nippes', 'commune' => 'Grand Boucan', 'code_postal' => 'HT7433'],
            ['departement' => 'Nippes', 'commune' => 'L\'Asile', 'code_postal' => 'HT7434'],
            ['departement' => 'Nippes', 'commune' => 'Miragoâne', 'code_postal' => 'HT7435'],
            ['departement' => 'Nippes', 'commune' => 'Paillant', 'code_postal' => 'HT7436'],
            ['departement' => 'Nippes', 'commune' => 'Petite Rivière de Nippes', 'code_postal' => 'HT7437'],
            ['departement' => 'Nippes', 'commune' => 'Petit-Trou-de-Nippes', 'code_postal' => 'HT7438'],
            ['departement' => 'Nippes', 'commune' => 'Plaisance, Arnaud', 'code_postal' => 'HT7439'],

            // Département du Sud-Est
            ['departement' => 'Sud-Est', 'commune' => 'Anse-à-Pitre', 'code_postal' => 'HT8120'],
            ['departement' => 'Sud-Est', 'commune' => 'Bainet', 'code_postal' => 'HT8121'],
            ['departement' => 'Sud-Est', 'commune' => 'Belle-Anse', 'code_postal' => 'HT8122'],
            ['departement' => 'Sud-Est', 'commune' => 'Cayes-Jacmel', 'code_postal' => 'HT8123'],
            ['departement' => 'Sud-Est', 'commune' => 'Côte-de-Fer', 'code_postal' => 'HT8124'],
            ['departement' => 'Sud-Est', 'commune' => 'Grand-Gosier', 'code_postal' => 'HT8125'],
            ['departement' => 'Sud-Est', 'commune' => 'Jacmel', 'code_postal' => 'HT8126'],
            ['departement' => 'Sud-Est', 'commune' => 'La Vallée de Jacmel', 'code_postal' => 'HT8127'],
            ['departement' => 'Sud-Est', 'commune' => 'Marigot', 'code_postal' => 'HT8128'],
            ['departement' => 'Sud-Est', 'commune' => 'Thiotte', 'code_postal' => 'HT8129'],
        ]);
    }
}
