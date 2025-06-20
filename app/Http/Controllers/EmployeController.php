<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Equipement;
use App\Models\EquipementDemandé;
use App\Models\Panne;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeController extends Controller
{
    //
    public function index()
    {
        // ou toute autre variable que tu veux passer
        $user = Auth::user();
        $demandes = Demande::all();


        return view('employee.layouts.main', [
            'user' => $user,
            'demandes' => $demandes,
        ]);
    }
    public function ShowAskpage()
    {
        $equipements = Equipement::all();
        $user = Auth::user();
        return view("employee.layouts.askpage", compact('user', 'equipements'));
    }
    public function SubmitAsk(Request $request)
    {
        $user = Auth::user();
        $demande = new Demande();
        $demande->lieu = $request->lieu;
        $demande->motif = $request->motif;
        $demande->user_id = $user->id;
        if ($demande->save()) {
            $equipements = $request->equipements;
            $quantity = $request->quantites;
            foreach ($equipements as $index => $equipement_id) {
                $qte = $quantity[$index];
                $equipements_ask = new EquipementDemandé();
                $equipements_ask->demande_id = $demande->id;
                $equipements_ask->equipement_id = $equipement_id;
                $equipements_ask->nbr_equipement = $qte;
                $equipements_ask->save();
            }
            return back()->with("success", "Demande envoyé avec succès");
        }
    }
    public function signalerPanne() {
        $user = Auth::user();
        $equipements_user=$user->equipements;
        return view ("employee.layouts.panne",compact("user","equipements_user"));
    }

   public function HandlePanne(Request $request){
     $user=Auth::user();  
     $panne=new Panne();
     $panne->equipement_id=$request->equipement_id;
     $panne->user_id=$user->id;
     $panne->description=$request->description;
     $panne->save();
     return redirect()->back()->with("success","Panne siagnlée avec succès");


   }
    public function equipementsAssignes()
    {
        $user = Auth::user();       
        $equipements = $user->equipement;
        return view("employee.layouts.assign", compact("user", "equipements"));
    }
}
