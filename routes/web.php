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
use App\Http\Controllers\SalonController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoCategoriaController;
use App\Http\Controllers\AreaProduccionController;
use App\Http\Controllers\CartaDigitalController;
use App\Http\Controllers\ConfiguracionInicialController;
use App\Http\Controllers\OptimizacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AperturasCajaController;
use App\Http\Controllers\Auth\LoginCliente;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/inicio', [HomeController::class, 'inicioSECCION'])->name('inicio');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/LibroReclamacion', function () { return view('home.LibroReclamacion');})->name('libro.reclamacion');
Route::post('/LibroReclamacion', [LibroReclamacionController::class, 'store'])->name('libro.reclamacion.store');
Route::get('/producto/{id}', [HomeController::class, 'productoDetalle'])->name('home.producto.show');
Route::get('/productos/categoria/{id}', [HomeController::class, 'byCategoria']);
Route::post('/home/cliente/store', [HomeController::class, 'storeClientePublico'])->name('home.cliente.store');
Route::get('/home/cliente/buscar/{tipo}/{numero}', [ClienteController::class, 'buscarDocumento']);
// CLIENTE (TIENDA)
Route::post('/cliente/login', [LoginCliente::class, 'login'])->name('cliente.login');
Route::post('/cliente/logout', [LoginCliente::class, 'logout'])->name('cliente.logout');
Route::get('/login', function () {
    return view('home.IniciarSeccion');
})->name('inicio');

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
    Route::get('/admin/Empresa/create', [EmpresaController::class, 'create'])->name('admin.Empresa.create');
    Route::post('/admin/Empresa', [EmpresaController::class, 'store'])->name('admin.Empresa.store');

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

    // Rutas del tipo de documento
    Route::get('/admin/TipoDocumento', [TipoDocumentoController::class, 'index'])->name('admin.TipoDocumento.index');
    Route::post('/admin/TipoDocumento', [TipoDocumentoController::class, 'store'])->name('admin.TipoDocumento.store');
    Route::get('/admin/TipoDocumento/{id}/edit', [TipoDocumentoController::class, 'edit'])->name('admin.TipoDocumento.edit');
    Route::put('/admin/TipoDocumento/{id}', [TipoDocumentoController::class, 'update'])->name('admin.TipoDocumento.update');
    Route::delete('/admin/TipoDocumento/{id}', [TipoDocumentoController::class, 'destroy'])->name('admin.TipoDocumento.destroy');
    // Rutas para Inpresora
    Route::get('/admin/Inpresora', [InpresoraController::class, 'index'])->name('admin.Inpresora.index');
    Route::post('/admin/Inpresora', [InpresoraController::class, 'store'])->name('admin.Inpresora.store');
    Route::put('/admin/Inpresora/{id}', [InpresoraController::class, 'update'])->name('admin.Inpresora.update');
    Route::delete('/admin/Inpresora/{id}', [InpresoraController::class, 'destroy'])->name('admin.Inpresora.destroy');
    //Rutas para Salón
    Route::get('/admin/Salon', [SalonController::class, 'index'])->name('admin.Salon.index');
    Route::post('/admin/Salon', [SalonController::class, 'store'])->name('admin.Salon.store');
    Route::put('/admin/Salon/{id}', [SalonController::class, 'update'])->name('admin.Salon.update');
    Route::delete('/admin/Salon/{id}', [SalonController::class, 'destroy'])->name('admin.Salon.destroy');
    //Rutas de Mesas
    Route::post('/admin/mesa', [MesaController::class, 'store'])->name('admin.mesa.store');
    Route::delete('/admin/mesa/{id}', [MesaController::class, 'destroy'])->name('admin.mesa.destroy');
    Route::put('/admin/mesa/{id}', [MesaController::class, 'update'])->name('admin.mesa.update');
    // Rutas para áreas de producción
    Route::get('/admin/AreaProduccion',[AreaProduccionController::class, 'index'])->name('admin.AreaProduccion.index');
    Route::post('/admin/AreaProduccion',[AreaProduccionController::class, 'store'])->name('admin.AreaProduccion.store');
    Route::put('/admin/AreaProduccion/{id}',[AreaProduccionController::class, 'update'])->name('admin.AreaProduccion.update');
    Route::delete('/admin/AreaProduccion/{id}',[AreaProduccionController::class, 'destroy'])->name('admin.AreaProduccion.destroy');

    // Rutas para Carta Digital
    Route::get('/admin/CartaDigital',[CartaDigitalController::class, 'index'])->name('admin.CartaDigital.index');
    Route::post('/admin/CartaDigital/guardar-url',[CartaDigitalController::class, 'guardarUrl'])->name('admin.CartaDigital.guardarUrl');
    Route::post('/admin/CartaDigital/generar-qr',[CartaDigitalController::class, 'generarQr'])->name('admin.CartaDigital.generarQr');
    Route::get('/admin/CartaDigital/descargar-qr',[CartaDigitalController::class, 'descargarQr'])->name('admin.CartaDigital.descargarQr');

    // Rutas para Configuración Inicial
    Route::get('/admin/ConfiguracionInicial',[ConfiguracionInicialController::class, 'index'])->name('admin.ConfiguracionInicial.index');
    Route::put('/admin/ConfiguracionInicial',[ConfiguracionInicialController::class, 'update'])->name('admin.ConfiguracionInicial.update');

    // Rutas para Optimización de Procesos
    Route::get('/admin/Optimizacion', [OptimizacionController::class, 'index'])->name('admin.Optimizacion.index');
    Route::post('/admin/Optimizacion/pedidos',[OptimizacionController::class, 'optimizarPedidos'])->name('admin.Optimizacion.pedidos');
    Route::post('/admin/Optimizacion/ventas', [OptimizacionController::class, 'restaurarVentas'])->name('admin.Optimizacion.ventas');
    Route::post('/admin/Optimizacion/productos',[OptimizacionController::class, 'restaurarProductos'])->name('admin.Optimizacion.productos');
    Route::post('/admin/Optimizacion/insumos', [OptimizacionController::class, 'restaurarInsumos'])->name('admin.Optimizacion.insumos');
    Route::post('/admin/Optimizacion/clientes',[OptimizacionController::class, 'restaurarClientes'])->name('admin.Optimizacion.clientes');
    Route::post('/admin/Optimizacion/proveedores',[OptimizacionController::class, 'restaurarProveedores'])->name('admin.Optimizacion.proveedores');
    Route::post('/admin/Optimizacion/salones',[OptimizacionController::class, 'restaurarSalones'])->name('admin.Optimizacion.salones');
    Route::post('/admin/Optimizacion/notas-ventas',[OptimizacionController::class, 'restaurarNotasVentas'])->name('admin.Optimizacion.notasVentas');
    //Rutas para usuarios y roles
    Route::get('/admin/Usuarios', [UsuarioController::class, 'index'])->name('admin.Usuarios.index');
    Route::get('/admin/Usuarios/crear', [UsuarioController::class, 'create'])->name('admin.Usuarios.create');
    Route::post('/admin/Usuarios', [UsuarioController::class, 'store'])->name('admin.Usuarios.store');
    Route::get('/admin/Usuarios/{id}', [UsuarioController::class, 'edit'])->name('admin.Usuarios.edit');
    Route::put('/admin/Usuarios/{id}', [UsuarioController::class, 'update'])->name('admin.Usuarios.update');
    Route::delete('/admin/Usuarios/{id}', [UsuarioController::class, 'destroy'])->name('admin.Usuarios.destroy');

    // Rutas para gestión de cajas
    Route::get('/admin/Caja', [CajaController::class, 'index'])->name('admin.Caja.index');
    Route::post('/admin/Caja', [CajaController::class, 'store'])->name('admin.Caja.store');
    Route::put('/admin/Caja/{id}', [CajaController::class, 'update'])->name('admin.Caja.update');
    Route::delete('/admin/Caja/{id}', [CajaController::class, 'destroy'])->name('admin.Caja.destroy');
    // Rutas Usuarios - Cajas
    Route::get('/admin/Caja/{id}/usuarios', [CajaController::class, 'usuarios'])->name('admin.Caja.usuarios');
    Route::post('/admin/Caja/{id}/asignar-usuarios', [CajaController::class, 'asignarUsuarios'])->name('admin.Caja.asignar-usuarios');
    //Categorias
    Route::get('/admin/Categoria', [ProductoCategoriaController::class, 'index'])->name('admin.Categoria.index');
    Route::get('/admin/Categoria/create', [ProductoCategoriaController::class, 'create'])->name('admin.Categoria.create');
    Route::post('/admin/Categoria', [ProductoCategoriaController::class, 'store'])->name('admin.Categoria.store');
    Route::put('/admin/Categoria/update/{id}', [ProductoCategoriaController::class, 'update'])->name('admin.Categoria.update');
    Route::delete('/admin/Categoria/delete/{id}', [ProductoCategoriaController::class, 'destroy'])->name('admin.Categoria.destroy');
    Route::get('/admin/Categoria/{id}/edit', [ProductoCategoriaController::class, 'edit'])->name('admin.Categoria.edit');
    //Producto
    Route::get('admin/Producto', [ProductoController::class, 'index'])->name('admin.Producto.index');
    Route::get('admin/Producto/create', [ProductoController::class, 'create'])->name('admin.Producto.create');
    Route::post('admin/Producto', [ProductoController::class, 'store'])->name('admin.Producto.store');
    Route::get('admin/Producto/{producto}/edit', [ProductoController::class, 'edit'])->name('admin.Producto.edit');
    Route::put('admin/Producto/{id}', [ProductoController::class, 'update'])->name('admin.Producto.update');
    Route::delete('admin/Producto/{producto}', [ProductoController::class, 'destroy'])->name('admin.Producto.destroy');
    Route::get('admin/Producto/ticket/{id}', [ProductoController::class, 'ticket']) ->name('admin.Producto.ticket');
    Route::get('admin/Producto/{producto}', [ProductoController::class, 'show'])->name('admin.Producto.show');
    Route::get('admin/Producto/{id}/print', [ProductoController::class, 'print'])->name('admin.Producto.print');
    // Rutas para Combos
    Route::get('/admin/Combos', [ComboController::class, 'index'])->name('admin.Combos.index');
    Route::post('/admin/Combos', [ComboController::class, 'store'])->name('admin.Combos.store');
    Route::get('/admin/Combos/{id}/edit', [ComboController::class, 'edit'])->name('admin.Combos.edit');
    Route::put('/admin/Combos/{id}', [ComboController::class, 'update'])->name('admin.Combos.update');
    Route::delete('/admin/Combos/{id}', [ComboController::class, 'destroy'])->name('admin.Combos.destroy');
    //Clientes
    Route::get('/admin/Clientes', [ClienteController::class, 'index'])->name('admin.Clientes.index');
    Route::get('/admin/Clientes/create', [ClienteController::class, 'create'])->name('admin.Clientes.create');
    Route::post('/admin/Clientes', [ClienteController::class, 'store'])->name('admin.Clientes.store');
    Route::get('/admin/Clientes/{id}/edit', [ClienteController::class, 'edit'])->name('admin.Clientes.edit');
    Route::put('/admin/Clientes/{id}', [ClienteController::class, 'update'])->name('admin.Clientes.update');
    Route::delete('/admin/Clientes/{id}', [ClienteController::class, 'destroy'])->name('admin.Clientes.destroy');
    Route::get('admin/Clientes/buscar/{tipo}/{numero}', [ClienteController::class, 'buscarDocumento'])->name('admin.Clientes.buscar');
    //Rutas apertura/caja
    Route::get('/admin/AperturaCaja', [AperturasCajaController::class, 'index'])->name('admin.AperturaCaja.index');
    Route::get('/admin/AperturaCaja/create', [AperturasCajaController::class, 'create'])->name('admin.AperturaCaja.create');
    Route::post('/admin/AperturaCaja/store', [AperturasCajaController::class, 'store'])->name('admin.AperturaCaja.store');
    Route::get('/admin/AperturaCaja/edit/{id}', [AperturasCajaController::class, 'edit'])->name('admin.AperturaCaja.edit');
    Route::put('/admin/AperturaCaja/update/{id}', [AperturasCajaController::class, 'update'])->name('admin.AperturaCaja.update');
    Route::delete('/admin/AperturaCaja/delete/{id}', [AperturasCajaController::class, 'destroy'])->name('admin.AperturaCaja.destroy');
    
});

