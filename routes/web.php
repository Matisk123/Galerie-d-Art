<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth','role:super_admin'])->group(function(){
    Route::get('/super-admin', [SuperAdminController::class,'dashboard']);
    Route::get('/super-admin/admin-requests', [SuperAdminController::class,'listRequests']);
    Route::post('/super-admin/admin-requests/{id}/accept', [SuperAdminController::class,'acceptRequest']);
    Route::post('/super-admin/admin-requests/{id}/refuse', [SuperAdminController::class,'refuseRequest']);
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin', [AdminController::class,'dashboard']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/menu', [MenuController::class,'index']);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-request', [AdminRequestController::class,'create'])->name('admin-request.create');
    Route::post('/admin-request', [AdminRequestController::class, 'store'])->name('admin-request.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class,'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class,'update'])->name('profile.update');
});
Route::middleware(['auth','role:super_admin'])->group(function(){
    // Page archive demandes admin
    Route::get('/super-admin/admin-requests/archive', [SuperAdminController::class, 'archivedRequests'])
        ->name('super-admin.admin-requests.archive');
});
