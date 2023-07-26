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
    return Inertia::render('openPage', [
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
        Route::get('/export/{project}', [\App\Http\Controllers\MaterialController::class, 'export'])->name('export');
    });
    Route::prefix('/elements')->group(function () {
        Route::get('/', [\App\Http\Controllers\ElementController::class, 'index'])->name('index.elements');
        Route::post('/', [\App\Http\Controllers\ElementController::class, 'storeElement'])->name('store.element');
        Route::delete('/{element}', [\App\Http\Controllers\ElementController::class, 'deleteElement'])->name('destroy.element');
//        Route::get('/export/{project}', [\App\Http\Controllers\ElementController::class, 'export'])->name('export');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('/bushes')->group(function () {
        Route::post('/', [\App\Http\Controllers\BushController::class, 'storeBush'])->name('store.bush');
        Route::delete('/{bush}', [\App\Http\Controllers\BushController::class, 'destroy'])->name('destroy.bush');
        Route::prefix('/projects')->group(function () {
            Route::post('/', [\App\Http\Controllers\BushController::class, 'projectStore'])->name('store.project');
            Route::patch('/{project}', [\App\Http\Controllers\BushController::class, 'projectChangeUpdate'])->name('project.update');
            Route::delete('/{project}', [\App\Http\Controllers\BushController::class, 'projectDestroy'])->name('destroy.project');
        });
    });
    Route::prefix('/paint')->group(function () {
        Route::get('/', [\App\Http\Controllers\PaintController::class, 'index'])->name('paint.index');
        Route::post('/', [\App\Http\Controllers\PaintController::class, 'store'])->name('store.paint');
        Route::delete('/{paint}', [\App\Http\Controllers\PaintController::class, 'destroy'])->name('destroy.paint');
    });
    Route::prefix('/metal')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpecificationController::class, 'metal'])->name('metal.index');
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeMetal'])->name('store.metal');
        Route::get('/{metal}', [\App\Http\Controllers\SpecificationController::class, 'showMetal'])->name('metal.show');
        Route::delete('/{metal}', [\App\Http\Controllers\SpecificationController::class, 'destroyMetal'])->name('destroy.metal');
    });
    Route::prefix('/characteristic')->group(function () {
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeCharacteristic'])->name('store.characteristic');
        Route::patch('/{characteristic}', [\App\Http\Controllers\SpecificationController::class, 'updateCharacteristic'])->name('update.characteristic');
        Route::delete('/{characteristic}', [\App\Http\Controllers\SpecificationController::class, 'destroyCharacteristic'])->name('destroy.characteristic');
    });
    Route::prefix('/standard')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpecificationController::class, 'standard'])->name('standard.index');
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeStandard'])->name('store.standard');
        Route::delete('/{standard}', [\App\Http\Controllers\SpecificationController::class, 'destroyStandard'])->name('destroy.standard');
    });
    Route::prefix('/steel')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpecificationController::class, 'steel'])->name('steel.index');
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeSteel'])->name('store.steel');
        Route::delete('/{steel}', [\App\Http\Controllers\SpecificationController::class, 'destroySteel'])->name('destroy.steel');
    });
    Route::prefix('/unit')->group(function () {
        Route::get('/', [\App\Http\Controllers\SpecificationController::class, 'unit'])->name('unit.index');
        Route::post('/', [\App\Http\Controllers\SpecificationController::class, 'storeUnit'])->name('store.unit');
        Route::delete('/{unit}', [\App\Http\Controllers\SpecificationController::class, 'destroyUnit'])->name('destroy.unit');
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
