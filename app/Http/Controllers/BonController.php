<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollaborateurExterne;
use Illuminate\Support\Facades\Storage;

class BonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $bons = Bon::all();
        return view('gestionnaire.bons.index', compact('bons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function showExternalCollaboratorForm()
    {
        $collaborateurs = CollaborateurExterne::all();
        return view('gestionnaire.bons.bon_external_collaborator', compact('collaborateurs'));
    }

    public function handleExternalBon(Request $request)
    {
        $request->validate([
            'collaborateur_id' => 'required|exists:collaborateur_externes,id',
            'motif' => 'required|string|max:500',
            'type' => 'required|in:entrée,sortie'
        ]);
        // Logique de génération du bon PDF
        $pdfPath = $this->generateBonPdf($request->all());
    
        return back()
            ->with('success', 'Bon généré avec succès')
            ->with('pdf', Storage::url($pdfPath));
    }

    private function generateBonPdf($data)
    {
    // Implémentez votre logique de génération PDF ici
    // Retournez le chemin du fichier généré
    
    // Exemple simplifié:
        $filename = 'bon_collab_'.$data['collaborateur_id'].'_'.time().'.pdf';
        $path = 'bons/'.$filename;
    
    // Ici vous devriez utiliser une librairie PDF comme DomPDF
    // Storage::put($path, $pdfContent);
    
        return $path;
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
