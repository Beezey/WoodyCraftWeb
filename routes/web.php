<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\computerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Panier : accessible sans connexion (panier rattaché à la session du visiteur)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{computer}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/items/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

// Gestion des ordinateurs : réservée à l'administrateur
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/computers/{computer}/duplicate', [computerController::class, 'duplicate'])
        ->name('computers.duplicate');

    Route::resource('computers', computerController::class)->except('show');
});

// Page d'un ordinateur : accessible sans connexion (déclarée après /computers/create)
Route::get('/computers/{computer}', [computerController::class, 'show'])->name('computers.show');

require __DIR__.'/auth.php';
