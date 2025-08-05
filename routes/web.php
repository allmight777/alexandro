<?php

use App\Http\Controllers\Admin\LogementController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MaisonController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// La page welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// La routes des contacts
Route::get('/contacts', function () {
    return view('contacts.contact');
})->name('contact');

// la routes des agents
Route::get('/agents', function () {
    return view('contacts.agent');
})->name('agent');

// la route des services
Route::get('/services', function () {
    return view('contacts.service');
})->name('service');

// la route des terms
Route::get('/terms', function () {
    return view('contacts.terms');
})->name('terms');

// La route pour about us
Route::get('/abouts', function () {
    return view('contacts.abouts');
})->name('abouts');

// la route privacy
Route::get('/privacy', function () {
    return view('contacts.privacy');
})->name('privacy');

// La route pour les proprietes
Route::get('/logements', [MaisonController::class, 'index'])->name('maison');
// show details
Route::get('/logements/{id}', [MaisonController::class, 'show'])->name('logements.show');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // route pour gerer les users
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // route ressource pour gérer les logements
    Route::resource('logements', LogementController::class);
    Route::get('admin/logements/{logement}', [LogementController::class, 'show'])->name('logements.show');

    // route pour gestion des demandes
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
    Route::post('/paiements/{paiement}/update-status', [PaiementController::class, 'updateStatus'])->name('paiements.updateStatus');

});

Route::middleware('auth')->group(function () {

    // Details appartement

    Route::get('/logements/{id}', [MaisonController::class, 'show'])->name('logements.show');

    // edit
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // vue pour ceux qui sont pas admin

    Route::get('/users', function () {
        return view('users');
    })->name('users');

    // Route de paiment
    Route::get('/paiement', [PaiementController::class, 'lancer'])->name('paiement.lancer');
    Route::post('/paiement/initier', [PaiementController::class, 'initierPaiement'])->name('paiement.initier');
    Route::post('/paiement/confirmer', [PaiementController::class, 'confirmerPaiement'])->name('paiement.confirmer');
    Route::get('/paiement/confirmation/{id}', [PaiementController::class, 'confirmation'])->name('paiement.confirmation');

    // Suivi des demandes de l'utilisateurs

    Route::get('/mes-paiements', [PaiementController::class, 'mesPaiements'])->name('mes.paiements');
});

require __DIR__.'/auth.php';

