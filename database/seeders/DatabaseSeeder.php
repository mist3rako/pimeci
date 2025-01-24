<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'code_employe' => 'ADM001',
            'nom' => 'Super',
            'prenom' => 'Admin',
            'user_name' => 'superadmin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_as' => 'super_admin',
            'sexe' => 'M',
            'affectation' => 'Direction Générale',
            'profile_pic' => 'path/to/superadmin_profile_pic.png',
            'phone' => '+50912345678',
            'no_plaque' => 'ADM001',
            'statut' => 'activé',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin DCI
        User::create([
            'code_employe' => 'DCI001',
            'nom' => 'Admin',
            'prenom' => 'DCI',
            'user_name' => 'admindci',
            'email' => 'admindci@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_as' => 'admin_dci',
            'sexe' => 'M',
            'affectation' => 'DCI - Port-au-Prince',
            'profile_pic' => 'path/to/admindci_profile_pic.png',
            'phone' => '+50987654321',
            'no_plaque' => 'DCI001',
            'statut' => 'activé',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin DCRI
        User::create([
            'code_employe' => 'DCRI001',
            'nom' => 'Admin',
            'prenom' => 'DCRI',
            'user_name' => 'admindcri',
            'email' => 'admindcri@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_as' => 'admin_dcri',
            'sexe' => 'M',
            'affectation' => 'DCRI - Cap-Haïtien',
            'profile_pic' => 'path/to/admindcri_profile_pic.png',
            'phone' => '+50911223344',
            'no_plaque' => 'DCRI001',
            'statut' => 'activé',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin DCQPC
        User::create([
            'code_employe' => 'DCQPC001',
            'nom' => 'Admin',
            'prenom' => 'DCQPC',
            'user_name' => 'admindcqpc',
            'email' => 'admindcqpc@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_as' => 'admin_dcqpc',
            'sexe' => 'M',
            'affectation' => 'DCQPC - Jacmel',
            'profile_pic' => 'path/to/admindcqpc_profile_pic.png',
            'phone' => '+50999887766',
            'no_plaque' => 'DCQPC001',
            'statut' => 'activé',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Inspecteur DCI
        User::create([
            'code_employe' => 'DCI002',
            'nom' => 'Inspecteur',
            'prenom' => 'DCI',
            'user_name' => 'inspecteurdci',
            'email' => 'inspecteurdci@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_as' => 'inspecteur_dci',
            'sexe' => 'F',
            'affectation' => 'DCI - Port-au-Prince',
            'profile_pic' => 'path/to/inspecteurdci_profile_pic.png',
            'phone' => '+50912344321',
            'no_plaque' => 'DCI002',
            'statut' => 'activé',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Inspecteur DCRI
        User::create([
            'code_employe' => 'DCRI002',
            'nom' => 'Inspecteur',
            'prenom' => 'DCRI',
            'user_name' => 'inspecteurdcri',
            'email' => 'inspecteurdcri@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_as' => 'inspecteur_dcri',
            'sexe' => 'M',
            'affectation' => 'DCRI - Cap-Haïtien',
            'profile_pic' => 'path/to/inspecteurdcri_profile_pic.png',
            'phone' => '+50933221100',
            'no_plaque' => 'DCRI002',
            'statut' => 'activé',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Inspecteur DCQPC
        User::create([
            'code_employe' => 'DCQPC002',
            'nom' => 'Inspecteur',
            'prenom' => 'DCQPC',
            'user_name' => 'inspecteurdcqpc',
            'email' => 'inspecteurdcqpc@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_as' => 'inspecteur_dcqpc',
            'sexe' => 'M',
            'affectation' => 'DCQPC - Jacmel',
            'profile_pic' => 'path/to/inspecteurdcqpc_profile_pic.png',
            'phone' => '+50955443322',
            'no_plaque' => 'DCQPC002',
            'statut' => 'activé',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Analyste
        User::create([
            'code_employe' => 'ANL001',
            'nom' => 'Analyste',
            'prenom' => 'User',
            'user_name' => 'analysteuser',
            'email' => 'analyste@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_as' => 'analyste',
            'sexe' => 'M',
            'affectation' => 'Direction Générale',
            'profile_pic' => 'path/to/analyste_profile_pic.png',
            'phone' => '+50922334455',
            'no_plaque' => 'ANL001',
            'statut' => 'activé',
            'remember_token' => \Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
