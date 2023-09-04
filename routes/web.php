<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AllIngredientController;
use App\Http\Controllers\AlcoolController;
use App\Http\Controllers\AromaticBitterController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\JuiceController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\SodaController;
use App\Http\Controllers\SugarController;
use App\Http\Controllers\SyrupController;

use App\Models\Alcool;

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

    Route::get('/ingredients', [AllIngredientController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/alcool', [AlcoolController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/aromatic_bitter', [AromaticBitterController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/fruit', [FruitController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/juice', [JuiceController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/other', [OtherController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/soda', [SodaController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/sugar', [SugarController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/syrup', [SyrupController::class, 'index'])->name('ingredients.index');
});

require __DIR__.'/auth.php';
