<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\todosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/zakimlih', [UserController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//homepage todo route
Route::get('/',[todosController::class, 'index'])->name("todo.home");

//create todo route
Route::get('/create', function () {
    return view('create');
})->name("todo.create");

//edit todo route
Route::get('/edit/{id}',[todosController::class,'edit'])->name("todo.edit");

//update todo route
Route::post('/update', [todosController::class,'updateData'])->name("todo.updateData");

//store todo route
Route::post('/create', [todosController::class,'store'])->name("todo.store");

//delete toto route
Route::get('/delete/{id}', [todosController::class,'delete'])->name("todo.delete");
require __DIR__.'/auth.php';
