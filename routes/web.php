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

use App\Http\Controllers\AllItemsController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\GlassController;
use App\Http\Controllers\IceController;
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

    Route::prefix('ingredients')->name('ingredients.')->group(function () {
        Route::get('/', [AllIngredientController::class, 'index'])->name('index');
        
        // Rotte per i tipi di ingredienti specifici
        $ingredientTypes = [
            'alcools' => AlcoolController::class,
            'aromatic_bitters' => AromaticBitterController::class,
            'fruits' => FruitController::class,
            'juices' => JuiceController::class,
            'others' => OtherController::class,
            'sodas' => SodaController::class,
            'sugars' => SugarController::class,
            'syrups' => SyrupController::class,
        ];

        foreach ($ingredientTypes as $type => $controller) {
            Route::prefix($type)->name($type . '.')->group(function () use ($controller) {
                Route::get('/', [$controller, 'index'])->name('index');
                // Check the controller name to decide whether to add the "show" route
                if ($controller !== FruitsController::class && $controller !== SyrupController::class) {
                    Route::get('/{slug}', [$controller, 'show'])->name('show');
                }
            });
        }
    });

    Route::prefix('items')->name('items.')->group(function () {
        Route::get('/', [AllItemsController::class, 'index'])->name('index');

        $itemTypes = [
            'equipements' => EquipementController::class,
            'ices' => IceController::class,
            'glasses' => GlassController::class
        ];

        foreach ($itemTypes as $type => $controller) {
            Route::prefix($type)->name($type . '.')->group(function () use ($controller) {
                Route::get('/', [$controller, 'index'])->name('index');
                Route::get('/{slug}', [$controller, 'show'])->name('show');
            });
        };

    });


});

require __DIR__.'/auth.php';
