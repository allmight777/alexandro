<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Isemp;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    Route::put('/pannes_modify/{panne}',[AdminController::class,"PutPanne"])
          ->name('pannes.resolu');
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
    Route::get('/lists_demandes',[AdminController::class,"ShowDemandes"])
          ->name("demandes.lists");
});

//deleteuser
require __DIR__ . '/auth.php';
