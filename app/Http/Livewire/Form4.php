<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Form4 extends Component
{
    public $currentStep = 1; // Suivi de l'étape actuelle
    public $data = [
        'field1' => '',
        'field2' => '',
        'field3' => '',
        // Ajoutez d'autres champs nécessaires pour chaque étape
    ];

    public function render()
    {
        return view('livewire.form4'); // Vérifiez que cette vue contient toutes les étapes
    }
    

    public function nextStep()
    {
        if ($this->currentStep < 3) {
            $this->currentStep++;
        }
    }

    public function prevStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        // Traitement des données ici (sauvegarde en base de données, etc.)
        dd($this->data); // Pour déboguer
    }
}

