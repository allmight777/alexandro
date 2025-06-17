<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Isemp;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\Equipement;


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
        ->name('tools.add')
        ->middleware('can:create,App\Models\Equipement');


    Route::get('/tools/list', [EquipementController::class, 'index'])
        ->name('tools.list')
        ->middleware('can:viewAny,' . Equipement::class);

    Route::get('/tools/edit/{id}', [EquipementController::class, 'edit'])
        ->name('tools.edit')
        ->middleware('can:update,equipement');

    Route::put('/tools/update/{id}', [EquipementController::class, 'update'])
        ->name('tools.update')
        ->middleware('can:update,equipement');

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
});


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
});
Route::get('/dashboard/employe', function () {
    // ou toute autre variable que tu veux passer
    $user = Auth::user();

    return view('employee.homedash', [
        'user' => $user,
    ]);
})->name('dashboard.employe')->middleware([Isemp::class]);
Route::get('/redirect-by-role', function () {
    $role = Auth::user()->role;
    return match ($role) {
        'admin' => redirect('/dashboard/admin'),
        'gestionnaire' => redirect('/dashboard/gestionnaire'),
        default => redirect('/dashboard/employe'),
    };
})->middleware(['auth'])->name('verifylogin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix("dashboard")->middleware(['auth', IsAdmin::class])->group(function () {
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
});

use App\Http\Middleware\GestionnaireMiddleware;

Route::middleware(['auth', GestionnaireMiddleware::class])->group(function () {
    // Gestion équipements
    Route::get('/equipements', [EquipementController::class, 'index'])->name('equipements.index');
    Route::get('/equipements/create', [EquipementController::class, 'create'])->name('equipements.create');
    Route::post('/equipements', [EquipementController::class, 'store'])->name('equipements.store');
    Route::get('/equipements/{id}/edit', [EquipementController::class, 'edit'])->name('equipements.edit');
    Route::put('/equipements/{id}', [EquipementController::class, 'update'])->name('equipements.update');
    Route::delete('/equipements/{id}', [EquipementController::class, 'destroy'])->name('equipements.destroy');

    // Consulter demandes
    Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');

    // Gérer bons (sortie et entrée)
    Route::get('/bons', [BonController::class, 'index'])->name('bons.index');
    Route::get('/bons/create', [BonController::class, 'create'])->name('bons.create');
    Route::post('/bons', [BonController::class, 'store'])->name('bons.store');

    // Affecter équipement
    Route::get('/affectations', [AffectationController::class, 'index'])->name('affectations.index');
    Route::get('/affectations/create', [AffectationController::class, 'create'])->name('affectations.create');
    Route::post('/affectations', [AffectationController::class, 'store'])->name('affectations.store');

    // Consulter pannes
    Route::get('/pannes', [PanneController::class, 'index'])->name('pannes.index');

    // Soumettre rapport
    Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');
    Route::get('/rapports/create', [RapportController::class, 'create'])->name('rapports.create');
    Route::post('/rapports', [RapportController::class, 'store'])->name('rapports.store');
});


//deleteuser
require __DIR__ . '/auth.php';
