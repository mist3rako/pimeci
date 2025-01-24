<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChampsInspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // N'oubliez pas d'ajouter la façade Auth

class ChampsInspectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Super admin voit tous les champs d'inspection
        if ($user->role_as === 'super_admin') {
            $champsInspections = ChampsInspection::all();
        } else {
            // Filtrer les champs d'inspection par direction pour les admins
            $champsInspections = ChampsInspection::where('dir_champs_insp', strtoupper(str_replace('admin_', '', $user->role_as)))->get();
        }

        return view('backend.champs_inspection.index', compact('champsInspections'));
    }

    public function create()
    {
        return view('backend.champs_inspection.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_champs' => 'required|string|max:255',
            'champs_descr' => 'required|string|max:191',
            'dir_champs_insp' => 'required|string|max:11',
        ]);

        ChampsInspection::create($request->all());

        return redirect()->route('champs.inspection.index')->with([
            'message' => 'Champs d\'inspection créé avec succès.',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        $champsInspection = ChampsInspection::findOrFail($id);
        return view('backend.champs_inspection.edit', compact('champsInspection'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_champs' => 'required|string|max:255',
            'champs_descr' => 'required|string|max:191',
            'dir_champs_insp' => 'required|string|max:11',
        ]);

        $champsInspection = ChampsInspection::findOrFail($id);
        $champsInspection->update($request->all());

        return redirect()->route('champs.inspection.index')->with([
            'message' => 'Champs d\'inspection mis à jour avec succès.',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        try {
            $champsInspection = ChampsInspection::findOrFail($id);
            $champsInspection->delete();
    
            return response()->json([
                'message' => 'Champs d\'inspection supprimé avec succès.',
                'alert-type' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du champ : ' . $e->getMessage(),
                'alert-type' => 'danger',
            ], 500);
        }
    }
}
