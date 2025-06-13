<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showusers(){
      $users=User::all();
      return view("admin.listuserpage",compact("users"));



    }
    public function edituserpage(User $user){
      return view("admin.edit_user",compact('user'));
    }

    public function deleteuser(User $user){
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
}
