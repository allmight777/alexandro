<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Http\Requests\UpdateEquipementRequest;
use App\Models\Categorie;
use App\Models\Demande;
use App\Models\Equipement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
  public function showusers()
  {
    $users = User::all();
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
    return redirect()->back()->with('success', 'Équipement ajouté avec succès.');
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
  public function ShowAllAsk() {
    $demandes = Demande::with('equipements')->latest()->get();
    return view("admin.asklist",compact("demandes"));

  }
}
