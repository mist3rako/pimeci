<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
    Schema::create('entreprises', function (Blueprint $table) {
        $table->id();
        $table->string('code_entreprise', 50)->unique();
        $table->string('nom_entreprise', 100);
        $table->unsignedBigInteger('secteur_activite_id')->nullable();  // Foreign key to secteurs_activite
        $table->unsignedBigInteger('adresse_id')->nullable();  // Foreign key to adresses
        $table->string('rue', 100)->nullable(); // Rue in entreprise (if needed)
        $table->foreign('secteur_activite_id')->references('id')->on('secteurs_activite')->onDelete('cascade');
        $table->foreign('adresse_id')->references('id')->on('adresses')->onDelete('cascade');
        $table->timestamps();
    });
}



    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
