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
Route::get('/list_users',[AdminController::class,"showusers"])->middleware(['auth',IsAdmin::class])
      ->name("showusers");
Route::get('/edituser/{user}',[AdminController::class,"edituserpage"])
       ->name('edituser')
       ->middleware(['auth',IsAdmin::class]);
Route::get('deleteuser/{user}',[AdminController::class,"deleteuser"])
       ->name('deleteuser')
       ->middleware(['auth',IsAdmin::class]);
Route::put('editusers/{user}',[AdminController::class,"ModifyUser"])
           ->name('putuser');





       //deleteuser


require __DIR__.'/auth.php';
