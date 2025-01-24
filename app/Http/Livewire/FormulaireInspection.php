<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Form;

class FormulaireInspection extends Component
{
    public $currentStep = 1;
    public $data = [];
    public $champId;

    public function mount($champId)
    {
        $this->champId = $champId;
        $this->initializeForm();
    }

    public function render()
    {
        $viewName = 'livewire.forms.form' . $this->champId;
        return view($viewName);
    }

    public function initializeForm()
    {
        // Initialize your data based on $champId
        // ...
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
        // Process form data
        // Validation and saving logic
        session()->flash('message', 'Formulaire soumis avec succès!');
        return redirect()->route('inspecteur.inspections.index');
    }
}
