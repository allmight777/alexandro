<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affectation;
use App\Models\Equipement;
use App\Models\User;


class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $affectations = Affectation::with(['equipement', 'user'])->get();
        return view('gestionnaire.affectations.index', compact('affectations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipements = Equipement::where('etat', 'disponible')->get();
        $employes = User::where('role', 'employe')->get();

        return view('gestionnaire.affectations.create', compact('equipements', 'employes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'equipement_id' => 'required|exists:equipements,id',
            'user_id' => 'required|exists:users,id',
            'date_affectation' => 'required|date',
            'date_retour' => 'nullable|date|after_or_equal:date_affectation',
        ]);

        Affectation::create($request->all());

        // Marquer l'équipement comme indisponible
        $equipement = Equipement::find($request->equipement_id);
        $equipement->disponible = false;
        $equipement->save();

        return redirect()->back()->with('success', 'Équipement affecté avec succès.');


        // return redirect()->route('gestionnaire.affectations.index')->with('success', 'Équipement affecté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
