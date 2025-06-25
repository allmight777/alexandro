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


    public function voirPannes()
    {
            $pannes = DB::table('pannes')
            ->join('equipements', 'pannes.equipement_id', '=', 'equipements.id')
            ->join('users', 'pannes.user_id', '=', 'users.id')
            ->select(
                'pannes.description',
                'pannes.created_at',
                'equipements.nom as nom_equipement',
                'users.nom as user_nom',
                'users.prenom as user_prenom'
            )
            ->orderBy('pannes.created_at', 'desc')
            ->get();

        return view('gestionnaire.pannes.index', compact('pannes'));
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
    
  public function HandleAffectation(Request $request)
  {
    DB::beginTransaction(); // start transaction

    try {
      //Enregistrer les affectations d'équipements
      foreach ($request->equipements as $index => $equipement_id) {
        $affectation = new Affectation();
        $affectation->equipement_id = $equipement_id;
        $affectation->date_retour = $request->dates_retour[$index];
        $affectation->user_id = $request->employe_id;
        $equipementChange = Equipement::where("id", "=", $equipement_id)->first();
        $equipementChange->etat = "usagé";
        $equipementChange->save();
        $affectation->save();
      }


      // 
      $bon = new Bon();
      $bon->user_id = $request->employe_id;
      $bon->motif = $request->motif;
      $bon->statut = "sortie";
      $bon->save();

      DB::commit();
      return redirect()->back()->with("success", "Affectation réussie avec succès");
     } catch (\Exception $e) {
      DB::rollBack(); //
      return redirect()->back()->with("error", "Une erreur est survenue : " . $e->getMessage());
     } 
    }

}