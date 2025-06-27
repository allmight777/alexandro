<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Rapport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $rapports = Rapport::where('user_id', $user->id)->latest()->get();

        return view('gestionnaire.rapports.index', compact('rapports'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gestionnaire.rapports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        $contenu = $request->contenu;
        $user = auth()->user();

        // Générer le PDF
        $pdf = Pdf::loadView('gestionnaire.rapports.pdf', compact('contenu', 'user'));

        // Enregistrer le PDF dans le dossier public/storage/rapports/
        $filename = 'rapport_' . now()->format('Ymd_His') . '.pdf';
        $path = 'rapports/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        // Enregistrer dans la base de données
        Rapport::create([
            'contenu' => $contenu,
            'user_id' => $user->id,
            'file_path' => $path,
        ]);
        // return redirect()->back()->with('success', value: 'Rapport généré et soumis avec succès.');
        return redirect()->route('gestionnaire.rapports.index')->with('success', 'Le rapport a bien été généré.');
    }

    public function show($id)
    {
        $rapport = Rapport::with('user')->findOrFail($id);
        return view('gestionnaire.rapports.show', compact('rapport'));
    }




//     public function download($id)
// {
//     $rapport = Rapport::with('user')->findOrFail($id); // on récupère aussi l'utilisateur lié
//     $user = $rapport->user; // on récupère l'utilisateur

//     $pdf = Pdf::loadView('gestionnaire.rapports.pdf', [
//         'contenu' => $rapport->contenu,
//         'user' => $user, // on passe bien $user à la vue
//     ]);

//     return $pdf->download('rapport_'.$rapport->id.'.pdf');
// }


        public function download($id)
        {
            $rapport = Rapport::with('user')->findOrFail($id);
            $user = $rapport->user;

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('gestionnaire.rapports.pdf', [
                'contenu' => $rapport->contenu, // 🔥 ajout ici
                'user' => $user
            ]);

            // return $pdf->download('rapport_'.$rapport->id.'.pdf');
            return $pdf->stream('rapport_'.$rapport->id.'.pdf');//Forcer le téléchargement dans le navigateur

        }


    public function destroy($id)
    {
        $rapport = Rapport::findOrFail($id);

    // Si tu as un fichier à supprimer, supprime-le aussi ici, par exemple :
        if ($rapport->chemin_fichier && Storage::exists($rapport->chemin_fichier)) {
            Storage::delete($rapport->chemin_fichier);
        }   

        $rapport->delete();

        return redirect()->route('gestionnaire.rapports.index')->with('success', 'Rapport supprimé avec succès.');
    }

    // /**
    //  * Display the specified resource.
    // //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
