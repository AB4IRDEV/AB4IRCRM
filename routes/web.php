<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTemplateController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::redirect('/',('dashboard')
);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


//manages all staff related routes 
Route::resource('staff', StaffController::class);

//manages all permissions related routes 
Route::delete('permissions/{permission}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');
Route::resource('permissions', PermissionsController::class);

//Roles Crud Routes
Route::delete('roles/{roles}', [RolesController::class, 'delete'])->name('roles.delete');
Route::get('roles/{roleId}/give-permissions', [RolesController::class, 'addPermissionToRole'])->name('addPermissionToRole');
Route::put('roles/{roleId}/give-permissions', [RolesController::class, 'givePermissionToRole'])->name('givePermissionToRole');
Route::resource('roles', RolesController::class);

//User Crud Routes
Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::resource('user', UserController::class);

//Projects Crud Routes
Route::post('/programs-templates', [ProgramsController::class, 'storeSubcategory'])
->name('programs_templates.save');
Route::delete('programs/{programs}',[ProgramsController::class,'delete'])->name('programs.delete');
Route::resource('programs', ProgramsController::class);

//Stakeholder Crud Routes
Route::delete('stakeholders/{stakeholder}',[StakeholderController::class,'delete'])->name('stakeholder.delete');
Route::resource('stakeholders', StakeholderController::class);

//Projects Crud Routes

Route::delete('projects/{projects}',[ProjectController::class,'delete'])->name('projects.delete');
Route::resource('projects', ProjectController::class);

Route::get('/get-project-templates', [ProjectTemplateController::class, 'getProjectTemplates'])->name('getProjectTemplates');

//Beneficiary Crud Routes 
Route::resource('beneficiaries', BeneficiaryController::class);
Route::delete('/beneficiaries/{beneficiary}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');
Route::post('/beneficiary/finalize', [BeneficiaryController::class, 'finalize'])->name('beneficiary.finalize');

Route::resource('contacts', ContactController::class);

});


require __DIR__.'/auth.php';
