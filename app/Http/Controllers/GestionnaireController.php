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