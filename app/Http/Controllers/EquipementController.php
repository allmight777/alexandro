<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Categorie;

class EquipementController extends Controller
{
    // Affiche le formulaire d'ajout
    public function create()
    {
        $categories = Categorie::all();
        return view('gestionnaire.tools.addtool', compact('categories'));
    }

    // Affiche la liste des équipements
    public function index()
    {
        $equipements = Equipement::with('categorie')->paginate(10);
        return view('gestionnaire.tools.listtools', compact('equipements'));
    }

    // Affiche le formulaire de modification
    public function edit($id)
    {
        $equipement = Equipement::findOrFail($id);
        $categories = Categorie::all();
        return view('gestionnaire.tools.addtool', compact('equipement', 'categories'));
    }

    // Enregistre un nouvel équipement
    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required|string|max:255',
            'etat' => 'required',
            'categorie' => 'required|string',
            'description' => 'nullable|string',
            'marque' => 'nullable|string',
            'quantite' => 'required|integer|min:1',
            'date_acquisition' => 'nullable|date',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $equipement = new Equipement();
        $equipement->nom = $request->nom;
        $equipement->etat = $request->etat;
        $equipement->marque = $request->marque;
        $equipement->description = $request->description;
        $equipement->quantite = $request->quantite;
        $equipement->date_acquisition = $request->date_acquisition;

        $categorie = Categorie::where('nom', $request->categorie)->first();
        if ($categorie) {
            $equipement->categorie_id = $categorie->id;
        }

        if ($request->hasFile('image_path')) {
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('uploads'), $imageName);
            $equipement->image_path = 'uploads/' . $imageName;
        }

        $equipement->save();

        return redirect()->back()->with('success', 'Équipement ajouté avec succès !');
    }

    // Met à jour un équipement existant
    public function update(Request $request, $id)
    {
        $equipement = Equipement::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'etat' => 'required',
            'categorie' => 'required|string',
            'description' => 'nullable|string',
            'marque' => 'nullable|string',
            'quantite_disponible' => 'required|integer|min:1',
            'date_acquisition' => 'nullable|date',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $equipement->nom = $request->nom;
        $equipement->etat = $request->etat;
        $equipement->marque = $request->marque;
        $equipement->description = $request->description;
        $equipement->quantite_disponible = $request->quantite_disponible;
        $equipement->date_acquisition = $request->date_acquisition;

        $categorie = Categorie::where('nom', $request->categorie)->first();
        if ($categorie) {
            $equipement->categorie_id = $categorie->id;
        }

        if ($request->hasFile('image_path')) {
            if ($equipement->image_path && file_exists(public_path($equipement->image_path))) {
                unlink(public_path($equipement->image_path));
            }

            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('uploads'), $imageName);
            $equipement->image_path = 'uploads/' . $imageName;
        }

        $equipement->save();

        return redirect()->route('gestionnaire.tools.list')->with('success', 'Équipement modifié avec succès.');
    }

    // Supprime un équipement
    public function destroy($id)
    {
        $equipement = Equipement::findOrFail($id);

        if ($equipement->image_path && file_exists(public_path($equipement->image_path))) {
            unlink(public_path($equipement->image_path));
        }

        $equipement->delete();

        return redirect()->back()->with('success', 'Équipement supprimé avec succès.');
    }

    // Affiche les équipements en panne
    public function showPanne()
    {
        $pannes = Equipement::where('etat', 'panne')->get();
        return view('gestionnaire.tools.pannelist', compact('pannes'));
    }
}
