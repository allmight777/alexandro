<?php



namespace App\Http\Controllers;

use App\Models\Demande;

class DemandeController extends Controller
{
 
    public function index()
    {
    $demandes = Demande::with(['user', 'EquipementsDemandé.equipement'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('gestionnaire.demandes.index', compact('demandes'));
    }

}
