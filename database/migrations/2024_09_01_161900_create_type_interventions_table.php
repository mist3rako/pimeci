<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_interventions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_type_intervention');
            $table->string('dir_type_insp', 11);
            $table->string('icons_champs_insp')->nullable();
            $table->timestamp('created_type_intervention')->useCurrent();
            $table->timestamp('updated_type_intervention')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_interventions');
    }
};
