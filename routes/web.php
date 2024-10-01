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
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/todos', [todosController::class, 'index'])->name('todo.home');

    
    Route::get('/create', function () {
        return view('create');
    })->name("todo.create");

    
    Route::get('/edit/{id}', [todosController::class, 'edit'])->name("todo.edit");


    Route::post('/update', [todosController::class, 'updateData'])->name("todo.updateData");

    
    Route::post('/create', [todosController::class, 'store'])->name("todo.store");

    
    Route::get('/delete/{id}', [todosController::class, 'delete'])->name("todo.delete");
});


require __DIR__.'/auth.php';
