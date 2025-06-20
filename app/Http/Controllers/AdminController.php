<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Http\Requests\UpdateEquipementRequest;
use App\Models\Affectation;
use App\Models\Bon;
use App\Models\Categorie;
use App\Models\CollaborateurExterne;
use App\Models\Demande;
use App\Models\Equipement;
use App\Models\Panne;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
  public function showusers()
  {
    $users = User::where("role", "!=", "admin")->get();
    return view("admin.listuserpage", compact("users"));
  }
  public function edituserpage(User $user)
  {
    return view("admin.edit_user", compact('user'));
  }

  public function deleteuser(User $user)
  {
    $user->delete();
    return redirect()->back();
  }

  //
  public function ModifyUser(EditRequest $request, User $user)
  {
    $user->nom = $request->nom;
    $user->prenom = $request->prenom;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->service = $request->service;
    $user->poste = $request->poste;

    // Ne modifier le mot de passe que s'il est rempli
    if ($request->filled('password')) {
      $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->back()->with("succès", "Utilisateur modifié avec succès");
  }
  public function addToolpage()
  {
    $categories = Categorie::all();

    return view("admin.addtool", compact("categories"));
  }
  public function addTool(Request $request)
  {
    $request->validate([
      'nom' => 'required|string|max:255',
      'etat' => 'required|in:disponible,usagé,en panne,réparé',
      'marque' => 'string|max:255',
      'categorie' => 'required|string|exists:categories,nom',
      'description' => 'required|string',
      'date_acquisition' => 'required|date',
      'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    $equipement = new Equipement();
    $equipement->nom = $request->nom;
    $equipement->etat = $request->etat;
    $equipement->marque = $request->marque;
    $equipement->description = $request->description;
    $equipement->date_acquisition = $request->date_acquisition;
    $equipement->categorie_id = Categorie::where('nom', $request->categorie)->value('id');
    // Gestion de l'image si elle est envoyée
    if ($request->hasFile('image_path')) {
      $file = $request->file('image_path');
      $filename = time() . '_' . $file->getClientOriginalName();
      $file->move(public_path('pictures/equipements'), $filename);
      $equipement->image_path = 'pictures/equipements/' . $filename;
    }
    $equipement->save();

    $user = Auth::user();
    $bon = new Bon();
    $bon->motif = 'Ajout de nouvel équipement : ' . $equipement->nom;
    $bon->user_id = $user->id;
    $bon->statut = "entrée";
    $pdfName = 'bon_entree_' . $equipement->id . '.pdf';
    $pdfPath = 'bon_entree/' . $pdfName;
    $bon->fichier_pdf = $pdfPath;
    $bon->save();
    $pdf = Pdf::loadView('pdf.bon', [
      'date' => now()->format('d/m/Y'),
      'nom' => $user->nom ?? 'Admin',
      'prenom' => $user->prenom ?? '',
      'motif' => 'Ajout de nouvel équipement : ' . $equipement->nom,
      'numero_bon' => $bon->id
    ]);
    Storage::disk('public')->put($pdfPath, $pdf->output());

    return redirect()->back() // ou ->back()
      ->with('success', 'Équipement ajouté avec succès et un Bon d \'entrée est genéré.')
      ->with('pdf', asset('storage/' . $pdfPath));
  }
  public function ShowToolpage()
  {
    $equipements = Equipement::with('categorie')->paginate(2);
    return view("admin.listtools", compact("equipements"));
  }
  public function putToolpage(Equipement $equipement)
  {
    $categories = Categorie::all();
    return view("admin.puttools", compact('equipement', 'categories'));
  }
  public function putTool(UpdateEquipementRequest $request, Equipement $equipement)
  {
    $equipement->nom = $request->nom;
    $equipement->etat = $request->etat;
    $equipement->marque = $request->marque;
    $equipement->description = $request->description;
    $equipement->date_acquisition = $request->date_acquisition;
    if ($request->hasFile('image_path')) {
      $imagePath = $request->file('image_path')->store('pictures/equipments', 'public');
      $equipement->image_path = $imagePath;
    }
    $equipement->save();

    return redirect()->back()->with('success', 'Équipement mis à jour avec succès.');
  }
  public function DeleteTool(Equipement $equipement)
  {
    $equipement->delete();
    return  redirect()->back();
  }
  public function ShowAllAsk()
  {
    $demandes = Demande::with('equipements')->where("statut", "=", "en_attente")->latest()->get();
    return view("admin.asklist", compact("demandes"));
  }
  public function CheckAsk(Demande $demande)

  {
    $demande->statut = "acceptee";
    $demande->save();
    return redirect()->back();
  }
  public function CancelAsk(Demande $demande)
  {
    $demande->statut = "rejetee";
    $demande->save();
    return redirect()->back();
  }
  public function Showaffectation()
  {
    //formulaire avec select employée, select pour equipements,motif text area,date de retour
    //recuperer la liste des employées && equipements
    //pour l'insertion il faut les tables:affectations,bon,equipement(MAJ),
    $equipements_groupes = Categorie::with(['equipement' => function ($query) {
      $query->where('etat', 'disponible')
        ->where(function ($q) {
          $q->whereHas('affectations', function ($q2) {
            $q2->whereNull('date_retour');
          })
            ->orWhereDoesntHave('affectations', function ($q3) {
              $q3->whereNull('date_retour');
            });
        });
    }])->get();


    $employes = User::where("role", "=", "employé")->get();
    return view("admin.affectation", compact('equipements_groupes', 'employes'));
  }

  public function HandleAffectation(Request $request)
  {
    DB::beginTransaction();

    try {
      foreach ($request->equipements as $index => $equipement_id) {
        $affectation = new Affectation();
        $affectation->equipement_id = $equipement_id;
        $affectation->date_retour = $request->dates_retour[$index];
        $affectation->user_id = $request->employe_id;

        $equipementChange = Equipement::find($equipement_id);
        $equipementChange->etat = "usagé";
        $equipementChange->save();

        $affectation->save();
      }

      $bon = new Bon();
      $bon->user_id = $request->employe_id;
      $bon->motif = $request->motif;
      $bon->statut = "sortie";

      $pdfName = 'bon_sortie_' . $request->employe_id . '.pdf';
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
        'type' => $bon->statut
      ]);

      Storage::disk('public')->put($pdfPath, $pdf->output());

      return redirect()->back()
        ->with('success', 'Affectation réussie avec succès et un bon de sortie a été généré.')
        ->with('pdf', asset('storage/' . $pdfPath));
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->with("error", "Une erreur est survenue : " . $e->getMessage());
    }
  }

  public function Showpannes()
  {
    $pannes = Panne::with(['equipement', 'user'])->latest()->get();
    return view("admin.pannelist", compact('pannes'));
  }
  public function ShowToollost()
  {
    $equipement_lost = Affectation::with(["equipement", "user"])
      ->where('date_retour', '<', Carbon::now())
      ->get();
    return view("admin.lost_tools", compact("equipement_lost"));
  }
  public function CollaboratorsPage()
  {

    return view("admin.collaborator_external");
  }
  public function HandleCollaborator(Request $request)
  {
    $request->validate([
      'nom' => 'required|string|max:255',
      'prenom' => 'required|string|max:255',
      'chemin_carte' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);
    $collaborator = new CollaborateurExterne();
    $collaborator->nom = $request->nom;
    $collaborator->prenom = $request->prenom;
    $cheminCarte = $request->file('chemin_carte')->store('cartes_identite', 'public');
    $collaborator->carte_chemin = $cheminCarte;
    $collaborator->save();
    return redirect()->back()->with('success', 'Collaborateur ajouté avec succès.');
  }
  public function ShowListCollaborator()
  {
    $collaborateurs = CollaborateurExterne::all();
    return view("admin.list_collaborator", compact('collaborateurs'));
  }
  public function destroy(CollaborateurExterne $CollaborateurExterne)
  {
    $CollaborateurExterne->delete();
    return redirect()->back();
  }
  public function ShowBons()
  {

    $bons = Bon::all();
    return view("admin.list_bons", compact('bons'));
  }
  public function CreateBon()
  {
    $collaborateurs = CollaborateurExterne::all();
    return view("admin.bon_external_collaborator", compact("collaborateurs"));
  }
  public function HandleBon(Request $request)
  {
    $request->validate([
      'collaborateur_id' => 'required|exists:collaborateur_externes,id',
      'motif' => 'required|string|max:1000',
      'type' => 'required|in:entrée,sortie,autre',
    ]);

    $collaborateur = CollaborateurExterne::findOrFail($request->collaborateur_id);
    $bon = new Bon();
    $bon->collaborateur_externe_id = $collaborateur->id;
    $bon->motif = $request->motif;
    $bon->statut = $request->type;
    $pdfName = 'bon_collab_' . $bon->id . '.pdf';
    $pdfPath = 'bon_collaborateurs/' . $pdfName;
    $bon->fichier_pdf = $pdfPath;
    $bon->save();
    $pdf = Pdf::loadView('pdf.bon', [
      'date' => now()->format('d/m/Y'),
      'nom' => $collaborateur->nom ?? 'Admin',
      'prenom' => $collaborateur->prenom ?? '',
      'motif' => $request->motif,
      'numero_bon' => $bon->id,
      'type' => $bon->statut
    ]);

    Storage::disk('public')->put($pdfPath, $pdf->output());

    return redirect()->back()
      ->with('success', 'Bon attribueé aux collaborateurs externe avec succès.')
      ->with('pdf', asset('storage/' . $pdfPath));
  }
}
