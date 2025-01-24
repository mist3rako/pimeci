<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TypeIntervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeInterventionController extends Controller
{
    // Affiche la liste des types d'intervention
    public function indextype()
    {
        $user = Auth::user();

        // Super admin voit tous les types d'intervention
        if ($user->role_as === 'super_admin') {
            $typeInterventions = TypeIntervention::all();
        } else {
            // Filtrer les types d'intervention par direction pour les admins
            $typeInterventions = TypeIntervention::where('dir_type_insp', strtoupper(str_replace('admin_', '', $user->role_as)))->get();
        }

        return view('backend.types_intervention.indextype', compact('typeInterventions'));
    }

    // Affiche le formulaire de création d'un nouveau type d'intervention
    public function createtype()
    {
        return view('backend.types_intervention.createtype');
    }

    // Enregistre un nouveau type d'intervention dans la base de données
    public function storetype(Request $request)
    {
        $request->validate([
            'nom_type_intervention' => 'required|string|max:255',
            'dir_type_insp' => 'required|string|max:11',
            'icons_champs_insp' => 'nullable|string|max:255',
        ]);
 
        TypeIntervention::create($request->all());

        return redirect()->route('types.intervention.indextype')->with([
            'message' => 'Type d\'intervention créé avec succès.',
            'alert-type' => 'success',
        ]);
    }

    // Affiche le formulaire d'édition pour un type d'intervention existant
    public function edittype($id)
    {
        $typeIntervention = TypeIntervention::findOrFail($id);
        return view('backend.types_intervention.edittype', compact('typeIntervention'));
    }

    // Met à jour un type d'intervention existant dans la base de données
    public function updatetype(Request $request, $id)
    {
        $request->validate([
            'nom_type_intervention' => 'required|string|max:255',
            'dir_type_insp' => 'required|string|max:11',
            'icons_champs_insp' => 'nullable|string|max:255',
        ]);

        $typeIntervention = TypeIntervention::findOrFail($id);
        $typeIntervention->update($request->all());

        return redirect()->route('types.intervention.indextype')->with([
            'message' => 'Type d\'intervention mis à jour avec succès.',
            'alert-type' => 'success',
        ]);
    }

    public function destroytype($id)
    {
        try {
            $typeIntervention = TypeIntervention::findOrFail($id);
            $typeIntervention->delete();
    
            return response()->json([
                'message' => 'Type d\'intervention supprimé avec succès.',
                'alert-type' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du type d\'intervention : ' . $e->getMessage(),
                'alert-type' => 'danger',
            ], 500);
        }
    }
}
