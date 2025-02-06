<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//manages all staff related routes 
Route::resource('staff', StaffController::class);

//manages all permissions related routes 
Route::resource('permissions', PermissionsController::class);
Route::delete('permissions/{permission}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');

Route::resource('roles', RolesController::class);
Route::delete('roles/{roles}', [RolesController::class, 'destroy'])->name('roles.destroy');



require __DIR__.'/auth.php';
