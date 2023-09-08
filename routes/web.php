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
    Route::post('/checkname/AromaticBitters', [CheckNameController::class, 'checkNameAromaticBitters'])->name('check.AromaticBitters');

    //rotta ingredienti
    Route::get('ingredients', [AllIngredientController::class, 'index'])->name('ingredients.index');

    //rotte di alcools category 
    Route::get('ingredients/alcools/{category}', [AlcoolCategoryController::class, 'index'])->name('ingredients.alcools.category.index');
    Route::get('ingredients/alcools/category/create', [AlcoolCategoryController::class, 'create'])->name('ingredients.alcoolscategory.create');
    Route::post('ingredients/alcools/category/store', [AlcoolCategoryController::class, 'store'])->name('ingredients.alcoolscategory.store');
    Route::get('ingredients/alcools/category/{categoryName}/edit', [AlcoolCategoryController::class, 'edit'])->name('ingredients.alcoolscategory.edit');
    Route::put('ingredients/alcools/category/{categoryName}', [AlcoolCategoryController::class, 'update'])->name('ingredients.alcoolscategory.update');
    Route::delete('ingredients/alcools/category/{categoryName}', [AlcoolCategoryController::class, 'destroy'])->name('ingredients.alcoolscategory.destroy');

    //rotta show speciale per alcools
    Route::get('ingredients/alcools', [AlcoolController::class, 'index'])->name('ingredients.alcools.index');
    Route::get('ingredients/alcools/{category}/{slug}', [AlcoolController::class, 'show'])->name('ingredients.alcools.show');
    Route::get('alcools/create', [AlcoolController::class, 'create'])->name('alcools.create');
    Route::post('ingredients/alcools/store', [AlcoolController::class, 'store'])->name('ingredients.alcools.store');
    Route::get('ingredients/alcools/{category}/{slug}/edit', [AlcoolController::class, 'edit'])->name('ingredients.alcools.edit');
    Route::put('ingredients/alcools/{alcools}', [AlcoolController::class, 'update'])->name('ingredients.alcools.update');
    Route::delete('ingredients/alcools/{alcools}', [AlcoolController::class, 'destroy'])->name('ingredients.alcools.destroy');
    
    //rotta show speciale per bitter
    Route::get('ingredients/aromatic_bitters', [AromaticBitterController::class, 'index'])->name('ingredients.aromatic_bitters.index');
    Route::get('ingredients/aromatic_bitters/{slug}', [AromaticBitterController::class, 'show'])->name('ingredients.aromatic_bitters.show');
    Route::post('aromatic_bitters/store', [AromaticBitterController::class, 'store'])->name('aromatic_bitters.store');
    Route::get('aromatic_bitters/create', [AromaticBitterController::class, 'create'])->name('aromatic_bitters.create');
    Route::get('ingredients/aromatic_bitters/{slug}/edit', [AromaticBitterController::class, 'edit'])->name('ingredients.aromatic_bitters.edit');
    Route::put('ingredients/aromatic_bitters/{aromatic_bitters}', [AromaticBitterController::class, 'update'])->name('ingredients.aromatic_bitters.update');
    Route::delete('ingredients/aromatic_bitters/{aromatic_bitters}', [AromaticBitterController::class, 'destroy'])->name('ingredients.aromatic_bitters.destroy');

    // Rotte per i frutti
    Route::get('ingredients/fruits', [FruitController::class, 'index'])->name('ingredients.fruits.index');
    Route::post('ingredients/fruits/store', [FruitController::class, 'store'])->name('ingredients.fruits.store');
    Route::get('ingredients/fruits/{slug}', [FruitController::class, 'show'])->name('ingredients.fruits.show');

    // Rotte per i succhi 
    Route::get('ingredients/juices', [JuiceController::class, 'index'])->name('ingredients.juices.index');
    Route::post('ingredients/juices/store', [JuiceController::class, 'store'])->name('ingredients.juices.store');
    Route::get('ingredients/juices/{slug}', [JuiceController::class, 'show'])->name('ingredients.juices.show');

    // Rotte per gli Altri Ingredienti
    Route::get('ingredients/others', [OtherController::class, 'index'])->name('ingredients.others.index');
    Route::post('ingredients/others/store', [OtherController::class, 'store'])->name('ingredients.others.store');
    Route::get('ingredients/others/{slug}', [OtherController::class, 'show'])->name('ingredients.others.show');

    // Rotte per le Bibite Analcoliche (Sodas)
    Route::get('ingredients/sodas', [SodaController::class, 'index'])->name('ingredients.sodas.index');
    Route::post('ingredients/sodas/store', [SodaController::class, 'store'])->name('ingredients.sodas.store');
    Route::get('ingredients/sodas/{slug}', [SodaController::class, 'show'])->name('ingredients.sodas.show');

    // Rotte per gli Zuccheri
    Route::get('ingredients/sugars', [SugarController::class, 'index'])->name('ingredients.sugars.index');
    Route::post('ingredients/sugars/store', [SugarController::class, 'store'])->name('ingredients.sugars.store');
    Route::get('ingredients/sugars/{slug}', [SugarController::class, 'show'])->name('ingredients.sugars.show');
    
    // Rotte per gli Sciroppi
    Route::get('ingredients/syrups', [SyrupController::class, 'index'])->name('ingredients.syrups.index');
    Route::post('ingredients/syrups/store', [SyrupController::class, 'store'])->name('ingredients.syrups.store');
    Route::get('ingredients/syrups/{slug}', [SyrupController::class, 'show'])->name('ingredients.syrups.show');
    
    
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
