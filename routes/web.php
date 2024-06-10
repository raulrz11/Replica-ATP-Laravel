<?php

use App\Http\Controllers\TenistasController;
use App\Http\Controllers\TorneosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [TenistasController::class, 'index']);

Route::prefix('tenistas')->group(function (){
    Route::get('/', [TenistasController::class, 'index'])->name('tenistas.index');
    Route::get('/create', [TenistasController::class, 'create'])->name('tenistas.create')->middleware('auth', 'admin');
    Route::get('/edit/{tenista}', [TenistasController::class, 'edit'])->name('tenistas.edit')->middleware('auth', 'admin');
    Route::get('/image/{tenista}', [TenistasController::class, 'editImage'])->name('tenistas.image')->middleware('auth', 'admin');
    Route::get('/pdf/{tenista}', [TenistasController::class, 'downloadPdf'])->name('tenistas.pdf')->middleware('auth', 'user');
    Route::get('/{tenista}', [TenistasController::class, 'show'])->name('tenistas.show');
    Route::post('/', [TenistasController::class, 'store'])->name('tenistas.store')->middleware('auth', 'admin');
    Route::put('/{tenista}', [TenistasController::class, 'update'])->name('tenistas.update')->middleware('auth', 'admin');
    Route::patch('/{tenista}', [TenistasController::class, 'updateImage'])->name('tenistas.updateImage')->middleware('auth', 'admin');
    Route::delete('/{tenista}', [TenistasController::class, 'destroy'])->name('tenistas.destroy')->middleware('auth', 'admin');
});

Route::group(['prefix' => 'torneos'], function (){
    Route::get('/', [TorneosController::class, 'index'])->name('torneos.index');
    Route::get('/create', [TorneosController::class, 'create'])->name('torneos.create')->middleware('auth', 'admin');
    Route::get('/edit/{torneo}', [TorneosController::class, 'edit'])->name('torneos.edit')->middleware('auth', 'admin');
    Route::get('/image/{torneo}', [TorneosController::class, 'editImage'])->name('torneos.image')->middleware('auth', 'admin');
    Route::get('/{torneo}', [TorneosController::class, 'show'])->name('torneos.show');
    Route::post('/', [TorneosController::class, 'store'])->name('torneos.store')->middleware('auth', 'admin');
    Route::post('/{torneo}', [TorneosController::class, 'inscribirTenista'])->name('torneos.inscribirTenista')->middleware('auth', 'admin');
    Route::put('/{torneo}', [TorneosController::class, 'update'])->name('torneos.update')->middleware('auth', 'admin');
    Route::patch('/{torneo}', [TorneosController::class, 'updateImage'])->name('torneos.updateImage')->middleware('auth', 'admin');
    Route::delete('/{torneo}', [TorneosController::class, 'destroy'])->name('torneos.destroy')->middleware('auth', 'admin');
    Route::delete('/finalizar/{torneo}', [TorneosController::class, 'finalizarTorneo'])->name('torneos.finalizarTorneo')->middleware('auth', 'admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
