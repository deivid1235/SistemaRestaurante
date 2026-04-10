<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfiguracionVisualController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Rutas para Configuración Visual
    Route::get('/admin/ConfiguracionVisual', [ConfiguracionVisualController::class, 'index'])->name('admin.ConfiguracionVisual.index');
    Route::post('/configuracionVisual/upload', [ConfiguracionVisualController::class, 'upload'])->name('config.visual.upload');
    Route::delete('/configuracionVisual/delete', [ConfiguracionVisualController::class, 'delete'])->name('config.visual.delete');
    Route::post('/configuracionVisual/guardarTema', [ConfiguracionVisualController::class, 'guardarTema'])->name('config.visual.tema');
});