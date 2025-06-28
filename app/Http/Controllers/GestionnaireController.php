<?php
namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use App\Models\Panne;
use App\Models\Equipement;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Affectation;
use Carbon\Carbon;
use App\Models\CollaborateurExterne;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Bon;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;




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

    public function equipementsPerdus()
    {
        $equipement_lost = Affectation::with(['equipement', 'user'])
            ->whereDate('date_retour', '<', Carbon::today())
            // ->whereNull('date_retour_effectif') // Ajoute ce champ si besoin
            ->get();

        return view('gestionnaire.tools.lost_tools', compact('equipement_lost'));
    }

    public function retournerEquipement($id)
    {
        $affectation = Affectation::findOrFail($id);
        // $affectation->date_retour_effectif = Carbon::now();
        $affectation->save();

        $equipement = $affectation->equipement;
        if ($equipement) {
            $equipement->etat = 'disponible';
            $equipement->save();
        }

        return redirect()->route('gestionnaire.equipements.perdus')->with('success', 'Équipement marqué comme retourné.');
    }





    // public function dashboard()
    // {
    //     $totalEquipements = Equipement::count();
    //     $equipementsAffectes = Equipement::whereNotNull('affecte_a')->count();
    //     $utilisateursActifs = User::count();

    //     return view('gestionnaire.homedash', compact(
    //         'totalEquipements',
    //         'equipementsAffectes',
    //         'utilisateursActifs'
    //     ));
    // }

    
    // public function dashboard()
    // {
    //     $totalEquipements = Equipement::count();
    //     $equipementsAffectes = Affectation::count();
    //     $utilisateursActifs = User::where('statut', 'actif')->count(); // à adapter si le champ diffère

    //     return view('gestionnaire.homedash', [
    //     'totalEquipements'=> $totalEquipements,
    //     'equipementsAffectes'=> $equipementsAffectes,
    //     'utilisateursActifs'=>$utilisateursActifs
    //     ]);
    // }

    public function dashboard()
    {
        $totalEquipements = Equipement::count();
        $equipementsAffectes = Affectation::count();
        // $utilisateursActifs = User::where(column: 'statut', 'actif')->count(); // modifie le champ 'statut' si besoin

        return view('gestionnaire.homedash', compact(
            'totalEquipements',
            'equipementsAffectes'
            // 'utilisateursActifs'
        ));
    }

// ---------------------------------------pannes-------------------------------

    public function voirPannes()
    {
        $pannes = Panne::where('statut', 'en_attente')
            ->with(['equipement', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gestionnaire.pannes.index', compact('pannes'));
    }

    public function PutPanne(Panne $panne)
    {
        \Log::info("PutPanne appelée pour panne #{$panne->id}");

        // Ou un dd() pour déboguer (bloque l'exécution)
        // dd("PutPanne appelée pour panne #{$panne->id}");

        $panne->statut = 'resolu';
        $panne->save();

        return redirect()->back()->with('success', 'Panne marquée comme résolue.');
    }


// // -------------------------------------------------Bons------------------------------------------------------------------------
//     public function showBonForm()
//     {
//         $collaborateurs = CollaborateurExterne::all();
//         return view('gestionnaire.bons.bon_external_collaborator', compact('collaborateurs'));
//     }

    // Traiter la soumission du formulaire
public function showBonForm()
{
    $collaborateurs = CollaborateurExterne::all();
    return view('gestionnaire.bons.bon_external_collaborator', compact('collaborateurs'));
}

// Traite le formulaire et retourne la même page avec succès et pdf
public function handleBon(Request $request)
{
    $request->validate([
        'collaborateur_id' => 'required|exists:collaborateur_externes,id',
        'motif' => 'required|string',
        'type' => 'required|in:entrée,sortie',
    ]);

    $bon = Bon::create([
        'user_id' => $request->collaborateur_id,
        'motif' => $request->motif,
        'statut' => $request->type,
    ]);

    $pdf = Pdf::loadView('gestionnaire.bons.pdf_bon', compact('bon'));

    $pdfPath = 'pdf_bons/bon_' . $bon->id . '.pdf';
    $pdf->save(public_path('storage/' . $pdfPath));

    return view('gestionnaire.bons.bon_external_collaborator', [
        'collaborateurs' => CollaborateurExterne::all()
    ])->with('success', 'Bon généré avec succès.')
      ->with('pdf', asset('storage/' . $pdfPath));
}

// ---------------------------------------------Equipement retourné---------------------------------------------

public function BackTool(Affectation $affectation)
  {
    $affectation->date_retour = now();
    $affectation->save();

    $equipement = $affectation->equipement;
    $equipement->quantite += $affectation->quantite_affectee;
    $equipement->etat = "disponible";
    $equipement->save();
    $user = $affectation->user;

    $pdfName = 'retour_perdu_' . $equipement->id . '.pdf';
    $pdfPath = 'retour_perdu/' . $pdfName;

    $pdf = Pdf::loadView('pdf.retour_perdu', [
      'date' => now(),
      'nom' => $user->nom,
      'prenom' => $user->prenom,
      'equipement' => $equipement->nom,
    ]);

    Storage::disk('public')->put($pdfPath, $pdf->output());

    return redirect()->back()
      ->with('success', 'Retour du matériel effectué. Un PDF de confirmation a été généré.')
      ->with('pdf', asset('storage/' . $pdfPath));
  }


// --------------------------------------------------------collaborateurs-----------------------------------------------

    // Affiche le formulaire
    public function createCollaborateur()
    {
        return view('gestionnaire.collaborateurs.collaborator_external');
    }

    // Enregistre un collaborateur
    public function storeCollaborateur(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'chemin_carte' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $chemin = $request->file('chemin_carte')->store('cartes_identite', 'public');

        CollaborateurExterne::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'carte_chemin' => $chemin,
        ]);

        return redirect()->route('gestionnaire.collaborateurs.index')->with('success', 'Collaborateur ajouté avec succès.');
    }

    // Liste des collaborateurs
    public function listCollaborateurs()
    {
        $collaborateurs = CollaborateurExterne::all();
        return view('gestionnaire.collaborateurs.list_collaborator', compact('collaborateurs'));
    }



        public function destroyCollaborateur($id)
    {
        $collaborateur = CollaborateurExterne::findOrFail($id);

        // Supprimer le fichier de la carte d'identité si besoin
        if ($collaborateur->carte_chemin && \Storage::disk('public')->exists($collaborateur->carte_chemin)) {
            \Storage::disk('public')->delete($collaborateur->carte_chemin);
        }

        $collaborateur->delete();

        return redirect()->route('gestionnaire.collaborateurs.index')->with('success', 'Collaborateur supprimé avec succès.');
    }
// -----------------------------------------demaneds-----------------------------------------


    // public function listeDemandes()
    // {
    //     // Récupère toutes les demandes avec les attributs demandés
    //     $demandes = Demande::select('id', 'lieu', 'motif', 'statut', 'user_id', 'created_at', 'updated_at')
    //                     ->with('user') // Pour obtenir le nom de l'employé
    //                     ->orderBy('created_at', 'desc')
    //                     ->get();

    //     return view('gestionnaire.demandes.liste', compact('demandes'));
    // }


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


        public function ShowAllAsk()
        {
            $demandes = Demande::with('equipements')->where("statut", "en_attente")->latest()->get();
            return view("gestionnaire.demandes.liste", compact("demandes"));
        }

    // Accepter une demande
    public function CheckAsk(Demande $demande)
    {
        $demande->statut = "acceptee";
        $demande->save();
        return redirect()->back()->with('success', 'Demande acceptée.');
    }

    // Rejeter une demande
    public function CancelAsk(Demande $demande)
    {
        $demande->statut = "rejetee";
        $demande->save();
        return redirect()->back()->with('success', 'Demande rejetée.');
    }

    public function LoadingAsk(Demande $demande)
    {
    $demande->statut = "en_attente";
    $demande->save();
    return redirect()->back();
  }

// ------------------------------------------------------------------------------------------------------------
    public function CollaboratorsPage()
    {
        return view('gestionnaire.collaborateurs.collaborator_external');
    }

    public function HandleCollaborator(Request $request)
    {
    // Logique de traitement
    }

    public function ShowListCollaborator()
    {   
    $collaborateurs = collaborateur_externes::all();
    return view('gestionnaire.collaborateurs.collaborator_external', compact('collaborateurs'));
    }

    public function destroy(collaborateur_externes $collaborateur)
    {
    $collaborateur->delete();
    return back()->with('success', 'Collaborateur supprimé avec succès');
    }   
    
//   public function HandleAffectation(Request $request)
//   {
//     DB::beginTransaction(); // start transaction

//     try {
//       //Enregistrer les affectations d'équipements
//       foreach ($request->equipements as $index => $equipement_id) {
//         $affectation = new Affectation();
//         $affectation->equipement_id = $equipement_id;
//         $affectation->date_retour = $request->dates_retour[$index];
//         $affectation->user_id = $request->employe_id;
//         $equipementChange = Equipement::where("id", "=", $equipement_id)->first();
//         $equipementChange->etat = "usagé";
//         $equipementChange->save();
//         $affectation->save();
//       }


//       // 
//       $bon = new Bon();
//       $bon->user_id = $request->employe_id;
//       $bon->motif = $request->motif;
//       $bon->statut = "sortie";
//       $bon->save();

//       DB::commit();
//       return redirect()->back()->with("success", "Affectation réussie avec succès");
//      } catch (\Exception $e) {
//       DB::rollBack(); //
//       return redirect()->back()->with("error", "Une erreur est survenue : " . $e->getMessage());
//      } 
//     }

//   public function HandleAffectation(Request $request)
//   {
//     set_time_limit(120);
//     DB::beginTransaction();
//     $user = Auth::user();

//     try {
//       // Charger les équipements en bulk
//       $equipementIds = $request->equipements;
//       $equipements = Equipement::whereIn('id', $equipementIds)->get()->keyBy('id');
//       $affectationsDetails = [];
//       foreach ($request->equipements as $index => $equipement_id) {
//         $quantite = $request->quantites[$index] ?? 1;
//         $rawDate = $request->dates_retour[$index] ?? null;

//         $equipement = $equipements->get($equipement_id);

//         // if (!$equipement) {
//         //   throw new \Exception("Équipement ID $equipement_id introuvable.");
//         // }

//         // if ($equipement->quantite < $quantite) {
//         //   throw new \Exception("Quantité insuffisante pour l'équipement « {$equipement->nom} » (disponible : {$equipement->quantite}, demandée : {$quantite}).");
//         // }



// // ----------------------------------------------------------------------------------------------------------------
// // ---------------------------------------autres essais pour rendre jolie le texte d'erreur---------------------------
//         try {
//             if (!$equipement) {
//                 throw new \Exception("❗ ERREUR : ÉQUIPEMENT ID $equipement_id INTRROUVABLE !");
//             }

//             if ($equipement->quantite < $quantite) {
//                 throw new \Exception("⚠️ QUANTITÉ INSUFFISANTE pour l’équipement « {$equipement->nom} » (DISPONIBLE : {$equipement->quantite}, DEMANDÉE : {$quantite}).");
//             }

//             // Le reste du traitement ici...

//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', $e->getMessage());
//         }


//         $affectation = new Affectation();
//         $affectation->equipement_id = $equipement_id;
//         $affectation->user_id = $request->employe_id;
//         $affectation->date_retour = $rawDate ?: null;
//         $affectation->created_by = $user->nom . ' ' . $user->prenom;
//         $affectation->quantite_affectee = $quantite;
//         $affectation->save();

//         $equipement->quantite -= $quantite;
//         $equipement->etat = ($equipement->quantite > 0) ? "disponible" : "usagé";
//         $equipement->save();
//         $affectationsDetails[] = [
//           'nom' => $equipement->nom,
//           'reference' => $equipement->reference ?? '',
//           'quantite' => $quantite,
//         ];
//       }

//       $bon = new Bon();
//       $bon->user_id = $request->employe_id;
//       $bon->motif = $request->motif;
//       $bon->statut = "sortie";
//       $pdfName = 'bon_sortie_' . $request->employe_id . '_' . now()->timestamp . '.pdf';
//       $pdfPath = 'bon_sortie/' . $pdfName;
//       $bon->fichier_pdf = $pdfPath;
//       $bon->save();

//       DB::commit();

//       $employe = User::find($request->employe_id);


//       $pdf = Pdf::loadView('pdf.bon', [
//         'date' => now()->format('d/m/Y'),
//         'nom' => $employe->nom ?? 'Admin',
//         'prenom' => $employe->prenom ?? '',
//         'motif' => $request->motif,
//         'numero_bon' => $bon->id,
//         'type' => $bon->statut,
//         'equipements' => $affectationsDetails, 
//       ]);

//       Storage::disk('public')->put($pdfPath, $pdf->output());

//       return redirect()->back()
//         ->with('success', 'Affectation réussie avec succès et un bon de sortie a été généré.')
//         ->with('pdf', asset('storage/' . $pdfPath));
//     } catch (\Exception $e) {
//       DB::rollBack();
//       Log::error("Erreur lors de l'affectation : " . $e->getMessage());
//       return redirect()->back()->with("error", $e->getMessage());
//     }
//   }

public function HandleAffectation(Request $request)
  {
    $request->validate([
       'equipements'=>'required',
       'quantites'=>'required'
    ],[
      'equipements.required'=>'le champ equipement est requis',
       'quantites.required'=>'le champ quantité est requis'
    ]);


    set_time_limit(120);
    DB::beginTransaction();
    $user = Auth::user();

    try {
      // Charger les équipements en bulk
      $equipementIds = $request->equipements;
      $equipements = Equipement::whereIn('id', $equipementIds)->get()->keyBy('id');
      $affectationsDetails = [];
      foreach ($request->equipements as $index => $equipement_id) {
        $quantite = $request->quantites[$index] ?? 1;
        $rawDate = $request->dates_retour[$index] ?? null;

        $equipement = $equipements->get($equipement_id);

        if (!$equipement) {
          throw new \Exception("Équipement ID $equipement_id introuvable.");
        }

        if ($equipement->quantite < $quantite) {
          throw new \Exception("Quantité insuffisante pour l'équipement « {$equipement->nom} » (disponible : {$equipement->quantite}, demandée : {$quantite}).");
        }

        $affectation = new Affectation();
        $affectation->equipement_id = $equipement_id;
        $affectation->user_id = $request->employe_id;
        $affectation->date_retour = $rawDate ?: null;
        $affectation->created_by = $user->nom . ' ' . $user->prenom;
        $affectation->quantite_affectee = $quantite;
        $affectation->save();

        $equipement->quantite -= $quantite;
        $equipement->etat = ($equipement->quantite > 0) ? "disponible" : "usagé";
        $equipement->save();
        $affectationsDetails[] = [
          'nom' => $equipement->nom,
          'reference' => $equipement->reference ?? '',
          'quantite' => $quantite,
        ];
      }

      $bon = new Bon();
      $bon->user_id = $request->employe_id;
      $bon->motif = $request->motif;
      $bon->statut = "sortie";
      $pdfName = 'bon_sortie_' . $request->employe_id . '_' . now()->timestamp . '.pdf';
      $pdfPath = 'bon_sortie/' . $pdfName;
      $bon->fichier_pdf = $pdfPath;
      $bon->save();

      DB::commit();

      $employe = User::find($request->employe_id);


      $pdf = Pdf::loadView('pdf.bon', [
        'date' => now()->format('d/m/Y'),
        'nom' => $employe->nom ?? 'Admin',
        'prenom' => $employe->prenom ?? '',
        'motif' => $request->motif,
        'numero_bon' => $bon->id,
        'type' => $bon->statut,
        'equipements' => $affectationsDetails, 
      ]);

      Storage::disk('public')->put($pdfPath, $pdf->output());

      return redirect()->back()
        ->with('success', 'Affectation réussie avec succès et un bon de sortie a été généré.')
        ->with('pdf', asset('storage/' . $pdfPath));
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error("Erreur lors de l'affectation : " . $e->getMessage());
      return redirect()->back()->with("error", $e->getMessage());
    }
  }


}