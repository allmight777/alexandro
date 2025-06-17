<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Equipement;
use App\Models\EquipementDemandé;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeController extends Controller
{
    //
   public function index()
    {
        // ou toute autre variable que tu veux passer
        $user = Auth::user();
        $demandes=Demande::all();
        return view('employee.layouts.main', [
            'user' => $user,
            'demandes'=>$demandes,
        ]);
    }
    public function ShowAskpage(){
        $equipements= Equipement::where('etat', 'Disponible')->get();
        $user = Auth::user();
        return view("employee.layouts.askpage",compact('user','equipements'));
    }
    public function SubmitAsk(Request $request){
        $user=Auth::user();
        $demande=new Demande();
        $demande->lieu=$request->lieu;
        $demande->motif=$request->motif;
        $demande->user_id=$user->id;
        $demande->save();
        if($demande->save()){
            $equipements=$request->equipements;
            $quantity=$request->quantites;
            foreach($equipements as $index=>$equipement_id){
              $qte=$quantity[$index];
              $equipements_ask=new EquipementDemandé();
              $equipements_ask->demande_id=$demande->id;
              $equipements_ask->equipement_id=$equipement_id;
              $equipements_ask->nbr_equipement=$qte;
              $equipements_ask->save();
            }
            return back()->with("success","Demande envoyé avec succès");
        }  

    }
    public function signalerPanne()  {
       
    }
    public function equipementsAssignes(){
        
    }
    

}
