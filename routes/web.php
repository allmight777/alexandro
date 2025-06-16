<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
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
    Route::view('/dashboard/admin', 'admin.homedash');
    Route::view('/dashboard/gestionnaire', 'gestionnaire.homedash')->name('dashboard.gestionnaire');
    Route::view('/dashboard/employe', 'employee.homedash')->name('dashboard.employe');
});

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
    Route::get('/list_users', [AdminController::class, "showusers"])->middleware(['auth', IsAdmin::class])
        ->name("showusers");
    Route::get('/edituser/{user}', [AdminController::class, "edituserpage"])
        ->name('edituser')
        ->middleware(['auth', IsAdmin::class]);
    Route::get('deleteuser/{user}', [AdminController::class, "deleteuser"])
        ->name('deleteuser')
        ->middleware(['auth', IsAdmin::class]);
    Route::put('editusers/{user}', [AdminController::class, "ModifyUser"])
        ->name('putuser');
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
