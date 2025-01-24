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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code_employe')->unique(); // Code employé unique
            $table->string('nom');
            $table->string('prenom');
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role_as', ['super_admin', 'admin_dci', 'admin_dcri', 'admin_dcqpc', 'inspecteur_dci', 'inspecteur_dcri', 'inspecteur_dcqpc', 'analyste'])->default('analyste');
            $table->string('sexe')->nullable();
            $table->string('affectation')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('phone')->nullable();
            $table->string('no_plaque')->nullable();
            $table->enum('statut', ['activé', 'désactivé'])->default('activé'); // Statut activé par défaut
            $table->string('reset_token_insp')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};

