<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestionnaireController extends Controller
{
    public function dashboard()
    {
        // Récupérer uniquement les données que le gestionnaire peut voir
        // Par exemple : commandes, clients, mais pas utilisateurs/admins

        $commandes = \App\Models\Commande::all(); // exemple
        // filtrer si besoin

        return view('gestionnaire.homedash', compact('commandes'));
    }
}
