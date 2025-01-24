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
        Schema::create('champs_inspections', function (Blueprint $table) {
            $table->id();
            $table->string('nom_champs');
            $table->string('champs_descr', 191);
            $table->string('icons_champs_insp')->nullable();
            $table->string('dir_champs_insp', 11);
            $table->timestamp('Created_champs')->useCurrent();
            $table->timestamp('updated_champs')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('champs_inspections');
    }
};
