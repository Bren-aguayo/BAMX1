<?php

use App\Exports\BajasExport;
use App\Exports\extrasExport;
use App\Exports\IncidentesExport;
use App\Exports\IngresossalidasExport;
use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngresoSalidaController;
use App\Http\Controllers\AnticipadaController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BajaController;
use App\Http\Controllers\EntregadespensaController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\IncidenteController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\NorecibioController;
use App\Http\Controllers\PermitidaController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ReingresoController;
use App\Http\Controllers\EntradasalidaguardiaController;
use App\Http\Controllers\UserController;

use App\Exports\RegistrosExport;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {

Route::get('/ingreso_salidas', [IngresoSalidaController::class, 'index'])->name('ingreso_salidas.index');
Route::get('/ingreso_salidas/create', [IngresoSalidaController::class, 'create'])->name('ingreso_salidas.create');
Route::post('/ingreso_salidas/entrada', [IngresoSalidaController::class, 'registrarEntrada'])->name('ingreso_salidas.entrada');
Route::post('/ingreso_salidas/salida', [IngresoSalidaController::class, 'registrarSalida'])->name('ingreso_salidas.salida');
Route::delete('/ingreso_salidas/{ingreso_salida}', [IngresoSalidaController::class, 'destroy'])->name('ingreso_salidas.destroy');

Route::get('/entradaguardia', [EntradasalidaguardiaController::class, 'index'])->name('entradaguardia.index');
Route::get('/entradaguardia/create', [EntradasalidaguardiaController::class, 'create'])->name('entradaguardia.create');
Route::post('/entradaguardia/entrada', [EntradasalidaguardiaController::class, 'registrarEntrada'])->name('entradaguardia.entrada');
Route::post('/entradaguardia/salida', [EntradasalidaguardiaController::class, 'registrarSalida'])->name('entradaguardia.salida');
Route::delete('/entradaguardia/{entradasalidaguardia}', [EntradasalidaguardiaController::class, 'destroy'])->name('entradaguardia.destroy');


Route::resource('volunteers', VolunteerController::class);

Route::get('/guardias', [GuardiaController::class, 'index'])->name('guardias.index');
Route::get('/guardias/create', [GuardiaController::class, 'create'])->name('guardias.create');
Route::post('/guardias/store', [GuardiaController::class, 'store'])->name('guardias.store');
Route::get('/guardias/edit/{guardia}', [GuardiaController::class, 'edit'])->name('guardias.edit');
Route::patch('/guardias/update/{guardia}', [GuardiaController::class, 'update'])->name('guardias.update');
Route::delete('/guardias/{guardia}', [GuardiaController::class, 'destroy'])->name('guardias.destroy');

Route::get('/entradaguardia', [EntradasalidaguardiaController::class, 'index'])->name('entradaguardia.index');
Route::get('/entradaguardia/create', [EntradasalidaguardiaController::class, 'create'])->name('entradaguardia.create');
Route::post('/entradaguardia/registrar', [EntradasalidaguardiaController::class, 'registrarEntrada'])->name('entradaguardia.registrar');
Route::delete('/entradaguardia/{entradasalidaguardia}', [EntradasalidaguardiaController::class, 'destroy'])->name('entradaguardia.destroy');


Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
Route::post('/areas/store', [AreaController::class, 'store'])->name('areas.store');
Route::get('/areas/edit/{area}', [AreaController::class, 'edit'])->name('areas.edit');
Route::patch('/areas/update/{area}', [AreaController::class, 'update'])->name('areas.update');
Route::delete('/areas/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');
Route::get('/areas/search', [AreaController::class, 'search'])->name('areas.search');

Route::get('/anticipadas', [AnticipadaController::class, 'index'])->name('anticipadas.index');
Route::get('/anticipadas/create', [AnticipadaController::class, 'create'])->name('anticipadas.create');
Route::post('/anticipadas/store', [AnticipadaController::class, 'store'])->name('anticipadas.store');
Route::get('/anticipadas/edit/{anticipada}', [AnticipadaController::class, 'edit'])->name('anticipadas.edit');
Route::patch('/anticipadas/update/{anticipada}', [AnticipadaController::class, 'update'])->name('anticipadas.update');
Route::delete('/anticipadas/{anticipada}', [AnticipadaController::class, 'destroy'])->name('anticipadas.destroy');
Route::get('/anticipadas/search', [AnticipadaController::class, 'search'])->name('anticipadas.search');


Route::get('/bajas', [BajaController::class, 'index'])->name('bajas.index');
Route::get('/bajas/create', [BajaController::class, 'create'])->name('bajas.create');
Route::post('/bajas/store', [BajaController::class, 'store'])->name('bajas.store');
Route::get('/bajas/edit/{baja}', [BajaController::class, 'edit'])->name('bajas.edit');
Route::patch('/bajas/update/{baja}', [BajaController::class, 'update'])->name('bajas.update');
Route::delete('/bajas/{baja}', [BajaController::class, 'destroy'])->name('bajas.destroy');
Route::get('/bajas/search', [BajaController::class, 'search'])->name('bajas.search');
Route::get('/buscar-voluntario/{codigo}', [BajaController::class, 'buscarVoluntario']);

Route::get('/entregadespensas', [EntregadespensaController::class, 'index'])->name('entregadespensas.index');
Route::get('/entregadespensas/create', [EntregadespensaController::class, 'create'])->name('entregadespensas.create');
Route::post('/entregadespensas/store', [EntregadespensaController::class, 'store'])->name('entregadespensas.store');
Route::get('/entregadespensas/edit/{entregadespensa}', [EntregadespensaController::class, 'edit'])->name('entregadespensas.edit');
Route::patch('/entregadespensas/update/{entregadespensa}', [EntregadespensaController::class, 'update'])->name('entregadespensas.update');
Route::delete('/entregadespensas/{entregadespensa}', [EntregadespensaController::class, 'destroy'])->name('entregadespensas.destroy');
Route::get('/entregadespensas/search', [EntregadespensaController::class, 'search'])->name('entregadespensas.search');

Route::get('/extras', [ExtraController::class, 'index'])->name('extras.index');
Route::get('/extras/create', [ExtraController::class, 'create'])->name('extras.create');
Route::post('/extras/store', [ExtraController::class, 'store'])->name('extras.store');
Route::get('/extras/edit/{extra}', [ExtraController::class, 'edit'])->name('extras.edit');
Route::patch('/extras/update/{extra}', [ExtraController::class, 'update'])->name('extras.update');
Route::patch('/extras/{extra}/entregar', [ExtraController::class, 'marcarEntregado'])->name('extras.entregar');
Route::delete('/extras/{extra}', [ExtraController::class, 'destroy'])->name('extras.destroy');
Route::get('/extras/search', [ExtraController::class, 'search'])->name('extras.search');

Route::get('/incidentes', [IncidenteController::class, 'index'])->name('incidentes.index');
Route::get('/incidentes/create', [IncidenteController::class, 'create'])->name('incidentes.create');
Route::post('/incidentes/store', [IncidenteController::class, 'store'])->name('incidentes.store');
Route::get('/incidentes/edit/{incidente}', [IncidenteController::class, 'edit'])->name('incidentes.edit');
Route::patch('/incidentes/update/{incidente}', [IncidenteController::class, 'update'])->name('incidentes.update');
Route::delete('/incidentes/{incidente}', [IncidenteController::class, 'destroy'])->name('incidentes.destroy');
Route::get('/incidentes/search', [IncidenteController::class, 'search'])->name('incidentes.search');

Route::get('/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index');
Route::get('/movimientos/create', [MovimientoController::class, 'create'])->name('movimientos.create');
Route::post('/movimientos/store', [MovimientoController::class, 'store'])->name('movimientos.store');
Route::get('/movimientos/edit/{movimiento}', [MovimientoController::class, 'edit'])->name('movimientos.edit');
Route::patch('/movimientos/update/{movimiento}', [MovimientoController::class, 'update'])->name('movimientos.update');
Route::delete('/movimientos/{movimiento}', [MovimientoController::class, 'destroy'])->name('movimientos.destroy');
Route::get('/movimientos/search', [MovimientoController::class, 'search'])->name('movimientos.search');

Route::get('/norecibio', [NorecibioController::class, 'index'])->name('norecibio.index');
Route::get('/norecibio/create', [NorecibioController::class, 'create'])->name('norecibio.create');
Route::post('/norecibio/store', [NorecibioController::class, 'store'])->name('norecibio.store');
Route::get('/norecibio/edit/{norecibio}', [NorecibioController::class, 'edit'])->name('norecibio.edit');
Route::patch('/norecibio/update/{norecibio}', [NorecibioController::class, 'update'])->name('norecibio.update');
Route::delete('/norecibio/{norecibio}', [NorecibioController::class, 'destroy'])->name('norecibio.destroy');
Route::get('/norecibio/search', [NorecibioController::class, 'search'])->name('norecibio.search');

Route::get('/permitidas', [PermitidaController::class, 'index'])->name('permitidas.index');
Route::get('/permitidas/create', [PermitidaController::class, 'create'])->name('permitidas.create');
Route::post('/permitidas/registrar', [PermitidaController::class, 'registrarMovimiento'])->name('permitidas.registrar');
Route::delete('/permitidas/{permitida}', [PermitidaController::class, 'destroy'])->name('permitidas.destroy');

Route::get('/reingresos', [ReingresoController::class, 'index'])->name('reingresos.index');
Route::get('/reingresos/create', [ReingresoController::class, 'create'])->name('reingresos.create');
Route::post('/reingresos/store', [ReingresoController::class, 'store'])->name('reingresos.store');
Route::get('/reingresos/edit/{reingreso}', [ReingresoController::class, 'edit'])->name('reingresos.edit');
Route::patch('/reingresos/update/{reingreso}', [ReingresoController::class, 'update'])->name('reingresos.update');
Route::delete('/reingresos/{reingreso}', [ReingresoController::class, 'destroy'])->name('reingresos.destroy');
Route::get('/reingresos/search', [ReingresoController::class, 'search'])->name('reingresos.search');



Route::get('/exportar-registros', function () {
    return Excel::download(new RegistrosExport, 'registros.xlsx');
})->name('registros.exportar');

Route::get('/exportar-bajas', function (){
    return Excel::download(new BajasExport, 'bajas.xlsx' );
})->name ('bajas.exportar');


Route::get('/exportar-extras', function(){
    return Excel::download(new extrasExport, 'extras.xlsx');
})->name('extras.exportar');


Route::get('/exportar-incidentes', function(){
    return Excel::download(new IncidentesExport, 'incidentes.xlsx');
})->name('incidentes.exportar');

Route::get('/exportar-asistencia', function(){
    return Excel::download(new IngresossalidasExport, 'asistencia.xlsx');
})->name('asistencias.exportar');




Route::resource('users', UserController::class)->only(['index','edit', 'update']);
});



require __DIR__.'/auth.php';
