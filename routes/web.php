<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JokeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

//Route::get('/', [\App\Http\Controllers\StaticController::class, 'home'])->name('static.home');
Route::get('/', [\App\Http\Controllers\StaticController::class, 'home'])->name('welcome');
Route::get('/about', [\App\Http\Controllers\StaticController::class, 'about'])->name('about');
Route::get('/contact', [\App\Http\Controllers\StaticController::class, 'contact'])->name('contact');

Route::get('/jokes', [\App\Http\Controllers\JokeController::class, 'jokes'])->name('jokes.index');
Route::get('/jokes/{joke}/edit', [JokeController::class, 'edit'])->name('jokes.edit');
Route::patch('/jokes/{joke}', [JokeController::class, 'update'])->name('jokes.update');
Route::get('jokes/search', [JokeController::class, 'search'])->name('jokes.search');
Route::get('jokes/create', [CategoryController::class, 'index'])->name('jokes.create');

Route::get('/users', [\App\Http\Controllers\UserController::class, 'users'])->name('users.index');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users/trash', [UserController::class, 'trash'])->name('users.trash');
Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::delete('users/{user}/forceDelete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

Route::resource('users', UserController::class);
//    ->only(['index','edit','update','destroy']);

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->except(['index', 'show', 'edit', 'update', 'create', 'destroy']);
});

Route::get('/jokes/trash', [JokeController::class, 'trash'])->name('jokes.trash');
Route::patch('jokes/{joke}/restore', [JokeController::class, 'restore'])->name('jokes.restore');
Route::delete('jokes/{joke}/forceDelete', [JokeController::class, 'forceDelete'])->name('jokes.forceDelete');

Route::resource('jokes', JokeController::class);

Route::middleware('auth')->group(function () {
    Route::resource('jokes', JokeController::class)->except(['index']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('users/{user}/permissions', [UserController::class, 'editPermissions'])->name('users.editPermissions');
    Route::post('users/{user}/permissions', [UserController::class, 'updatePermissions'])->name('users.updatePermissions');

    Route::get('users/create', [RoleController::class, 'create'])->name('users.create');
    Route::post('users', [RoleController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [RoleController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [RoleController::class, 'update'])->name('users.update');

});


require __DIR__.'/auth.php';

