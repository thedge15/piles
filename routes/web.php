<?php

use App\Http\Controllers\BushController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PaintController;
use App\Http\Controllers\PileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'welcome'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/openPage')->group(function () {
        Route::get('/', [UserController::class, 'openPage'])->name('openPage');
        Route::get('/{bush}', [UserController::class, 'index'])->name('user.index');
    });
    Route::prefix('/materials')->group(function () {
        Route::get('/', [MaterialController::class, 'showAll'])->name('all');
        Route::get('/{project}', [MaterialController::class, 'materials'])->name('dashboard.materials');
        Route::post('/', [MaterialController::class, 'storeMaterials'])->name('store.material');
        Route::patch('/{material}', [MaterialController::class, 'updateMaterial'])->name('update.material');
        Route::delete('/{material}', [MaterialController::class, 'deleteMaterial'])->name('destroy.material');
        Route::get('/export/{project}', [MaterialController::class, 'export'])->name('export');
    });
    Route::prefix('/elements')->group(function () {
        Route::get('/', [ElementController::class, 'index'])->name('index.elements');
        Route::post('/', [ElementController::class, 'store'])->name('store.element');
        Route::patch('/{element}', [ElementController::class, 'update'])->name('update.element');
        Route::delete('/{element}', [ElementController::class, 'delete'])->name('destroy.element');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard');
    Route::prefix('/bushes')->group(function () {
        Route::post('/', [BushController::class, 'storeBush'])->name('store.bush');
        Route::delete('/{bush}', [BushController::class, 'destroy'])->name('destroy.bush');
        Route::prefix('/projects')->group(function () {
            Route::post('/', [BushController::class, 'projectStore'])->name('store.project');
            Route::patch('/{project}', [BushController::class, 'projectUpdate'])->name('update.project');
            Route::delete('/{project}', [BushController::class, 'projectDestroy'])->name('destroy.project');
        });
    });
    Route::prefix('/paint')->group(function () {
        Route::get('/', [PaintController::class, 'index'])->name('paint.index');
        Route::post('/', [PaintController::class, 'store'])->name('store.paint');
        Route::patch('/{paint}', [PaintController::class, 'update'])->name('update.paint');
        Route::delete('/{paint}', [PaintController::class, 'destroy'])->name('destroy.paint');
    });
    Route::prefix('/metal')->group(function () {
        Route::get('/', [SpecificationController::class, 'metal'])->name('metal.index');
        Route::post('/', [SpecificationController::class, 'storeMetal'])->name('store.metal');
        Route::get('/{metal}', [SpecificationController::class, 'showMetal'])->name('metal.show');
        Route::patch('/{metal}', [SpecificationController::class, 'metalUpdate'])->name('update.metal');
        Route::delete('/{metal}', [SpecificationController::class, 'destroyMetal'])->name('destroy.metal');
    });
    Route::prefix('/characteristic')->group(function () {
        Route::post('/', [SpecificationController::class, 'storeCharacteristic'])->name('store.characteristic');
        Route::patch('/{characteristic}', [SpecificationController::class, 'updateCharacteristic'])->name('update.characteristic');
        Route::delete('/{characteristic}', [SpecificationController::class, 'destroyCharacteristic'])->name('destroy.characteristic');
    });
    Route::prefix('/standard')->group(function () {
        Route::get('/', [SpecificationController::class, 'standard'])->name('standard.index');
        Route::post('/', [SpecificationController::class, 'storeStandard'])->name('store.standard');
        Route::patch('/{standard}', [SpecificationController::class, 'standardUpdate'])->name('update.standard');
        Route::delete('/{standard}', [SpecificationController::class, 'destroyStandard'])->name('destroy.standard');
    });
    Route::prefix('/steel')->group(function () {
        Route::get('/', [SpecificationController::class, 'steel'])->name('steel.index');
        Route::post('/', [SpecificationController::class, 'storeSteel'])->name('store.steel');
        Route::patch('/{steel}', [SpecificationController::class, 'steelUpdate'])->name('update.steel');
        Route::delete('/{steel}', [SpecificationController::class, 'destroySteel'])->name('destroy.steel');
    });
    Route::prefix('/unit')->group(function () {
        Route::get('/', [SpecificationController::class, 'unit'])->name('unit.index');
        Route::post('/', [SpecificationController::class, 'storeUnit'])->name('store.unit');
        Route::patch('/{unit}', [SpecificationController::class, 'unitUpdate'])->name('update.unit');
        Route::delete('/{unit}', [SpecificationController::class, 'destroyUnit'])->name('destroy.unit');
    });
    Route::prefix('/piles')->group(function () {
        Route::post('/', [PileController::class, 'store'])->name('pile.store');
        Route::get('/{project}', [PileController::class, 'show'])->name('pile.show');
        Route::patch('/{pile}', [PileController::class, 'update'])->name('pile.update');
        Route::post('/calculate', [PileController::class, 'calculate'])->name('pile.calculate');
        Route::delete('/{pile}', [PileController::class, 'destroy'])->name('pile.destroy');
    });
});

require __DIR__ . '/auth.php';
