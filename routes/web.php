<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Isemp;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\Equipement;

use App\Http\Middleware\GestionnaireMiddleware;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\BonController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\PanneController;
use App\Http\Controllers\RapportController;

use App\Http\Controllers\GestionnaireController;

// Ajoutez cette route avant le middleware général
Route::get('/dashboard', function () {
    return redirect()->route('dashboard.gestionnaire'); // Ou votre logique de redirection par rôle
})->name('dashboard')->middleware('auth');




// Route::middleware(['auth', 'checkRole:gestionnaire'])->group(function () {
Route::middleware(['auth', GestionnaireMiddleware::class])->group(function () {
    
    Route::view('/dashboard/admin', 'admin.homedash')->name('dashboard.admin');
    Route::view('/dashboard/gestionnaire', 'gestionnaire.homedash')->name('dashboard.gestionnaire');

    
    Route::get('/tools/add', [EquipementController::class, 'create'])
        ->name('gestionnaire.tools.add')
        ->middleware([GestionnaireMiddleware::class]);
    

    Route::get('/tools/list', [EquipementController::class, 'index'])
        ->name('gestionnaire.tools.list')
        ->middleware([GestionnaireMiddleware::class]);
        // ------------------------------------------------------------------
        // ---------------------------------------------------------------
    Route::post('/tools/store', [EquipementController::class, 'store'])
        ->name('storeTool')
        ->middleware([GestionnaireMiddleware::class]);


    Route::get('/tools/edit/{id}', [EquipementController::class, 'put'])
        ->name('tools.put')
        ->middleware([GestionnaireMiddleware::class]);

    Route::put('/tools/update/{id}', [EquipementController::class, 'update'])
        ->name('gestionnaire.tools.update')
        ->middleware([GestionnaireMiddleware::class]);
   

        Route::get('/tools/panne', [EquipementController::class, 'showPanne'])
    ->name('gestionnaire.tools.panne')
    ->middleware([GestionnaireMiddleware::class]);


    // Affichage du formulaire (GET)
    Route::get('/dashboard/gestionnaire/addtool', [GestionnaireController::class, 'showAddToolForm'])
        ->name('gestionnaire.addtool.form')
        ->middleware([GestionnaireMiddleware::class]);

    // Traitement du formulaire (POST)
    Route::post('/dashboard/gestionnaire/addtool', [GestionnaireController::class, 'storeTool'])
        ->name('gestionnaire.addtool.store')
        ->middleware([GestionnaireMiddleware::class]);

         
});



// --------------------------------------Demandes----------------------------------------------------
Route::prefix(prefix: 'gestionnaire')->middleware(['auth', GestionnaireMiddleware::class])->group(function () {
   
    Route::get('/gestionnaire/demandes', [DemandeController::class, 'index'])
        ->name('gestionnaire.demandes.index')
        ->middleware([GestionnaireMiddleware::class]);
     
    Route::post('/gestionnaire/demandes/{demande}/assigner', [GestionnaireController::class, 'assignerDemande'])
         ->name('gestionnaire.demandes.affecter');
});

// ----------------------------------------------collabo-----------------------------------------
Route::prefix('gestionnaire')->middleware(['auth', GestionnaireMiddleware::class])->group(function () {
    // Page d'ajout
    Route::get("/collaborateurs/external", [GestionnaireController::class, "CollaboratorsPage"])
        ->name('gestionnaire.collaborateurs.create');
    
    // Traitement du formulaire
    Route::post("/collaborateurs", [GestionnaireController::class, "HandleCollaborator"])
        ->name('gestionnaire.collaborateurs.store');
    
    // Liste des collaborateurs
    Route::get("/collaborateurs", [GestionnaireController::class, "ShowListCollaborator"])
        ->name('gestionnaire.collaborateurs.index');
    
    // Suppression
    Route::delete("/collaborateurs/{collaborateur}", [GestionnaireController::class, "destroy"])
        ->name('gestionnaire.collaborateurs.destroy');
});



        // --------------------------Affectations-----------------------------------------

Route::middleware(['auth', GestionnaireMiddleware::class])->prefix('gestionnaire')->group(function () {
    Route::get('/affectations', [AffectationController::class, 'index'])
        ->name('gestionnaire.affectations.index')
        ->middleware([GestionnaireMiddleware::class]);

    Route::get('/affectations/create', [AffectationController::class, 'create'])
        ->name('gestionnaire.affectations.create')
        ->middleware([GestionnaireMiddleware::class]);

    Route::post('/affectations', [AffectationController::class, 'store'])
        ->name('gestionnaire.affectations.store')
        ->middleware([GestionnaireMiddleware::class]);

});


Route::prefix('gestionnaire')->middleware(['auth', GestionnaireMiddleware::class])->group(function () {

    Route::get('/rapports/create', [RapportController::class, 'create'])
        ->name('gestionnaire.rapports.create')
        ->middleware([GestionnaireMiddleware::class]);

    Route::post('/rapports', [RapportController::class, 'store'])
        ->name('gestionnaire.rapports.store')
        ->middleware([GestionnaireMiddleware::class]);

    Route::get('/rapports', [RapportController::class, 'index'])
        ->name('gestionnaire.rapports.index')
        ->middleware([GestionnaireMiddleware::class]);

    Route::get('/rapports/{id}/download', [RapportController::class, 'download'])
        ->name('gestionnaire.rapports.download')
        ->middleware([GestionnaireMiddleware::class]);

});



// Route::prefix('gestionnaire')->middleware(['auth', GestionnaireMiddleware::class])->group(function () {
//     Route::get('/rapports/create', [RapportController::class, 'create'])->name('gestionnaire.rapports.create');
//     Route::post('/rapports', [RapportController::class, 'store'])->name('gestionnaire.rapports.store');
//     Route::get('/rapports', [RapportController::class, 'index'])->name('gestionnaire.rapports.index');
//     Route::get('/rapports/{id}/download', [RapportController::class, 'download'])->name('gestionnaire.rapports.download');
// });

    
    
    
 

    // Route::get('/tools/list', [EquipementController::class, 'index'])
    //     ->name('tools.list')
    //     ->middleware('can:viewAny,' . Equipement::class);

    // Route::get('/tools/edit/{id}', [EquipementController::class, 'edit'])
    //     ->name('tools.edit')
    //     ->middleware('can:update,equipement');

    // Route::put('/tools/update/{id}', [EquipementController::class, 'update'])
    //     ->name('tools.update')
    //     ->middleware('can:update,equipement');




    // Route::get('/tools/add', [EquipementController::class, 'create'])->name('tools.add');

    // Route::get('/tools/list', [EquipementController::class, 'index'])->name('tools.list');
    // Route::get('/tools/edit/{id}', [EquipementController::class, 'edit'])->name('tools.edit');
    // Route::put('/tools/update/{id}', [EquipementController::class, 'update'])->name('tools.update');
    

    // Route::get('equipements/create', [EquipementController::class, 'create'])->name('equipements.create');
    // Route::post('equipements', [EquipementController::class, 'store'])->name('equipements.store');
    // Route::get('equipements', [EquipementController::class, 'index'])->name('equipements.index');
    // Route::get('demandes', [DemandeController::class, 'index']);
    Route::resource('bons', BonController::class);

    Route::resource('affectations', AffectationController::class);

    // Route::get('pannes', [PanneController::class, 'index']);
    Route::resource('rapports', RapportController::class);



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dash',function (){
//      return  view("admin.homedash");
// });
Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard/admin', 'admin.homedash')->middleware([IsAdmin::class]);
    Route::view('/dashboard/gestionnaire', 'gestionnaire.homedash')->name('dashboard.gestionnaire');
    Route::get('/dashboard/employe', [EmployeController::class, "index"])->name('dashboard.employee');
});

Route::get('/redirect-by-role', function () {
    $role = Auth::user()->role;
    return match ($role) {
        'admin' => redirect('/dashboard/admin'),
        'gestionnaire' => redirect('/dashboard/gestionnaire'),

        'employé' => redirect('/dashboard/employe'),

    };
})->middleware(['auth'])->name('verifylogin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix("dashboard/admin")->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/list_users', [AdminController::class, "showusers"])
        ->name("showusers");
    Route::get('/edituser/{user}', [AdminController::class, "edituserpage"])
        ->name('edituser')
        ->middleware(['auth', IsAdmin::class]);
    Route::get('deleteuser/{user}', [AdminController::class, "deleteuser"])
        ->name('deleteuser')
        ->middleware(['auth', IsAdmin::class]);
    Route::put('editusers/{user}', [AdminController::class, "ModifyUser"])
        ->name('putuser');
    Route::get("/add_tool", [AdminController::class, "addToolpage"])
        ->name('addToolpage');
    Route::post('/addtool', [AdminController::class, "addTool"])
        ->name('addTool');
    Route::get('/list_equip', [AdminController::class, "ShowToolpage"])
        ->name("ShowToolpage");
    Route::get('/put_tool_page/{equipement}', [AdminController::class, "putToolpage"])
        ->name("putToolpage");
    Route::put('/put_tool/{equipement}', [AdminController::class, "putTool"])
        ->name("putTool");
    Route::get("/delete_tool/{equipement}", [AdminController::class, "DeleteTool"])
        ->name("DeleteTool");
    Route::get("/demandes_list", [AdminController::class, "ShowAllAsk"])
        ->name("liste.demandes");
    Route::put("/check_demande/{demande}", [AdminController::class, "CheckAsk"])
        ->name("valider.demande");
    Route::put("/cancel_demande/{demande}", [AdminController::class, "CancelAsk"])
        ->name("refuser.demande");
    Route::get('/affectation', [AdminController::class, "Showaffectation"])
        ->name('page.affectation');
    Route::post('/afectation-post', [AdminController::class, "HandleAffectation"])
        ->name("handle.affectation");
    Route::get('/equipement-pannes',[AdminController::class,"Showpannes"])
         ->name("equipements.pannes");
    Route::get("/list_tools_lost",[AdminController::class,"ShowToollost"])
         ->name("tools.lost");
    Route::get("/add-collaborateur-page",[AdminController::class,"CollaboratorsPage"])
          ->name("CollaboratorsPage");
    Route::post("/collaborator_submit",[AdminController::class,"HandleCollaborator"])
         ->name("HandleCollaborator");
    Route::get('/list_collaborator',[AdminController::class,"ShowListCollaborator"])
        ->name("ShowListCollaborator");
    Route::get("/delete_collaborator/{CollaborateurExterne}",[AdminController::class,"destroy"])
         ->name("collaborateurs.destroy");
    
});

Route::prefix("employee")->middleware(['auth', Isemp::class])->group(function () {

    Route::get('/demande-equipement', [EmployeController::class, 'ShowAskpage'])->name('demande.equipement');
    Route::post("/demande-equipement-soumise", [EmployeController::class, "SubmitAsk"])->name("demande.soumise");
    Route::get('/signaler-panne', [EmployeController::class, 'signalerPanne'])->name('signaler.panne');
    Route::post("/post-signaler-panne",[EmployeController::class,"HandlePanne"])->name("post.HandlePanne");
    Route::get('/equipements-assignes', [EmployeController::class, 'equipementsAssignes'])->name('equipements.assignes');
});

//deleteuser
require __DIR__ . '/auth.php';
