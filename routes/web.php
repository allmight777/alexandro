<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Isemp;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BonController;


use App\Models\Equipement;

use App\Http\Middleware\GestionnaireMiddleware;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\DemandeController;
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
   
// ----------------------------------panne-----------------------------------------------------

Route::get('/gestionnaire/pannes', [GestionnaireController::class, 'voirPannes'])
    ->name('gestionnaire.pannes.index')
    ->middleware([GestionnaireMiddleware::class]);

// Route::middleware(['auth', 'gestionnaire'])->prefix('gestionnaire')->name('gestionnaire.')->group(function () {
//     Route::get('/equipements-perdus', [GestionnaireController::class, 'equipementsPerdus'])
//         ->name('equipements.perdus')
//         ->middleware([GestionnaireMiddleware::class]);
    
//     Route::patch('/equipements-retourner/{id}', [GestionnaireController::class, 'retournerEquipement'])
//         ->name('equipements.retourner')
//         ->middleware([GestionnaireMiddleware::class]);

// });



Route::middleware(['auth', App\Http\Middleware\GestionnaireMiddleware::class])
    ->prefix('gestionnaire')
    ->name('gestionnaire.')
    ->group(function () {
        Route::get('/equipements-perdus', [GestionnaireController::class, 'equipementsPerdus'])->name('equipements.perdus');
        Route::patch('/equipements-retourner/{id}', [GestionnaireController::class, 'retournerEquipement'])->name('equipements.retourner');
    });

// -----------------------------------------------------------------------------------------------------------------------------
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


Route::prefix('gestionnaire')->middleware(['auth', App\Http\Middleware\GestionnaireMiddleware::class])->group(function () {
    Route::get('/collaborateurs/create', [App\Http\Controllers\GestionnaireController::class, 'createCollaborateur'])->name('gestionnaire.collaborateurs.create');
    Route::post('/collaborateurs', [App\Http\Controllers\GestionnaireController::class, 'storeCollaborateur'])->name('gestionnaire.collaborateurs.store');
    Route::get('/collaborateurs', [App\Http\Controllers\GestionnaireController::class, 'listCollaborateurs'])->name('gestionnaire.collaborateurs.index');
    Route::delete('/collaborateurs/{id}', [App\Http\Controllers\GestionnaireController::class, 'destroyCollaborateur'])
        ->name('gestionnaire.collaborateurs.destroy');



        // ----------------------------------------------------------Bon-------------------------------------------

Route::prefix('gestionnaire/bons')->middleware(['auth', 'gestionnaire'])->group(function() {
    Route::get('/', [BonController::class, 'index'])->name('gestionnaire.bons.index');
    Route::get('/externe', [BonController::class, 'showExternalCollaboratorForm'])->name('gestionnaire.bons.bon_external');
    Route::post('/externe', [BonController::class, 'handleExternalBon'])->name('gestionnaire.bons.handle');
});


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

// ____________________________________--------------Rapport------------___________________________________

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

    Route::delete('/rapports/{rapport}', [RapportController::class, 'destroy'])->name('rapports.destroy');
    


});

// ----------------------------------------------bons------------------------------------------------
// ----------------------------------------------    ------------------------------------------------

Route::get('/gestionnaire/bons', [BonController::class, 'index'])->name('gestionnaire.bons.bon_external');
Route::get('/gestionnaire/bons/external-collaborator', [BonController::class, 'showExternalCollaboratorForm'])->name('gestionnaire.bons.bon_external_collaborator');
Route::post('/gestionnaire/bons/handle-external', [BonController::class, 'handleExternalBon'])->name('gestionnaire.bons.handle_external');

Route::middleware(['web', 'auth', GestionnaireMiddleware::class])->group(function () {
    Route::delete('/gestionnaire/bons/{id}', [BonController::class, 'destroy'])
        ->middleware(GestionnaireMiddleware::class)
        ->name('gestionnaire.bons.destroy');

});




    Route::resource('bons', BonController::class);

    Route::resource('affectations', AffectationController::class);

    // Route::get('pannes', [PanneController::class, 'index']);
    Route::resource('rapports', RapportController::class);



Route::get('/', function () {
    return view('welcome');
});


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
    Route::put("/loading_demandes,{demande}",[AdminController::class,"LoadingAsk"])
         ->name("loading.demande");
    Route::get('/affectation', [AdminController::class, "Showaffectation"])
        ->name('page.affectation');
    Route::post('/afectation-post', [AdminController::class, "HandleAffectation"])
        ->name("handle.affectation");
    Route::get("/listes_affectations",[AdminController::class,"Showlistaffectation"])
          ->name("page.listeAffectations");
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
    Route::get('/list_bon',[AdminController::class,"ShowBons"])
         ->name("liste.bons");
    Route::get('/bon_collaborator_external',[AdminController::class,"CreateBon"])
        ->name("CreateBon");
    Route::post("/post_bon_collaborator_external",[AdminController::class,"HandleBon"])
         ->name("HandleBon");
    Route::post("/back_tool/{affectation}",[AdminController::class,"BackTool"])
           ->name("affectation.retourner");
    Route::delete("/delete/{bon}",[AdminController::class,"DeleteBon"])
           ->name("delete.bon");
    Route::get("/list_rapport",[AdminController::class,"ShowRapport"])
         ->name("rapport.lists");
});

Route::prefix("employee")->middleware(['auth', Isemp::class])->group(function () {

    Route::get('/demande-equipement', [EmployeController::class, 'ShowAskpage'])->name('demande.equipement');
    Route::post("/demande-equipement-soumise", [EmployeController::class, "SubmitAsk"])->name("demande.soumise");
    Route::get('/signaler-panne', [EmployeController::class, 'signalerPanne'])->name('signaler.panne');
    Route::post("/post-signaler-panne",[EmployeController::class,"HandlePanne"])->name("post.HandlePanne");
    Route::get('/equipements-assignes', [EmployeController::class, 'equipementsAssignes'])->name('equipements.assignes');
    Route::get("/help-employee",[EmployeController::class,"Helppage"])
         ->name("page.aide");
    Route::post("/post-aide",[EmployeController::class,"HandleHelp"])
         ->name("send.aide");
});

//deleteuser
require __DIR__ . '/auth.php';
