<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Adresse;
use App\Models\SecteurActivite;

class EntrepriseController extends Controller
{
    public function index()
    {
        // Charger les entreprises avec leurs relations et appliquer la pagination
        $entreprises = Entreprise::with(['adresse', 'secteurActivite'])->paginate(10); // Paginer par 10 entreprises par page
        return view('backend.entreprises.index', compact('entreprises'));
    }

    public function create()
    {
        // Charger toutes les adresses et secteurs d'activité pour les dropdowns
        $adresses = Adresse::all();
        $secteurs = SecteurActivite::all();
        return view('backend.entreprises.create', compact('adresses', 'secteurs'));
    }

    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'code_entreprise' => 'required|unique:entreprises,code_entreprise',
        'nom_entreprise' => 'required|string|max:100',
        'secteur_activite' => 'required|exists:secteurs_activite,id',
        'departement' => 'required|string',
        'commune' => 'required|string',
        'rue' => 'nullable|string|max:100',
    ]);

    // Récupération ou création de l'adresse
    $adresse = Adresse::firstOrCreate([
        'departement' => $request->departement,
        'commune' => $request->commune,
    ], [
        'code_postal' => $request->code_postal,
    ]);

    // Création de l'entreprise avec l'ID de l'adresse
    Entreprise::create([
        'code_entreprise' => $request->code_entreprise,
        'nom_entreprise' => $request->nom_entreprise,
        'secteur_activite_id' => $request->secteur_activite,
        'adresse_id' => $adresse->id,  // Enregistrement de l'adresse liée
        'rue' => $request->rue,
    ]);

    return redirect()->route('entreprises.index')->with('message', 'Entreprise créée avec succès.');
}

    public function edit($id)
    {
        // Récupérer l'entreprise, les adresses et les secteurs d'activité pour le formulaire d'édition
        $entreprise = Entreprise::findOrFail($id);
        $adresses = Adresse::all();
        $secteurs = SecteurActivite::all();
        return view('backend.entreprises.edit', compact('entreprise', 'adresses', 'secteurs'));
    }

    public function update(Request $request, $id)
{
    // Validation des données
    $request->validate([
        'code_entreprise' => 'required|unique:entreprises,code_entreprise,' . $id,
        'nom_entreprise' => 'required|string|max:100',
        'secteur_activite' => 'required|exists:secteurs_activite,id',
        'departement' => 'required|string',
        'commune' => 'required|string',
        'rue' => 'nullable|string|max:100',
    ]);

    // Récupération ou création de l'adresse
    $adresse = Adresse::firstOrCreate([
        'departement' => $request->departement,
        'commune' => $request->commune,
    ], [
        'code_postal' => $request->code_postal,
    ]);

    // Mise à jour de l'entreprise
    $entreprise = Entreprise::findOrFail($id);
    $entreprise->update([
        'code_entreprise' => $request->code_entreprise,
        'nom_entreprise' => $request->nom_entreprise,
        'secteur_activite_id' => $request->secteur_activite,
        'adresse_id' => $adresse->id,  // Mise à jour de l'adresse liée
        'rue' => $request->rue,
    ]);

    return redirect()->route('entreprises.index')->with('message', 'Entreprise mise à jour avec succès.');
}

    public function destroy($id)
    {
        // Suppression de l'entreprise
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();

        return redirect()->route('entreprises.index')->with('message', 'Entreprise supprimée avec succès.');
    }

    public function confirmDelete($id)
    {
        // Confirmer la suppression de l'entreprise
        $entreprise = Entreprise::findOrFail($id);
        return view('backend.entreprises.confirm_delete', compact('entreprise'));
    }

    public function getCommunes($departement)
    {
        // Récupérer les communes et codes postaux en fonction du département
        $communes = Adresse::where('departement', $departement)->get(['commune', 'code_postal']);
        return response()->json($communes);
    }
    
    public function getAdresse($id)
{
    $entreprise = Entreprise::with('adresse')->find($id);
    if ($entreprise && $entreprise->adresse) {
        $adresse = $entreprise->adresse->departement . ', ' . $entreprise->adresse->commune . ', ' . $entreprise->rue;
        return response()->json(['adresse' => $adresse]);
    }
    return response()->json(['adresse' => 'Adresse inconnue']);
}

}
