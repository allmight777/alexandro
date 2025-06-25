<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Categorie; // Ajoutez cette ligne

class EquipementController extends Controller
{
    // Affiche le formulaire d'ajout
    // public function create()
    // {
    //     $categories = Categorie::all(); // Utilisation directe sans \
    //     return view('gestionnaire.equipements.create', compact('categories'));
    // }

    public function create()
    {
        //  $this->authorize('create', Equipement::class); // Ajoutez cette ligne
         $categories = Categorie::all();
         return view('gestionnaire.tools.addtool', compact('categories'));
    }

    public function index() {
        // $equipements = Equipement::with('categorie')->get();
        $equipements = Equipement::with('categorie')->paginate(10);
        return view('gestionnaire.tools.listtools', compact('equipements'));
    }


    public function edit($id) {
         $equipement = Equipement::findOrFail($id);
         return view('gestionnaire.tools.puttools', compact('equipement'));
    }


    public function update(Request $request, $id) {
        $equipement = Equipement::findOrFail($id);
        $equipement->update($request->all());
        return redirect()->route('gestionnaire.tools.list')->with('success', 'Équipement modifié.');
    }

    // Enregistre un nouvel équipement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'etat' => 'required|in:neuf,utilisé,en panne'
        ]);

         // Création de l’équipement
        Equipement::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'categorie_id' => $request->categorie_id,
             'etat' => 'required|in:neuf,utilisé,en panne'
            // Ajoute les autres champs
        ]);

        // Redirection avec message de succès
        return redirect()->route('gestionnaire.tools.list')->with('success', 'Équipement ajouté avec succès !');

    } 

    public function put(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie' => 'required|string|max:255',
            'statut' => 'required|string|in:Disponible,Indisponible',
        ]);

        $equipement = Equipement::findOrFail($id);
        $equipement->update($validated);

        return redirect()->route('gestionnaire.tools.list')
                         ->with('success', 'Équipement mis à jour avec succès.');
}
    
    public function showPanne()
    {
    // Récupère uniquement les équipements avec état = 'panne'
    // $equipements = Equipement::where('etat', 'panne')->get();
     $pannes = Equipement::where('etat', 'panne')->get();

    // return view('gestionnaire.tools.pannelist', compact(var_name: 'equipements'));
        return view('gestionnaire.tools.pannelist', compact('pannes'));


    }
}