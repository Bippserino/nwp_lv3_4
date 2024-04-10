<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $projects = $user->projects;
    return view('dashboard', ['projects' => $projects, 'user' => $user]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('dashboard/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('dashboard/create', [ProjectController::class, 'store'])->name('project.store');
Route::get('/dashboard/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
Route::put('/dashboard/update/{id}', [ProjectController::class, 'update'])->name('project.update');
Route::delete('/dashboard/delete/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');


require __DIR__.'/auth.php';
