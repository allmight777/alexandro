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
use App\Models\Rapport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Cloudinary\Cloudinary;

class AdminController extends Controller
{


  public function ShowHomePage()
  {
    // Cache global de 5 minutes (300 sec) pour toute la data statistique
    $cacheKey = 'home_page_stats';

    $data = Cache::remember($cacheKey, 300, function () {
      $nbr_equipement = Equipement::count();
      $nbr_user = User::count();
      $nbr_affect = Affectation::sum('quantite_affectee');
      $nbr_panne = Panne::count();

      // Statistiques par mois
      $statsParMois = [];
      for ($i = 1; $i <= 12; $i++) {
        $debut = Carbon::create(null, $i, 1)->startOfMonth();
        $fin = Carbon::create(null, $i, 1)->endOfMonth();

        $statsParMois[$i] = Affectation::whereBetween('created_at', [$debut, $fin])->sum('quantite_affectee');
      }

      // Distribution par catégorie
      $distribution = Categorie::withCount('equipements')->get()->map(function ($cat) {
        return ['label' => $cat->nom, 'count' => $cat->equipements_count];
      });

      return compact('nbr_equipement', 'nbr_user', 'nbr_affect', 'nbr_panne', 'statsParMois', 'distribution');
    });

    // Injecte dans la vue
    return view("admin.homedash", $data);
  }

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
    $equipement->quantite = $request->quantite;
    $equipement->categorie_id = Categorie::where('nom', $request->categorie)->value('id');
    // Gestion de l'image si elle est envoyée
    if ($request->hasFile('image_path')) {
      try {
        $cloudinary = new Cloudinary();

        $result = $cloudinary->uploadApi()->upload(
          $request->file('image_path')->getRealPath(),
          [
            'folder' => 'equipements',
            'public_id' => 'equipement_' . time() . '_' . $request->nom,
            'resource_type' => 'image',
            'transformation' => [
              'quality' => 'auto',
              'fetch_format' => 'auto'
            ]
          ]
        );

        $equipement->image_path = $result['secure_url']; // Stocke le lien direct dans la BDD
      } catch (\Exception $e) {
        return redirect()->back()
          ->with('error', 'Erreur lors de l\'upload de l\'image de l\'équipement : ' . $e->getMessage())
          ->withInput();
      }
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
      'numero_bon' => $bon->id,
      'type' => $bon->statut
    ]);
    Storage::disk('public')->put($pdfPath, $pdf->output());

    return redirect()->back() // ou ->back()
      ->with('success', 'Équipement ajouté avec succès et un Bon d \'entrée est genéré.')
      ->with('pdf', asset('storage/' . $pdfPath));
  }
  public function ShowToolpage()
  {
    // $equipements = Equipement::with('categorie')->paginate(2);
    $equipements = Equipement::with('categorie')->paginate(10);

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
    $equipement->quantite = $request->quantite_disponible;

    if ($request->hasFile('image_path')) {
      try {
        $cloudinary = new Cloudinary();

        // Optionnel : supprimer l'ancienne image si public_id est connu
        // $cloudinary->uploadApi()->destroy($equipement->cloudinary_public_id);

        $result = $cloudinary->uploadApi()->upload(
          $request->file('image_path')->getRealPath(),
          [
            'folder' => 'equipements',
            'public_id' => 'equipement_' . time() . '_' . $request->nom,
            'resource_type' => 'image',
            'transformation' => [
              'quality' => 'auto',
              'fetch_format' => 'auto'
            ]
          ]
        );

        $equipement->image_path = $result['secure_url'];
        // Optionnel : sauvegarder le public_id pour suppression future
        // $equipement->cloudinary_public_id = $result['public_id'];

      } catch (\Exception $e) {
        return redirect()->back()
          ->with('error', 'Erreur lors de l\'upload de l\'image : ' . $e->getMessage())
          ->withInput();
      }
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
  //   public function Showaffectation()
  //   {
  //     //formulaire avec select employée, select pour equipements,motif text area,date de retour
  //     //recuperer la liste des employées && equipements
  //     //pour l'insertion il faut les tables:affectations,bon,equipement(MAJ),
  //     $categories = Categorie::with(['equipements' => function ($query) {
  //       $query->where('etat', 'disponible')
  //         ->where(function ($q) {
  //           $q->whereHas('affectations', function ($q2) {
  //             $q2->whereNull('date_retour');
  //           })
  //             ->orWhereDoesntHave('affectations', function ($q3) {
  //               $q3->whereNull('date_retour');
  //             });
  //         });
  //     }])->get();


  //     $employes = User::where("role", "=", "employé")->get();
  //     return view("admin.affectation", [
  //         'equipements_groupes' => $categories,
  //         'employes' => $employes
  //     ]); 
  //  }

  public function Showaffectation()
  {
    $equipements_groupes = Categorie::with(['equipements' => function ($query) {
      $query->where('etat', 'disponible')
        ->where(function ($q) {
          $q->whereHas('affectations', function ($q2) {
            $q2->whereNull('date_retour');
          })
            ->orDoesntHave('affectations');
        });
    }])->get();

    $employes = User::where("role", "=", "employé")->get();

    return view("admin.affectation", compact('equipements_groupes', 'employes'));
  }

  public function HandleAffectation(Request $request)
  {
    $request->validate([
      'equipements' => 'required',
      'quantites' => 'required'
    ], [
      'equipements.required' => 'le champ equipement est requis',
      'quantites.required' => 'le champ quantité est requis'
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
      $pdf->setPaper('A5', 'portrait');

      Storage::disk('public')->put($pdfPath, $pdf->output());

      return redirect()->back()
        ->with('success', 'Affectation réussie avec succès et un bon de sortie a été généré.')
        ->with('pdf', asset('/storage/' . $pdfPath));
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error("Erreur lors de l'affectation : " . $e->getMessage());
      return redirect()->back()->with("error", $e->getMessage());
    }
  }



  public function Showpannes()
  {
    $pannes = Panne::with(['equipement', 'user'])->where("statut", "=", "en_attente")->latest()->get();
    return view("admin.pannelist", compact('pannes'));
  }
  public function ShowToollost()
  {
    $equipement_lost = Affectation::with(['equipement', 'user'])
      ->where('date_retour', '<=', now()->startOfDay()) // pour ignorer l'heure
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

    // Upload vers Cloudinary au lieu du stockage local
    if ($request->hasFile('chemin_carte')) {
      try {
        $cloudinary = new Cloudinary();

        $result = $cloudinary->uploadApi()->upload(
          $request->file('chemin_carte')->getRealPath(),
          [
            'folder' => 'cartes_identite',
            'public_id' => 'carte_' . time() . '_' . $request->nom,
            'resource_type' => 'auto', // Supporte images et PDF
            'transformation' => [
              'quality' => 'auto',
              'fetch_format' => 'auto'
            ]
          ]
        );

        // Sauvegarder l'URL Cloudinary dans la BDD
        $collaborator->carte_chemin = $result['secure_url'];
        // $collaborator->carte_public_id = $result['public_id']; // Pour pouvoir supprimer plus tard
      } catch (\Exception $e) {
        return redirect()->back()
          ->with('error', 'Erreur lors de l\'upload du fichier: ' . $e->getMessage())
          ->withInput();
      }
    }

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
    $pdf->setPaper('A5', 'portrait');
    Storage::disk('public')->put($pdfPath, $pdf->output());

    return redirect()->back()
      ->with('success', 'Bon attribueé aux collaborateurs externe avec succès.')
      ->with('pdf', asset('storage/' . $pdfPath));
  }
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
  public function DeleteBon(Bon $bon)
  {
    $bon->delete();
    return redirect()->back();
  }
  public function Showlistaffectation()
  {
    $affectations = Affectation::with(['equipement', 'user'])->latest()->get();
    return view("admin.affectlist", compact("affectations"));
  }
  public function LoadingAsk(Demande $demande)
  {
    $demande->statut = "en_attente";
    $demande->save();
    return redirect()->back();
  }
  public function ShowRapport()
  {
    $rapports = Rapport::orderBy('created_at', 'desc')->get();
    return view("admin.list_rapport", compact("rapports"));
  }

  public function PutPanne(Panne $panne)
  {
    $panne->statut = "resolu";
    $panne->save();
    return redirect()->back();
  }
  public function DestroyAffect(Affectation $affectation)
  {
    $affectation->delete();
    return redirect()->back();
  }
}
