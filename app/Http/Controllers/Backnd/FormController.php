<?php

namespace App\Http\Controllers\Backnd;

use App\Http\Controllers\Controller;
use App\Models\Form; // Assurez-vous que ce modèle existe
use App\Models\Inspection; // Assurez-vous que ce modèle existe également
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Afficher le formulaire 
    public function show($id)
    {
        $form = Form::findOrFail($id); // Récupérer le formulaire par ID
        return view('backnd.forms.show', compact('form'));
    }

    public function startInspection($champId, $inspectionId)
    {
        return view('backnd.forms.start_inspection', [
            'champId' => $champId,
            'inspectionId' => $inspectionId
        ]);
    }
    

    // Gérer la soumission du formulaire
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            // Ajoutez ici vos règles de validation
            'champ1' => 'required|string|max:255',
            'champ2' => 'required|email',
            // Ajoutez d'autres champs selon vos besoins
        ]);

        // Enregistrer les données du formulaire dans la base de données
        $form = new Form(); // Créez une nouvelle instance du modèle Form
        $form->champ1 = $request->input('champ1');
        $form->champ2 = $request->input('champ2');
        // Assignez d'autres champs selon vos besoins
        $form->save();

        return redirect()->route('inspecteur.inspections.index')->with('success', 'Formulaire soumis avec succès!');
    }
}
