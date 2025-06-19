<?php
namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;

class GestionnaireController extends Controller
{
    public function index()
    {
    $demandes = Demande::with(['user', 'equipements'])
        ->select('id', 'lieu', 'motif', 'statut', 'user_id', 'created_at', 'updated_at')
        ->where('statut', 'en_attente')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('gestionnaire.demandes.index', [
        'demandes' => $demandes,
        'gestionnaires' => User::where('role', 'gestionnaire')->get()
    ]);
    }
//     public function listDemandes()
//     {
//         $demandes = Demande::with(['user', 'equipements'])
//             ->where('statut', 'en_attente') // Filtrer par statut si nécessaire
//             ->latest()
//             ->get();
            
//         return view('gestionnaire.demandes.index', compact('demandes'));
//     }
    public function listeDemandes()
    {
        // Récupère toutes les demandes avec les attributs demandés
        $demandes = Demande::select('id', 'lieu', 'motif', 'statut', 'user_id', 'created_at', 'updated_at')
                        ->with('user') // Pour obtenir le nom de l'employé
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('gestionnaire.demandes.liste', compact('demandes'));
    }


    public function assignerDemande(Request $request, Demande $demande)
    {
        $request->validate([
            'gestionnaire_id' => 'required|exists:users,id'
        ]);
        
        $demande->update([
            'statut' => 'assignée',
            'gestionnaire_id' => $request->gestionnaire_id
        ]);
        
        return back()->with('success', 'Demande assignée avec succès');
    }
}