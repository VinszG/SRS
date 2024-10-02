<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PlantDashboardController;
use App\Http\Controllers\SuperDashboardController;
use App\Http\Controllers\TeknisiDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserRequestController;
use Illuminate\Support\Facades\Route;

// Redirect root URL to login page
Route::get('/', function () {
    return redirect()->route('account.login');
});

// Public routes
Route::group(['prefix' => 'account'], function() {
    Route::get('login', [LoginController::class, 'index'])->name('account.login');
    Route::get('register', [LoginController::class, 'register'])->name('account.register');
    Route::post('process-register', [LoginController::class, 'processRegister'])->name('processRegister');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
});

// Protected routes
Route::group(['prefix' => 'account', 'middleware' => 'auth'], function() {
    Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
    
    // User routes
    Route::group(['middleware' => 'role:user'], function() {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.user.dashboard');
        Route::get('profile', [DashboardController::class, 'profile'])->name('user.profile');
        Route::post('profile/update', [DashboardController::class, 'updateProfile'])->name('user.profile.update');
        Route::get('requests', [UserRequestController::class, 'index'])->name('user.requests.index');
        Route::get('requests/create', [UserRequestController::class, 'create'])->name('user.requests.create');
        Route::post('requests', [UserRequestController::class, 'store'])->name('user.requests.store');
        Route::get('requests/{request}', [UserRequestController::class, 'show'])->name('user.requests.show');
    });

    // Admin routes
    Route::group(['middleware' => 'role:admin'], function() {
        Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });

    // Plant routes
    Route::group(['middleware' => 'role:plant'], function() {
        Route::get('plant/dashboard', [PlantDashboardController::class, 'index'])->name('plant.dashboard');
    });

    // Super routes
    Route::group(['middleware' => 'role:super'], function() {
        Route::get('super/dashboard', [SuperDashboardController::class, 'index'])->name('super.dashboard');
    });

    // Teknisi routes
    Route::group(['middleware' => 'role:teknisi'], function() {
        Route::get('teknisi/dashboard', [TeknisiDashboardController::class, 'index'])->name('teknisi.dashboard');
    });
});
