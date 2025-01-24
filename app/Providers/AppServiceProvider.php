<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // Import de la classe Schema
use Livewire\Livewire;
use App\Http\Livewire\PlanificationCreate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Définir la longueur par défaut des chaînes pour éviter l'erreur de clé trop longue
        Schema::defaultStringLength(191);
        Livewire::component('planification-create', PlanificationCreate::class);
    }

    
}
