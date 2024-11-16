<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\StaticController::class, 'home'])->name('static.home');
Route::get('/', [\App\Http\Controllers\StaticController::class, 'home'])->name('welcome');
Route::get('/about', [\App\Http\Controllers\StaticController::class, 'about'])->name('about');
Route::get('/contact', [\App\Http\Controllers\StaticController::class, 'contact'])->name('contact');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('users', UserController::class);
//    ->only(['index','edit','update','destroy']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
