<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\todosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        
        return redirect()->route('todo.home');
    }
    return redirect()->route('register');
})->middleware('web');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Homepage Todo route
    Route::get('/todos', [todosController::class, 'index'])->name('todo.home');

    // Create Todo route
    Route::get('/create', function () {
        return view('create');
    })->name("todo.create");

    // Edit Todo route
    Route::get('/edit/{id}', [todosController::class, 'edit'])->name("todo.edit");

    // Update Todo route
    Route::post('/update', [todosController::class, 'updateData'])->name("todo.updateData");

    // Store Todo route
    Route::post('/create', [todosController::class, 'store'])->name("todo.store");

    // Delete Todo route
    Route::get('/delete/{id}', [todosController::class, 'delete'])->name("todo.delete");
});

// Authentication routes (Breeze)
require __DIR__.'/auth.php';
