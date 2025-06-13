<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.Adduserpage');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'=>['required'],
            'service'=>['required'],
            'poste'=>['required']
        ],[
            'nom.required' => 'Le nom est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est requis.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'email.required' => "L'email est requis.",
            'email.string' => "L'email doit être une chaîne de caractères.",
            'email.lowercase' => "L'email doit être en minuscules.",
            'email.email' => "L'email doit être une adresse email valide.",
            'email.max' => "L'email ne doit pas dépasser 255 caractères.",
            'email.unique' => "Cet email est déjà utilisé.",
            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'role.required' => 'Le rôle est requis.',
            'service.required' => 'Le service est requis.',
            'poste.required' => 'Le poste est requis.',
            'password.min'=>'le mot de passe doit etre de 8 caracteres au minimum'
        ]);

        $user = User::create([
            'nom'=> $request->nom,
            'prenom' => $request->prenom,
            'poste' => $request->poste,
            'role' => $request->role,
            'service' =>$request->service,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        // dd($user);

        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->back()->with("success","utilisateur ajoutée avec succès");
    }
}
