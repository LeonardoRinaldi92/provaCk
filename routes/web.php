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

use App\Http\Controllers\CocktailController;

use App\Http\Controllers\AlcoolCategoryController;

use App\Http\Controllers\CheckNameController;

use App\Models\Alcool;
use App\Models\AromaticBitter;

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

    //rotta controller per il check in live dei record
    Route::post('/checkname/AlcoolCategory', [CheckNameController::class, 'checkNameAlcoolCategory'])->name('check.AlcoolCategory');
    Route::post('/checkname/Alcools', [CheckNameController::class, 'checkNameAlcools'])->name('check.Alcools');

    //rotte di alcools category 
    Route::get('ingredients/alcools/{category}', [AlcoolCategoryController::class, 'index'])->name('ingredients.alcools.category.index');
    Route::get('ingredients/alcools/category/create', [AlcoolCategoryController::class, 'create'])->name('ingredients.alcoolscategory.create');
    Route::post('ingredients/alcools/category/store', [AlcoolCategoryController::class, 'store'])->name('ingredients.alcoolscategory.store');
    Route::get('ingredients/alcools/category/{categoryName}/edit', [AlcoolCategoryController::class, 'edit'])->name('ingredients.alcoolscategory.edit');
    Route::put('ingredients/alcools/category/{categoryName}', [AlcoolCategoryController::class, 'update'])->name('ingredients.alcoolscategory.update');
    Route::delete('ingredients/alcools/category/{categoryName}', [AlcoolCategoryController::class, 'destroy'])->name('ingredients.alcoolscategory.destroy');


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
                Route::post('/store', [$controller, 'store'])->name('store');
                // Check the controller name to decide whether to add the "show" route
                if ($controller !== FruitController::class && $controller !== SyrupController::class && $controller !== AlcoolController::class) {
                    Route::get('/{slug}', [$controller, 'show'])->name('show');
                }
            });
        }
    });
    
    //rotta show speciale per alcools
    Route::get('alcools/create', [AlcoolController::class, 'create'])->name('alcools.create');
    Route::get('ingredients/alcools/{category}/{slug}', [AlcoolController::class, 'show'])->name('ingredients.alcools.show');
    Route::get('ingredients/alcools/{category}/{slug}/edit', [AlcoolController::class, 'edit'])->name('ingredients.alcools.edit');
    Route::put('ingredients/alcools/{alcools}', [AlcoolController::class, 'update'])->name('ingredients.alcools.update');
    Route::delete('ingredients/alcools/{alcools}', [AlcoolController::class, 'destroy'])->name('ingredients.alcools.destroy');

    Route::get('aromatic_bitters/create', [AromaticBitter::class, 'create'])->name('aromatic_bitters.create');
    Route::get('ingredients/aromatic_bitters/{slug}/edit', [AromaticBitterController::class, 'edit'])->name('ingredients.aromatic_bitters.edit');
    Route::put('ingredients/aromatic_bitters/{aromatic_bitters}', [AromaticBitterController::class, 'update'])->name('ingredients.aromatic_bitters.update');
    Route::delete('ingredients/aromatic_bitters/{aromatic_bitters}', [AromaticBitterController::class, 'destroy'])->name('ingredients.ingredients.destroy');



    Route::prefix('items')->name('items.')->group(function () {
        Route::get('/', [AllItemsController::class, 'index'])->name('index');

        $itemTypes = [
            'equipements' => EquipementController::class,
            'ices' => IceController::class,
            'glasses' => GlassController::class,
        ];

        foreach ($itemTypes as $type => $controller) {
            Route::prefix($type)->name($type . '.')->group(function () use ($controller) {
                Route::get('/', [$controller, 'index'])->name('index');
                Route::get('/{slug}', [$controller, 'show'])->name('show');
            });
        }
    });

    Route::resource('cocktails', CocktailController::class)->parameters(['cocktails' => 'slug']);
});

require __DIR__.'/auth.php';
