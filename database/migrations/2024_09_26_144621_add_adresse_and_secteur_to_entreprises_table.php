<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('entreprises', function (Blueprint $table) {
            // Ajouter la colonne adresse_id uniquement si elle n'existe pas déjà
            if (!Schema::hasColumn('entreprises', 'adresse_id')) {
                $table->unsignedBigInteger('adresse_id')->nullable()->after('secteur_activite');
                $table->foreign('adresse_id')->references('id')->on('adresses')->onDelete('set null');
            }

            // Ajouter la colonne secteur_activite_id uniquement si elle n'existe pas déjà
            if (!Schema::hasColumn('entreprises', 'secteur_activite_id')) {
                $table->unsignedBigInteger('secteur_activite_id')->nullable()->after('adresse_id');
                $table->foreign('secteur_activite_id')->references('id')->on('secteurs_activite')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('entreprises', function (Blueprint $table) {
            // Supprimer les clés étrangères
            $table->dropForeign(['adresse_id']);
            $table->dropForeign(['secteur_activite_id']);

            // Supprimer les colonnes
            $table->dropColumn(['adresse_id', 'secteur_activite_id']);
        });
    }
};
