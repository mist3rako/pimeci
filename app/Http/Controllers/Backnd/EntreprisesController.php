<?php

namespace App\Http\Controllers\Backnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Adresse;
use App\Models\SecteurActivite;
use Illuminate\Support\Facades\Auth;

class EntreprisesController extends Controller
{
    /**
     * Affiche la liste paginée des entreprises avec leurs relations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Charger les entreprises avec leurs relations et appliquer la pagination
        $entreprises = Entreprise::with(['adresse', 'secteurActivite'])->paginate(10); // Paginer par 10 entreprises par page

        return view('backnd.entreprises.entreprises', compact('entreprises'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle entreprise.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Charger toutes les adresses et secteurs d'activité pour les dropdowns
        $adresses = Adresse::all();
        $secteurs = SecteurActivite::all();

        return view('backnd.entreprises.create', compact('adresses', 'secteurs'));
    }

    /**
     * Valide et enregistre une nouvelle entreprise dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        $adresse = Adresse::firstOrCreate(
            [
                'departement' => $request->departement,
                'commune' => $request->commune,
            ],
            [
                'code_postal' => $request->code_postal,
            ]
        );

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

    /**
     * Affiche le formulaire d'édition d'une entreprise existante.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Récupérer l'entreprise, les adresses et les secteurs d'activité pour le formulaire d'édition
        $entreprise = Entreprise::findOrFail($id);
        $adresses = Adresse::all();
        $secteurs = SecteurActivite::all();

        return view('backnd.entreprises.edit', compact('entreprise', 'adresses', 'secteurs'));
    }

   /**
     * Valide et met à jour une entreprise existante dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
        $adresse = Adresse::firstOrCreate(
            [
                'departement' => $request->departement,
                'commune' => $request->commune,
            ],
            [
                'code_postal' => $request->code_postal,
            ]
        );

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

    /**
     * Supprime une entreprise de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Suppression de l'entreprise
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();

        return redirect()->route('entreprises.index')->with('message', 'Entreprise supprimée avec succès.');
    }

    

    /**
     * Affiche une confirmation avant la suppression d'une entreprise.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function confirmDelete($id)
    {
        // Récupérer l'entreprise pour la confirmation de suppression
        $entreprise = Entreprise::findOrFail($id);

        return view('backnd.entreprises.confirm_delete', compact('entreprise'));
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
