<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;





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
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
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

        Route::resource('projects', ProjectController::class)
            ->except(['show'])
            ->names('projects');

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
        Route::resource('skills', SkillController::class)
            ->except(['show'])
            ->names('skills');
        Route::resource('education ', EducationController::class)
            ->except(['show'])
            ->names('education');
        Route::resource('certifications', CertificationController::class)
            ->except(['show'])
            ->names('certifications');
            // Message management
Route::get('/messages', [MessageController::class, 'index'])
    ->name('messages.index');

Route::get('/messages/{message}', [MessageController::class, 'show'])
    ->name('messages.show');

Route::patch('/messages/{message}/toggle-read', [MessageController::class, 'toggleRead'])
    ->name('messages.toggle-read');

Route::delete('/messages/{message}', [MessageController::class, 'destroy'])
    ->name('messages.destroy');
    // Profile Management
Route::get('/profile', [
    \App\Http\Controllers\Admin\ProfileController::class,
    'edit'
])->name('profile.edit');

Route::put('/profile', [
    \App\Http\Controllers\Admin\ProfileController::class,
    'update'
])->name('profile.update');
    });

    Route::resource('experiences', ExperienceController::class)
        ->except(['show'])
        ->names('experiences');
});
