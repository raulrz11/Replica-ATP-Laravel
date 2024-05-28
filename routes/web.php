<?php

use App\Http\Controllers\TenistasController;
use App\Http\Controllers\TorneosController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TenistasController::class, 'index']);

Route::prefix('tenistas')->group(function (){
    Route::get('/', [TenistasController::class, 'index'])->name('tenistas.index');
    Route::get('/create', [TenistasController::class, 'create'])->name('tenistas.create');
    Route::get('/edit/{tenista}', [TenistasController::class, 'edit'])->name('tenistas.edit');
    Route::get('/image/{tenista}', [TenistasController::class, 'editImage'])->name('tenistas.image');
    Route::get('/pdf/{tenista}', [TenistasController::class, 'downloadPdf'])->name('tenistas.pdf');
    Route::get('/{tenista}', [TenistasController::class, 'show'])->name('tenistas.show');
    Route::post('/', [TenistasController::class, 'store'])->name('tenistas.store');
    Route::put('/{tenista}', [TenistasController::class, 'update'])->name('tenistas.update');
    Route::patch('/{tenista}', [TenistasController::class, 'update'])->name('tenistas.updateImage');
    Route::delete('/{tenista}', [TenistasController::class, 'destroy'])->name('tenistas.destroy');
});

Route::group(['prefix' => 'torneos'], function (){
    Route::get('/', [TorneosController::class, 'index'])->name('torneos.index');
    Route::get('/create', [TorneosController::class, 'create'])->name('torneos.create');
    Route::get('/edit/{torneo}', [TorneosController::class, 'edit'])->name('torneos.edit');
    Route::get('/image/{torneo}', [TorneosController::class, 'editImage'])->name('torneos.image');
    Route::get('/{torneo}', [TorneosController::class, 'show'])->name('torneos.show');
    Route::post('/', [TorneosController::class, 'store'])->name('torneos.store');
    Route::post('/{torneo}', [TorneosController::class, 'inscribirTenista'])->name('torneos.inscribirTenista');
    Route::put('/{torneo}', [TorneosController::class, 'update'])->name('torneos.update');
    Route::patch('/{torneo}', [TorneosController::class, 'updateImage'])->name('torneos.updateImage');
    Route::delete('/{torneo}', [TorneosController::class, 'destroy'])->name('torneos.destroy');
    Route::delete('/finalizar/{torneo}', [TorneosController::class, 'finalizarTorneo'])->name('torneos.finalizarTorneo');
});
