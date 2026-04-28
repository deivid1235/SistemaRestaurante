<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfiguracionVisualController;
use App\Http\Controllers\LibroReclamacionController;
use App\Http\Controllers\AdministracionGeneralController;
use App\Http\Controllers\MetodopagoController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InpresoraController;



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
    Route::post('/config/perfil-personal/logo', [ConfiguracionVisualController::class, 'guardarLogo'])->name('config.perfil.logo');
    // Rutas para Libro de Reclamaciones
    Route::get('/admin/LibroReclamacion', [LibroReclamacionController::class, 'index'])->name('admin.LibroReclamacion.index');
    Route::get('/admin/LibroReclamacion/{libroReclamacion}', [LibroReclamacionController::class, 'show'])->name('admin.LibroReclamacion.show');
    Route::get('/admin/LibroReclamacion/{libroReclamacion}/pdf', [LibroReclamacionController::class, 'pdf'])->name('admin.LibroReclamacion.pdf');
    Route::get('/admin/LibroReclamacion/{libroReclamacion}/print', [LibroReclamacionController::class, 'print'])->name('admin.LibroReclamacion.print');

    // Rutas para Administración General
    Route::get('/admin/AdministracionGeneral', [AdministracionGeneralController::class, 'index'])->name('admin.AdministracionGeneral.index');
   // Empresa
    Route::get('/admin/Empresa', [EmpresaController::class, 'index'])->name('admin.Empresa.index');
    Route::get('/admin/Empresa/{id}/edit', [EmpresaController::class, 'edit'])->name('admin.Empresa.edit');
    Route::put('/admin/Empresa/{id}', [EmpresaController::class, 'update'])->name('admin.Empresa.update');

    // Rutas del tipo de pago
    Route::post('/admin/TipoPago', [TipoPagoController::class, 'store'])->name('admin.TipoPago.store');
    Route::put('/admin/TipoPago/{id}', [TipoPagoController::class, 'update'])->name('admin.TipoPago.update');
    Route::delete('/admin/TipoPago/{id}', [TipoPagoController::class, 'destroy'])->name('admin.TipoPago.destroy');
    // Rutas del método de pago
    Route::get('/admin/MetodoPago', [MetodopagoController::class, 'index'])->name('admin.MetodoPago.index');
    Route::post('/admin/MetodoPago', [MetodopagoController::class, 'store'])->name('admin.MetodoPago.store');
    Route::put('/admin/MetodoPago/{id}', [MetodopagoController::class, 'update'])->name('admin.MetodoPago.update');
    Route::delete('/admin/MetodoPago/{id}', [MetodopagoController::class, 'destroy'])->name('admin.MetodoPago.destroy');
    Route::post('/admin/MetodoPago/toggle/{id}', [MetodopagoController::class, 'toggleEstado'])->name('admin.MetodoPago.toggle');

    //Rutas para usuarios y roles
    Route::prefix('usuarios-roles')->name('usuarios.')->group(function () {
    Route::get('/',        [UsuarioController::class, 'index'])->name('index');
    Route::get('/crear',   [UsuarioController::class, 'create'])->name('create');
    Route::post('/',       [UsuarioController::class, 'store'])->name('store');
    Route::get('/{id}',    [UsuarioController::class, 'edit'])->name('edit');
    Route::put('/{id}',    [UsuarioController::class, 'update'])->name('update');
    Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('destroy');
    });

    // Rutas para impresoras
    Route::prefix('impresoras')->name('admin.Inpresora.')->group(function () {
        Route::get('/',        [InpresoraController::class, 'index'])->name('index');
        Route::get('/crear',   [InpresoraController::class, 'create'])->name('create');
        Route::post('/',       [InpresoraController::class, 'store'])->name('store');
        Route::get('/{id}',    [InpresoraController::class, 'edit'])->name('edit');
        Route::put('/{id}',    [InpresoraController::class, 'update'])->name('update');
        Route::delete('/{id}', [InpresoraController::class, 'destroy'])->name('destroy');
    });



});
