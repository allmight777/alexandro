<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeController extends Controller
{
    //
   public function index()
    {
        // ou toute autre variable que tu veux passer
        $user = Auth::user();

        return view('employee.homedash', [
            'user' => $user,
        ]);
    }
    public function ShowAskpage(){
        $equipements= Equipement::where('etat', 'Disponible')->get();
        $user = Auth::user();
        return view("employee.askpage",compact('user','equipements'));
    }
    public function signalerPanne()  {
        
    }
    public function equipementsAssignes(){
        
    }

}
