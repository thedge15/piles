<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/openPage')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'openPage'])->name('openPage');
        Route::get('/{bush}', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    });
    Route::prefix('/materials')->group(function () {
        Route::get('/', [\App\Http\Controllers\MaterialController::class, 'showAll'])->name('all');
        Route::get('/{project}', [\App\Http\Controllers\MaterialController::class, 'materials'])->name('dashboard.materials');
        Route::post('/', [\App\Http\Controllers\MaterialController::class, 'storeMaterials'])->name('store.materials');
        Route::patch('/{material}', [\App\Http\Controllers\MaterialController::class, 'updateMaterial'])->name('update.materials');
        Route::delete('/{material}', [\App\Http\Controllers\MaterialController::class, 'deleteMaterial'])->name('destroy.material');
    });
    Route::prefix('/elements')->group(function () {
        Route::get('/', [\App\Http\Controllers\ElementController::class, 'index'])->name('index.elements');
        Route::post('/', [\App\Http\Controllers\ElementController::class, 'create'])->name('create.elements');
        Route::delete('/{element}', [\App\Http\Controllers\ElementController::class, 'deleteElement'])->name('destroy.element');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('/bushes')->group(function () {
        Route::post('/', [\App\Http\Controllers\BushController::class, 'store'])->name('bush.store');
        Route::delete('/{bush}', [\App\Http\Controllers\BushController::class, 'destroy'])->name('bush.destroy');
        Route::prefix('/projects')->group(function () {
            Route::post('/', [\App\Http\Controllers\BushController::class, 'projectStore'])->name('project.store');
            Route::patch('/{project}', [\App\Http\Controllers\BushController::class, 'projectChangeUpdate'])->name('project.update');
            Route::delete('/{project}', [\App\Http\Controllers\BushController::class, 'projectDestroy'])->name('project.destroy');
        });
    });
    Route::prefix('/paints')->group(function () {
        Route::get('/', [\App\Http\Controllers\PaintController::class, 'index'])->name('paint.index');
        Route::post('/', [\App\Http\Controllers\PaintController::class, 'store'])->name('paint.store');
        Route::delete('/{paint}', [\App\Http\Controllers\PaintController::class, 'destroy'])->name('paint.destroy');
    });
    Route::prefix('/metal')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpecificationController::class, 'metal'])->name('metal.index');
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeMetal'])->name('metal.store');
        Route::get('/{metal}', [\App\Http\Controllers\SpecificationController::class, 'showMetal'])->name('metal.show');
        Route::delete('/{metal}', [\App\Http\Controllers\SpecificationController::class, 'destroyMetal'])->name('metal.destroy');
    });
    Route::prefix('/characteristic')->group(function () {
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeCharacteristic'])->name('characteristic.store');
        Route::patch('/{characteristic}', [\App\Http\Controllers\SpecificationController::class, 'updateCharacteristic'])->name('characteristic.update');
        Route::delete('/{characteristic}', [\App\Http\Controllers\SpecificationController::class, 'destroyCharacteristic'])->name('characteristic.destroy');
    });
    Route::prefix('/standard')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpecificationController::class, 'standard'])->name('standard.index');
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeStandard'])->name('standard.store');
        Route::delete('/{standard}', [\App\Http\Controllers\SpecificationController::class, 'destroyStandard'])->name('standard.destroy');
    });
    Route::prefix('/steel')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpecificationController::class, 'steel'])->name('steel.index');
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeSteel'])->name('steel.store');
        Route::delete('/{steel}', [\App\Http\Controllers\SpecificationController::class, 'destroySteel'])->name('steel.destroy');
    });
    Route::prefix('/units')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpecificationController::class, 'units'])->name('unit.index');
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeUnits'])->name('unit.store');
        Route::delete('/{unit}', [\App\Http\Controllers\SpecificationController::class, 'destroyUnit'])->name('unit.destroy');
    });
    Route::prefix('/piles')->group(function () {
        Route::post('/', [\App\Http\Controllers\PileController::class, 'store'])->name('pile.store');
        Route::get('/{project}', [\App\Http\Controllers\PileController::class, 'show'])->name('pile.show');
        Route::patch('/{pile}', [\App\Http\Controllers\PileController::class, 'update'])->name('pile.update');
        Route::post('/calculate', [\App\Http\Controllers\PileController::class, 'calculate'])->name('pile.calculate');
        Route::delete('/{pile}', [\App\Http\Controllers\PileController::class, 'destroy'])->name('pile.destroy');
    });
    Route::prefix('/tubes')->group(function () {
        Route::get('/', [\App\Http\Controllers\TubeController::class, 'index'])->name('tube.index');
        Route::post('/', [\App\Http\Controllers\TubeController::class, 'store'])->name('tube.store');
        Route::get('/{tube}', [\App\Http\Controllers\TubeController::class, 'show'])->name('tube.show');
        Route::delete('/{tube}', [\App\Http\Controllers\TubeController::class, 'destroy'])->name('tube.destroy');
    });
});

require __DIR__ . '/auth.php';
