<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Categorie;
use App\Models\Demande;
use App\Models\Equipement;
use App\Models\EquipementDemandé;
use App\Models\Panne;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmployeController extends Controller
{
    //
    public function index()
    {
        // ou toute autre variable que tu veux passer
        $user = Auth::user();
        $demandes = Demande::orderBy('created_at', 'desc')
            ->where('user_id','=', $user->id)
            ->get()->take(3);
        $nbr_accept=Demande::where('user_id','=', $user->id)
            ->where('statut',"=",'acceptee')
            ->count();
        $nbr_en_attente=Demande::where('user_id', '=', $user->id)
            ->where('statut',"=",'en_attente')
            ->count();
        $nbr_non_resolue=Panne::where('user_id', '=', $user->id)
                               ->where('statut','!=','resolu')
                               ->count()
                               ;
        $nbr_assign= Affectation::with('equipement')
            ->where('user_id',"=", $user->id)
            ->count();

        $affectations = Affectation::with('equipement')
            ->where('user_id',"=", $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        $pannes = Panne::with("equipement")->where('user_id', "=", $user->id)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        

        return view('employee.layouts.main', [
            'user' => $user,
            'demandes' => $demandes,
            'affectations' => $affectations,
            'pannes' => $pannes,
            'nbr_accept'=>$nbr_accept,
            'nbr_en_attente'=>$nbr_en_attente,
            'nbr_non_resolue'=>$nbr_non_resolue,
            'nbr_assign'=> $nbr_assign
        ]);
    }
    public function ShowAskpage()
    {
        $equipements_par_categorie = Categorie::with("equipements")->get();
        $user = Auth::user();
        return view("employee.layouts.askpage", compact('user', 'equipements_par_categorie'));
    }
    public function SubmitAsk(Request $request)
    {
        $request->validate([
            'lieu' => 'required',
            'motif' => 'required',
            'quantites' => 'required',
            'equipements' => 'required'
        ], [
            'lieu.required' => 'Le lieu est requis',
            'motif.required' => 'Le motif est requis',
            'quantites.required' => 'Une quanitée est requise pour votre demande',
            'equipements.required' => 'Un equipements est requis pour la demande'
        ]);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $demande = new Demande();
            $demande->lieu = $request->lieu;
            $demande->motif = $request->motif;
            $demande->user_id = $user->id;
            $demande->statut = "en_attente";
            $demande->save();
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
            DB::Commit();
            return back()->with("success", "Demande envoyé avec succès");
        } catch (\Throwable $e) {
            Log::error('Erreur lors de la soumission de la demande : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de l’envoi de la demande.');
        }
    }
    public function signalerPanne()
    {
        $user = Auth::user();
        $equipements_user = Affectation::where('user_id', $user->id)
        ->whereNull('statut') // optionnel si on veut exclure les équipements déjà retournés
        ->with('equipement')
        ->get()
        ->pluck('equipement');
        return view("employee.layouts.panne", compact("user", "equipements_user"));
    }

    public function HandlePanne(Request $request)
    {
        $user = Auth::user();

        // Enregistrer la panne
        $panne = new Panne();
        $panne->equipement_id = $request->equipement_id;
        $panne->user_id = $user->id;
        $panne->description = $request->description;
        $panne->save();

        // Mettre à jour l'état de l'équipement à 'panne'
        $equipement = Equipement::find($request->equipement_id);
        if ($equipement) {
            $equipement->etat = 'en_panne';
            $equipement->save();
        }

        return redirect()->back()->with("success", "Panne signalée avec succès");
    }



    //    public function HandlePanne(Request $request){
    //      $user=Auth::user();  
    //      $panne=new Panne();
    //      $panne->equipement_id=$request->equipement_id;
    //      $panne->user_id=$user->id;
    //      $panne->description=$request->description;
    //      $panne->save();
    //      return redirect()->back()->with("success","Panne siagnlée avec succès");


    //    }
    public function equipementsAssignes()
    {
        $user = Auth::user();
        $affectation = Affectation::with("equipement")
            ->where('user_id',"=",$user->id)
            ->paginate(4)
            ; // pagination réelle des équipements
        return view("employee.layouts.assign", compact("user", "affectation"));
    }
    public function Helppage()
    {
        $user = Auth::user();
        return view("employee.layouts.help", compact('user'));
    }
    public function HandleHelp(Request $request)
    {
        $request->validate([
            'message' => 'required|min:10'
        ]);

        // Email de l'admin
        $adminEmail = "xandrotech66@gmail.com"; // Ou .env('ADMIN_EMAIL')

        Mail::send('emails.aide', [
            'email' => Auth::user()->email,
            'body' => $request->message
        ], function ($mail) use ($adminEmail) {
            $mail->to($adminEmail)
                ->subject('Demande d’aide d’un employé');
        });

        return back()->with('success', 'Votre message a été envoyé à l’administrateur.');
    }
    //recuperation directe du modele + action(Ex:suppression)
    public function DeletePanne(Panne $panne)
    {
        $panne->delete();
        return redirect()->back();
    }
    public function DeleteAffect(Affectation $affectation)
    {
        $affectation->delete();
        return redirect()->back();
    }
    public function DeleteAsk(Demande $demande)
    {
        $demande->delete();
        return redirect()->back();
    }
    public function ShowPannes()
    {
        $user = Auth::user();
        $pannes = Panne::with('equipement')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view("employee.layouts.pannelist", compact("pannes", "user"));
    }
    public function ShowDemandes()
    {
        $user = Auth::user();
        $demandes = Demande::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(5);

        return view("employee.layouts.list_demandes", compact('user', 'demandes'));
    }
}
