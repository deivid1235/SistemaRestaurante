<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfiguracionVisualController;
use App\Http\Controllers\LibroReclamacionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/inicio', [HomeController::class, 'index'])->name('inicio');
Route::get('/LibroReclamacion', function () { return view('home.LibroReclamacion');})->name('libro.reclamacion');
Route::post('/LibroReclamacion', [LibroReclamacionController::class, 'store'])->name('libro.reclamacion.store');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Rutas para Configuración Visual
    Route::get('/admin/ConfiguracionVisual', [ConfiguracionVisualController::class, 'index'])->name('admin.ConfiguracionVisual.index');
    Route::post('/configuracionVisual/upload', [ConfiguracionVisualController::class, 'upload'])->name('config.visual.upload');
    Route::delete('/configuracionVisual/delete', [ConfiguracionVisualController::class, 'delete'])->name('config.visual.delete');
    Route::post('/configuracionVisual/guardarTema', [ConfiguracionVisualController::class, 'guardarTema'])->name('config.visual.tema');
    // Configuración Empresa
Route::post('/config/empresa/logo', [ConfiguracionVisualController::class, 'logo'])->name('config.empresa.logo');
Route::post('/config/empresa/info', [ConfiguracionVisualController::class, 'info'])->name('config.empresa.info');

// Configuración Usuario
Route::post('/config/usuario/foto', [ConfiguracionVisualController::class, 'foto'])->name('config.usuario.foto');
Route::post('/configuracion/color', [ConfiguracionVisualController::class, 'guardarColor'])->name('config.visual.color');

Route::post('/config/perfil-personal/logo', [ConfiguracionVisualController::class, 'guardarLogo'])
    ->name('config.perfil.logo');
    // Rutas para Libro de Reclamaciones
});