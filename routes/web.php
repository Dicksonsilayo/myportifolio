<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/projects', function () {
    return redirect()->route('home') . '#projects';
})->name('projects.index');

Route::get('/about', function () {
    return redirect()->route('home') . '#about';
})->name('about');

Route::get('/contact', function () {
    return redirect()->route('home') . '#contact';
})->name('contact');
