<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planificateur')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_users')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_users2')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_users3')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_users4')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_entreprises')->nullable()->constrained('entreprises')->onDelete('cascade');
            $table->foreignId('id_champs_inspection')->nullable()->constrained('champs_inspections')->onDelete('cascade');
            $table->foreignId('id_type_intervention')->nullable()->constrained('type_interventions')->onDelete('cascade');
            $table->string('plan_mission_code', 20);
            $table->enum('plan_progress_statut', ['Planifié', 'En cours', 'Complète', 'Expiré'])->default('Planifié');
            $table->dateTime('date_inspection')->nullable();
            $table->timestamps();

            $table->unique('plan_mission_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planifications');
    }
}
