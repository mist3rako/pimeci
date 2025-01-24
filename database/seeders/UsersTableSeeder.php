<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un Super Admin
        User::create([
            'code_employe' => 'SA001',
            'nom' => 'Super',
            'prenom' => 'Admin',
            'user_name' => 'superadmin',
            'email' => 'superadmin@mci.gouv.ht',
            'password' => Hash::make('password'), // Assurez-vous de changer cela en production
            'role_as' => 'super_admin',
            'sexe' => 'M',
            'affectation' => 'Central Office',
            'profile_pic' => 'path/to/superadmin.png',
            'phone' => '+50912345678',
            'no_plaque' => 'SP001',
            'statut' => 'activé',
        ]);

        // Créer un Administrateur DCI
        User::create([
            'code_employe' => 'DCI001',
            'nom' => 'Directeur',
            'prenom' => 'DCI',
            'user_name' => 'admindci',
            'email' => 'admindci@mci.gouv.ht',
            'password' => Hash::make('password'), // Assurez-vous de changer cela en production
            'role_as' => 'admin_dci',
            'sexe' => 'F',
            'affectation' => 'DCI Office',
            'profile_pic' => 'path/to/admindci.png',
            'phone' => '+50987654321',
            'no_plaque' => 'DCI001',
            'statut' => 'activé',
        ]);

        // Créer un Administrateur DCRI
        User::create([
            'code_employe' => 'DCRI001',
            'nom' => 'Directeur',
            'prenom' => 'DCRI',
            'user_name' => 'admindcri',
            'email' => 'admindcri@mci.gouv.ht',
            'password' => Hash::make('password'), // Assurez-vous de changer cela en production
            'role_as' => 'admin_dcri',
            'sexe' => 'M',
            'affectation' => 'DCRI Office',
            'profile_pic' => 'path/to/admindcri.png',
            'phone' => '+50922334455',
            'no_plaque' => 'DCRI001',
            'statut' => 'activé',
        ]);

        // Créer un Administrateur DCQPC
        User::create([
            'code_employe' => 'DCQPC001',
            'nom' => 'Directeur',
            'prenom' => 'DCQPC',
            'user_name' => 'admindcqpc',
            'email' => 'admindcqpc@mci.gouv.ht',
            'password' => Hash::make('password'), // Assurez-vous de changer cela en production
            'role_as' => 'admin_dcqpc',
            'sexe' => 'M',
            'affectation' => 'DCQPC Office',
            'profile_pic' => 'path/to/admindcqpc.png',
            'phone' => '+50933445566',
            'no_plaque' => 'DCQPC001',
            'statut' => 'activé',
        ]);

        // Créer un Inspecteur DCI
        User::create([
            'code_employe' => 'INSPDCI001',
            'nom' => 'Inspecteur',
            'prenom' => 'DCI',
            'user_name' => 'inspdc',
            'email' => 'inspdc@mci.gouv.ht',
            'password' => Hash::make('password'), // Assurez-vous de changer cela en production
            'role_as' => 'inspecteur_dci',
            'sexe' => 'M',
            'affectation' => 'DCI Office',
            'profile_pic' => 'path/to/inspdc.png',
            'phone' => '+50944556677',
            'no_plaque' => 'INSPDCI001',
            'statut' => 'activé',
        ]);

        // Créer un Inspecteur DCRI
        User::create([
            'code_employe' => 'INSPDCRI001',
            'nom' => 'Inspecteur',
            'prenom' => 'DCRI',
            'user_name' => 'inspdcri',
            'email' => 'inspdcri@mci.gouv.ht',
            'password' => Hash::make('password'), // Assurez-vous de changer cela en production
            'role_as' => 'inspecteur_dcri',
            'sexe' => 'M',
            'affectation' => 'DCRI Office',
            'profile_pic' => 'path/to/inspdcri.png',
            'phone' => '+50955667788',
            'no_plaque' => 'INSPDCRI001',
            'statut' => 'activé',
        ]);

        // Créer un Inspecteur DCQPC
        User::create([
            'code_employe' => 'INSPDCQPC001',
            'nom' => 'Inspecteur',
            'prenom' => 'DCQPC',
            'user_name' => 'inspdcqpc',
            'email' => 'inspdcqpc@mci.gouv.ht',
            'password' => Hash::make('password'), // Assurez-vous de changer cela en production
            'role_as' => 'inspecteur_dcqpc',
            'sexe' => 'M',
            'affectation' => 'DCQPC Office',
            'profile_pic' => 'path/to/inspdcqpc.png',
            'phone' => '+50966778899',
            'no_plaque' => 'INSPDCQPC001',
            'statut' => 'activé',
        ]);

        // Créer un Analyste
        User::create([
            'code_employe' => 'ANL001',
            'nom' => 'Analyste',
            'prenom' => 'MCI',
            'user_name' => 'analyste',
            'email' => 'analyste@mci.gouv.ht',
            'password' => Hash::make('password'), // Assurez-vous de changer cela en production
            'role_as' => 'analyste',
            'sexe' => 'F',
            'affectation' => 'Central Office',
            'profile_pic' => 'path/to/analyste.png',
            'phone' => '+50977889900',
            'no_plaque' => 'ANL001',
            'statut' => 'activé',
        ]);
    }
}
