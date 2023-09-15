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
    Route::post('/checkname/Sodas', [CheckNameController::class, 'checkNameSodas'])->name('check.Sodas');
    Route::post('/checkname/juices', [CheckNameController::class, 'checkNameJuices'])->name('check.Juices');
    Route::post('/checkname/fruits', [CheckNameController::class, 'checkNameFruits'])->name('check.Fruits');
    Route::post('/checkname/others', [CheckNameController::class, 'checkNameOthers'])->name('check.Others');
    Route::post('/checkname/syrups', [CheckNameController::class, 'checkNameSyrups'])->name('check.Syrups');
    Route::post('/checkname/sugars', [CheckNameController::class, 'checkNameSugars'])->name('check.Sugars');
    Route::post('/checkname/glass', [CheckNameController::class, 'checkNameGlass'])->name('check.Glass');
    Route::post('/checkname/equipement', [CheckNameController::class, 'checkNameEquipement'])->name('check.Equipement');
    Route::post('/checkname/ice', [CheckNameController::class, 'checkNameIce'])->name('check.Ice');

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
    Route::get('fruits/create', [FruitController::class, 'create'])->name('fruits.create');
    Route::post('fruits/store', [FruitController::class, 'store'])->name('fruits.store');
    Route::get('ingredients/fruits/{fruits}/edit', [FruitController::class, 'edit'])->name('ingredients.fruits.edit');
    Route::put('ingredients/fruits/{fruits}', [FruitController::class, 'update'])->name('ingredients.fruits.update');
    Route::delete('ingredients/fruits/{fruits}', [FruitController::class, 'destroy'])->name('ingredients.fruits.destroy');

    // Rotte per i succhi 
    Route::get('ingredients/juices', [JuiceController::class, 'index'])->name('ingredients.juices.index');
    Route::get('juices/create', [JuiceController::class, 'create'])->name('juices.create');
    Route::post('juices/store', [JuiceController::class, 'store'])->name('juices.store');
    Route::get('ingredients/juices/{juices}/edit', [JuiceController::class, 'edit'])->name('ingredients.juices.edit');
    Route::put('ingredients/juices/{juices}', [JuiceController::class, 'update'])->name('ingredients.juices.update');
    Route::delete('ingredients/juices/{juices}', [JuiceController::class, 'destroy'])->name('ingredients.juices.destroy');

    // Rotte per gli Altri Ingredienti
    Route::get('ingredients/others', [OtherController::class, 'index'])->name('ingredients.others.index');
    Route::get('others/create', [OtherController::class, 'create'])->name('others.create');
    Route::post('others/store', [OtherController::class, 'store'])->name('others.store');
    Route::get('ingredients/others/{others}/edit', [OtherController::class, 'edit'])->name('ingredients.others.edit');
    Route::put('ingredients/others/{others}', [OtherController::class, 'update'])->name('ingredients.others.update');
    Route::delete('ingredients/others/{others}', [OtherController::class, 'destroy'])->name('ingredients.others.destroy');

    // Rotte per le Bibite Analcoliche (Sodas)
    Route::get('ingredients/sodas', [SodaController::class, 'index'])->name('ingredients.sodas.index');
    Route::get('sodas/create', [SodaController::class, 'create'])->name('sodas.create');
    Route::post('sodas/store', [SodaController::class, 'store'])->name('sodas.store');
    Route::get('ingredients/sodas/{slug}', [SodaController::class, 'show'])->name('ingredients.sodas.show');
    Route::get('ingredients/sodas/{slug}/edit', [SodaController::class, 'edit'])->name('ingredients.sodas.edit');
    Route::put('ingredients/sodas/{sodas}', [SodaController::class, 'update'])->name('ingredients.sodas.update');
    Route::delete('ingredients/sodas/{sodas}', [SodaController::class, 'destroy'])->name('ingredients.sodas.destroy');

    // Rotte per gli Zuccheri
    Route::get('ingredients/sugars', [SugarController::class, 'index'])->name('ingredients.sugars.index');
    Route::get('sugars/create', [SugarController::class, 'create'])->name('sugars.create');
    Route::post('sugars/store', [SugarController::class, 'store'])->name('sugars.store');
    Route::get('ingredients/sugars/{slug}', [SugarController::class, 'show'])->name('ingredients.sugars.show');
    Route::get('ingredients/sugars/{slug}/edit', [SugarController::class, 'edit'])->name('ingredients.sugars.edit');
    Route::put('ingredients/sugars/{sugars}', [SugarController::class, 'update'])->name('ingredients.sugars.update');
    Route::delete('ingredients/sugars/{sugars}', [SugarController::class, 'destroy'])->name('ingredients.sugars.destroy');

    // Rotte per gli Sciroppi
    Route::get('ingredients/syrups', [SyrupController::class, 'index'])->name('ingredients.syrups.index');
    Route::get('syrups/create', [SyrupController::class, 'create'])->name('syrups.create');
    Route::post('syrups/store', [SyrupController::class, 'store'])->name('syrups.store');
    Route::get('ingredients/syrups/{syrups}/edit', [SyrupController::class, 'edit'])->name('ingredients.syrups.edit');
    Route::put('ingredients/syrups/{syrups}', [SyrupController::class, 'update'])->name('ingredients.syrups.update');
    Route::delete('ingredients/syrups/{syrups}', [SyrupController::class, 'destroy'])->name('ingredients.syrups.destroy');
    
    Route::get('items', [AllItemsController::class, 'index'])->name('items.index');

    Route::get('items/equipements', [EquipementController::class, 'index'])->name('items.equipements.index');
    Route::get('equipements/create', [EquipementController::class, 'create'])->name('equipements.create');
    Route::post('equipements/store', [EquipementController::class, 'store'])->name('equipements.store');
    Route::get('items/equipements/{slug}', [EquipementController::class, 'show'])->name('items.equipements.show');
    Route::get('items/equipements/{slug}/edit', [EquipementController::class, 'edit'])->name('items.equipements.edit');
    Route::put('items/equipements/{equipements}', [EquipementController::class, 'update'])->name('items.equipements.update');
    Route::delete('items/equipements/{equipements}', [EquipementController::class, 'destroy'])->name('items.equipements.destroy');
    
    Route::get('items/ices', [IceController::class, 'index'])->name('items.ices.index');
    Route::get('ices/create', [IceController::class, 'create'])->name('ices.create');
    Route::post('ices/store', [IceController::class, 'store'])->name('ices.store');
    Route::get('items/ices/{slug}', [IceController::class, 'show'])->name('items.ices.show');
    Route::get('items/ices/{slug}/edit', [IceController::class, 'edit'])->name('items.ices.edit');
    Route::put('items/ices/{ices}', [IceController::class, 'update'])->name('items.ices.update');
    Route::delete('items/ices/{ices}', [IceController::class, 'destroy'])->name('items.ices.destroy');
    
    Route::get('/items/glasses', [GlassController::class, 'index'])->name('items.glasses.index');
    Route::get('glasses/create', [GlassController::class, 'create'])->name('glasses.create');
    Route::post('glasses/store', [GlassController::class, 'store'])->name('glasses.store');
    Route::get('items/glasses/{slug}', [GlassController::class, 'show'])->name('items.glasses.show');
    Route::get('items/glasses/{slug}/edit', [GlassController::class, 'edit'])->name('items.glasses.edit');
    Route::put('items/glasses/{glasses}', [GlassController::class, 'update'])->name('items.glasses.update');
    Route::delete('items/glasses/{glasses}', [GlassController::class, 'destroy'])->name('items.glasses.destroy');
    
    
    // Route::prefix('items')->name('items.')->group(function () {
    //     Route::get('/', [AllItemsController::class, 'index'])->name('index');

    //     $itemTypes = [
    //         'equipements' => EquipementController::class,
    //         'ices' => IceController::class,
    //         'glasses' => GlassController::class,
    //     ];

    //     foreach ($itemTypes as $type => $controller) {
    //         Route::prefix($type)->name($type . '.')->group(function () use ($controller) {
    //             Route::get('/', [$controller, 'index'])->name('index');
    //             Route::get('/{slug}', [$controller, 'show'])->name('show');
    //         });
    //     }
    // });

    Route::resource('cocktails', CocktailController::class)->parameters(['cocktails' => 'slug']);
});

require __DIR__.'/auth.php';
