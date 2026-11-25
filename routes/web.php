<?php

use App\Http\Controllers\Admin\AccountSettingsController;
use Illuminate\Support\Facades\Route;

// Public Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;


// ======================================================
// PUBLIC PORTFOLIO ROUTES
// ======================================================

// Homepage
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Projects section
Route::get('/projects', function () {
    return redirect()->to(route('home') . '#projects');
})->name('projects.index');

// About section
Route::get('/about', function () {
    return redirect()->to(route('home') . '#about');
})->name('about');

// Contact section
Route::get('/contact', function () {
    return redirect()->to(route('home') . '#contact');
})->name('contact');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');


// ======================================================
// ADMIN ROUTES
// ======================================================

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // --------------------------------------------------
        // ADMIN AUTHENTICATION
        // --------------------------------------------------

        Route::middleware('guest')->group(function () {

            // Login page
            Route::get('/login', [AuthController::class, 'showLogin'])
                ->name('login');

            // Login submission
            Route::post('/login', [AuthController::class, 'login'])
                ->name('login.submit');

        });


        // --------------------------------------------------
        // PROTECTED ADMIN ROUTES
        // --------------------------------------------------

        Route::middleware(['auth', 'admin'])->group(function () {

            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');


            // --------------------------------------------------
            // PROJECT MANAGEMENT
            // --------------------------------------------------

            Route::resource('projects', ProjectController::class)
                ->except(['show'])
                ->names('projects');


            // --------------------------------------------------
            // SKILLS MANAGEMENT
            // --------------------------------------------------

            Route::resource('skills', SkillController::class)
                ->except(['show'])
                ->names('skills');


            // --------------------------------------------------
            // EXPERIENCE MANAGEMENT
            // --------------------------------------------------

            Route::resource('experiences', ExperienceController::class)
                ->except(['show'])
                ->names('experiences');


            // --------------------------------------------------
            // EDUCATION MANAGEMENT
            // --------------------------------------------------

            Route::resource('education', EducationController::class)
                ->except(['show'])
                ->names('education');


            // --------------------------------------------------
            // CERTIFICATIONS MANAGEMENT
            // --------------------------------------------------

            Route::resource('certifications', CertificationController::class)
                ->except(['show'])
                ->names('certifications');


            // --------------------------------------------------
            // MESSAGES MANAGEMENT
            // --------------------------------------------------

            // Display all messages
            Route::get('/messages', [MessageController::class, 'index'])
                ->name('messages.index');

            // Display a single message
            Route::get('/messages/{message}', [MessageController::class, 'show'])
                ->name('messages.show');

            // Mark message as read or unread
            Route::patch('/messages/{message}/toggle-read', [MessageController::class, 'toggleRead'])
                ->name('messages.toggle-read');

            // Delete a message
            Route::delete('/messages/{message}', [MessageController::class, 'destroy'])
                ->name('messages.destroy');


            // --------------------------------------------------
            // PROFILE MANAGEMENT
            // --------------------------------------------------

            // Display profile editing form
            Route::get('/profile', [ProfileController::class, 'edit'])
                ->name('profile.edit');

            // Update portfolio profile
            Route::put('/profile', [ProfileController::class, 'update'])
                ->name('profile.update');
                // --------------------------------------------------
// ACCOUNT SETTINGS
// --------------------------------------------------

// Display account settings
Route::get('/account-settings', [AccountSettingsController::class, 'edit'])
    ->name('account-settings.edit');

// Update account information
Route::put('/account-settings/account', [AccountSettingsController::class, 'updateAccount'])
    ->name('account-settings.update-account');

// Change password
Route::put('/account-settings/password', [AccountSettingsController::class, 'updatePassword'])
    ->name('account-settings.update-password');


            // --------------------------------------------------
            // ADMIN LOGOUT
            // --------------------------------------------------

            Route::post('/logout', [AuthController::class, 'logout'])
                ->name('logout');

        });

    });