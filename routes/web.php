<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\OeuvreController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\StatsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');

    Route::get('/profile', [ProfileController::class,'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class,'update'])->name('profile.update');

    Route::get('/profile/informations', [ProfileController::class,'informationPage'])->name('profile.info');
    Route::post('/profile/informations', [ProfileController::class,'saveInformation'])->name('profile.info.save');

    Route::get('/admin-request', [AdminRequestController::class,'create'])->name('admin-request.create');
    Route::post('/admin-request', [AdminRequestController::class,'store'])->name('admin-request.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard']);
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {

    Route::get('/super-admin/admin-requests', [SuperAdminController::class,'listRequests']);
    Route::post('/super-admin/admin-requests/{id}/accept', [SuperAdminController::class,'acceptRequest']);
    Route::post('/super-admin/admin-requests/{id}/refuse', [SuperAdminController::class,'refuseRequest']);

    Route::get('/super-admin/admin-requests/archive', [SuperAdminController::class, 'archivedRequests'])
        ->name('super-admin.admin-requests.archive');

    Route::prefix('admin')->group(function () {

        Route::get('/users', [UserManagementController::class,'index'])->name('admin.users');
        Route::post('/users/{user}/role', [UserManagementController::class,'updateRole'])->name('admin.users.role');
        Route::delete('/users/{user}', [UserManagementController::class,'destroy'])->name('admin.users.delete');
    });
});

Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {

    Route::get('/admin/oeuvres', [OeuvreController::class, 'index'])->name('admin.oeuvres');
    Route::get('/admin/oeuvres/create', [OeuvreController::class, 'create'])->name('admin.oeuvres.create');
    Route::post('/admin/oeuvres', [OeuvreController::class, 'store'])->name('admin.oeuvres.store');

    Route::get('/admin/oeuvres/{oeuvre}', [OeuvreController::class, 'show'])->name('admin.oeuvres.show');
    Route::get('/admin/oeuvres/{oeuvre}/edit', [OeuvreController::class, 'edit'])->name('admin.oeuvres.edit');
    Route::put('/admin/oeuvres/{oeuvre}', [OeuvreController::class, 'update'])->name('admin.oeuvres.update');
    Route::delete('/admin/oeuvres/{oeuvre}', [OeuvreController::class, 'destroy'])->name('admin.oeuvres.destroy');
});

Route::get('/oeuvres', [OeuvreController::class, 'publicIndex'])->name('oeuvres');

Route::get('/oeuvres/{oeuvre}', [OeuvreController::class, 'showPublic'])->name('oeuvres.show');

Route::get('/peintures', [OeuvreController::class, 'peintures'])->name('peintures');

Route::get('/artistes', [OeuvreController::class, 'artistes'])->name('artistes');

Route::get('/expositions', function () {
    return view('expositions.index');
});

Route::middleware('auth')->group(function () {

    Route::post('/favorites/{oeuvre}', [FavoriteController::class, 'toggle'])
        ->name('favorites.toggle');

    Route::get('/profile/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');

});

Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {

    Route::get('/admin/statistiques', [StatsController::class, 'index'])
        ->name('admin.stats');
});

Route::get('/oeuvres/search/suggestions', [OeuvreController::class, 'searchSuggestions'])
    ->name('oeuvres.search.suggestions');

Route::get('/admin/oeuvres/{oeuvre}', [OeuvreController::class, 'show'])
    ->name('admin.oeuvres.show')
    ->middleware(['auth', 'role:admin,super_admin']);

Route::get('/oeuvres/{oeuvre}', [OeuvreController::class, 'showPublic'])
    ->name('oeuvres.show');

Route::get('/peintures/search/suggestions', [OeuvreController::class, 'peintureSuggestions'])
    ->name('peintures.search.suggestions');
