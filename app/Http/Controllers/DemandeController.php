<?php



namespace App\Http\Controllers;

use App\Models\Demande;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::all();
        return view('demandes.index', compact('demandes'));
    }
}
