<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Public portfolio
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/projects', function () {
    return redirect()->to(route('home') . '#projects');
})->name('projects.index');

Route::get('/about', function () {
    return redirect()->to(route('home') . '#about');
})->name('about');

Route::get('/contact', function () {
    return redirect()->to(route('home') . '#contact');
})->name('contact');

// Administrator authentication
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'login'])
            ->name('login.submit');
    });

    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
    });
});