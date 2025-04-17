<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThesisTaskController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.role.update');
});
Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');


// Professor routes
Route::middleware(['checkRole:professor'])->group(function () {
    Route::resource('thesis-tasks', ThesisTaskController::class)->names([
        'index' => 'thesis-tasks.index',
        'create' => 'thesis-tasks.create',
        'store' => 'thesis-tasks.store',
        'show' => 'thesis-tasks.show',
        'edit' => 'thesis-tasks.edit',
        'update' => 'thesis-tasks.update',
        'destroy' => 'thesis-tasks.destroy'
    ]);

    Route::get('/applications', [ThesisTaskController::class, 'applications'])
        ->name('thesis-tasks.applications');

    Route::put('/approve/{task}/{student}', [ThesisTaskController::class, 'approve'])
        ->name('thesis-tasks.approve');
});

// Student routes
Route::middleware(['checkRole:student'])->group(function () {
    Route::get('/available-tasks', [ThesisTaskController::class, 'available'])
        ->name('thesis-tasks.available');

    Route::post('/apply/{task}', [ThesisTaskController::class, 'apply'])
        ->name('thesis-tasks.apply');
});




require __DIR__ . '/auth.php';
