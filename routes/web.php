<?php
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AlmacenArmazonesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AlmacenInsumosController;
use App\Http\Controllers\controlerconpradores;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::post('/buscar/clienteventa',[VentaController::class, 'crearpdf'])->name('mica.crearpdf');
Route::get('/vendercliente', [VentaController::class, 'mandarclientes'])->name('bucarclienteexistencia');
Route::get('/buscar/clienteventa/sec',[VentaController::class, 'verificarpersonas2'])->name('encontrar.verificarpersonas2');
Route::get('/buscar/clienteventa',[VentaController::class, 'verificarpersonas'])->name('encontrar.verificarpersonas');
Route::get('/buscar/armazonVenta/{id}',[VentaController::class, 'buscarArmazon'])->name('encontrar.buscarArmazon');
Route::get('/buscar/insumoVenta/{id}',[VentaController::class, 'buscarInsumo'])->name('encontrar.buscarInsumo');
Route::post('/store/vender', [VentaController::class, 'store'])->name('venta.store');
Route::get('/buscar/ventas/fechas',[VentaController::class, 'show'])->name('ventas.show');
Route::get('/vender/informes', function () {return view('ventas.reportes');})->name('bucarventas');
Route::get('/buscar/ventas/deldia',[VentaController::class, 'ventasdeldia'])->name('ventas.ventasdeldia');
Route::get('/buscar/ventas/rapidas',[VentaController::class, 'ventassincliente'])->name('ventas.ventassincliente');
Route::get('/buscar/ventas/acliente',[VentaController::class, 'reportesCliente'])->name('ventas.reportesCliente');
Route::get('/vender/informes/clienteventaTodo', function () {return view('ventas.ventasacliente');})->name('bucarventasacliente');
Route::get('/buscar/clienteventa/ventasT',[VentaController::class, 'verificarpersonas3'])->name('encontrar.verificarpersonas3');


//consultas
Route::get('/',[ClienteController::class, 'index'])->name('consultas.index');
Route::post('/editconsulta/{id}', [ClienteController::class, 'edit'])->name('consulta.edit');
Route::post('/updateconsulta/{consulta}', [ClienteController::class, 'update'])->name('consulta.update');//para camiar las consultas
Route::post('/destroyconsulta/{id}', [ClienteController::class, 'destroy'])->name('consulta.destroy');
Route::post('/storeconsulta', [ClienteController::class, 'store'])->name('consulta.store');
Route::post('/storeconsulta/clinte/{id}', [ClienteController::class, 'consultacliente'])->name('consulta.consultacliente');
Route::get('/mostrarconsultas', [ClienteController::class, 'show'])->name('consulta.show');


//armazones
Route::get('/indexArmazones', [AlmacenArmazonesController::class, 'index'])->name('armazones.index');
Route::get('/editarmazoes/{proveedor}', [AlmacenArmazonesController::class, 'edit'])->name('armazones.edit');
Route::put('/updatearmazon/{armazon}', [AlmacenArmazonesController::class, 'update'])->name('armazones.update');
Route::delete('/destroyarmazon/{armazon}', [AlmacenArmazonesController::class, 'destroy'])->name('armazones.destroy');
Route::get('/createarmazon', [AlmacenArmazonesController::class, 'create'])->name('armazones.create');
Route::post('/storearmazon', [AlmacenArmazonesController::class, 'store'])->name('armazones.store');
Route::post('/show/armazon', [AlmacenArmazonesController::class, 'show'])->name('armazones.show');
Route::post('/show2/armazon', [AlmacenArmazonesController::class, 'show2'])->name('armazones2.show2');

//insumos
Route::get('/index/insumos', [AlmacenInsumosController::class, 'index'])->name('insumo.index');
Route::delete('/index/destruir/{id}', [AlmacenInsumosController::class, 'destroy'])->name('insumo.destroy');
Route::get('/editar/insumo/{id}', [AlmacenInsumosController::class, 'edit'])->name('insumo.edit');
Route::put('/update/insumo/{id}', [AlmacenInsumosController::class, 'update'])->name('insumo.update');
Route::get('/create/insumo', [AlmacenInsumosController::class, 'create'])->name('insumo.create');
Route::post('/store/insumo', [AlmacenInsumosController::class, 'store'])->name('insumo.store');
Route::post('/show/insumo', [AlmacenInsumosController::class, 'show'])->name('insumo.show');

//clientes-compradores
Route::get('/index/cliente', [controlerconpradores::class, 'index'])->name('cliente.index');
Route::delete('/index/destruir/cliente/{id}', [controlerconpradores::class, 'destroy'])->name('cliente.destroy');
Route::get('/editar/cliente/{id}', [controlerconpradores::class, 'edit'])->name('cliente.edit');
Route::put('/update/cliente/{id}', [controlerconpradores::class, 'update'])->name('cliente.update');
Route::get('/create/cliente', [controlerconpradores::class, 'create'])->name('cliente.create');
Route::post('/store/cliente', [controlerconpradores::class, 'store'])->name('cliente.store');
Route::post('/show/cliente', [controlerconpradores::class, 'show'])->name('cliente.show');


// de trabajadores
Route::get('/index', [CategoriaController::class, 'index'])->name('usuarios.index');
Route::get('/create', [CategoriaController::class, 'create'])->name('usuarios.create');
Route::post('/store', [CategoriaController::class, 'store'])->name('usuarios.store');
Route::get('/edit/{ID_trabajo}', [CategoriaController::class, 'edit'])->name('usuarios.edit');
Route::put('/update/{ID_trabajo}', [CategoriaController::class, 'update'])->name('usuarios.update');
Route::delete('/destroy/{ID_trabajo}', [CategoriaController::class, 'destroy'])->name('usuarios.destroy');
