<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\PlantDashboardController;
use App\Http\Controllers\PlantRequestController;
use App\Http\Controllers\SuperDashboardController;
use App\Http\Controllers\SuperRequestController;
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
    Route::get('forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
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
        Route::get('/admin/profile', [AdminDashboardController::class, 'profile'])->name('admin.profile');
        Route::post('/admin/profile/update', [AdminDashboardController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/admin/register', [AdminDashboardController::class, 'processRegisterAdmin'])->name('admin.register.process');
        Route::get('/admin/register', [AdminDashboardController::class, 'showRegisterForm'])->name('admin.register');

        Route::get('/admin/requests', [AdminRequestController::class, 'index'])->name('admin.requests.index');
        Route::get('/admin/requests/{request}', [AdminRequestController::class, 'show'])->name('admin.requests.show');
        Route::post('/admin/requests/{userRequest}/assign', [AdminRequestController::class, 'assignTeknisi'])->name('admin.requests.assign');

    });

    // Plant routes
    Route::group(['middleware' => 'role:plant'], function() {
        Route::get('plant/dashboard', [PlantDashboardController::class, 'index'])->name('plant.dashboard');
        Route::get('/plant/profile', [PlantDashboardController::class, 'profile'])->name('plant.profile');
        Route::post('/plant/profile/update', [PlantDashboardController::class, 'updateProfile'])->name('plant.profile.update');

        Route::get('/plant/requests', [PlantRequestController::class, 'index'])->name('plant.requests.index');
        Route::get('/plant/requests/{request}', [PlantRequestController::class, 'show'])->name('plant.requests.show');
        Route::put('/plant/requests/{userRequest}/status', [PlantRequestController::class, 'updateStatus'])->name('plant.requests.updateStatus');
    });

    // Super routes 
    Route::group(['middleware' => 'role:super'], function() {
        Route::get('super/dashboard', [SuperRequestController::class, 'index'])->name('super.dashboard');

        // Request routes
        Route::get('/super/request', [SuperRequestController::class, 'index'])->name('super.request.index');
        Route::get('/super/request/{request}', [SuperRequestController::class, 'show'])->name('super.request.show');
        Route::patch('/super/request/{userRequest}/jenis', [SuperRequestController::class, 'updateJenis'])->name('super.request.updateJenis');
        
        //Profile
        Route::get('/super/profile', [SuperDashboardController::class, 'profile'])->name('super.profile');
        Route::post('/super/profile/update', [SuperDashboardController::class, 'updateProfile'])->name('super.profile.update');
    });

    // Teknisi routes
    Route::group(['middleware' => 'role:teknisi'], function() {
        Route::get('teknisi/dashboard', [TeknisiDashboardController::class, 'index'])->name('teknisi.dashboard');
        Route::get('/teknisi/profile', [TeknisiDashboardController::class, 'profile'])->name('teknisi.profile');
        Route::post('/teknisi/profile/update', [TeknisiDashboardController::class, 'updateProfile'])->name('teknisi.profile.update');
    });
});
