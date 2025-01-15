<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\HomeController;

use App\Models\Herramienta;
use App\Models\Categoria;
/*use App\Http\Livewire\Post;*/

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
    return view('index');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');    
Route::get('/buscar-herramientas', [HomeController::class, 'buscar'])->name('buscar.herramientas'); // Ruta para buscar herramientas

#Route::get('/pdfview', function () {return view('pdf.solicitud');});


Route::post('/register', [RegisterController::class, 'register'])->name('register');    
Route::post('/check-document', [AuthController::class, 'sendVerificationCode'])->name('check.document');
// Ruta para verificar el código de verificación
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('verify.code');
// Ruta para enviar el código de verificación
Route::post('/verify-code-ing', [AuthController::class, 'verifyCodeIng'])->name('verify.codeIng');

//Todas las rutas que requieren autenticación
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [SolicitudController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('/herramientas', HerramientaController::class);
    
    Route::get('/solicitud/{id}/pdf', [SolicitudController::class, 'generarPDF'])->name('solicitud.pdf');
    Route::get('/scanner', function () {return view('scanner');});
    Route::get('/confirmacion', function () {return view('confirmacion'); });
    Route::get('/solicitudes/{id}/confirmar', [SolicitudController::class, 'confirmacion'])->name('solicitudes.confirmar');
    Route::get('/solicitudes/{id}/finalizar', [SolicitudController::class, 'finalizarRecepcion'])->name('solicitudes.finalizar');
    Route::get('/solicitudes/{id}/recibir', [SolicitudController::class, 'recibirH'])->name('solicitudes.recibir');

    Route::post('/api/scan-barcode', [ScannerController::class, 'scanBarcode']);
    
    
    Route::get('/solicitudItems', function () {
        return view('solicitudItems');
    })->name('solicitudItems');
    
    
    
    Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
    Route::get('/solicitudIndex', [SolicitudController::class, 'index'])->name('solicitudes.index')->middleware('auth');
    Route::match(['get', 'post', 'put'], '/solicitudes/{id}/update', [SolicitudController::class, 'update'])->name('solicitud.update');
    Route::get('/calendario', [SolicitudController::class, 'calendario'])->name('solicitudes.calendario')->middleware('auth');
    Route::get('/solicitudes/create', [SolicitudController::class, 'create'])->name('solicitudes.create');
    Route::put('/solicitudes/{id}/estado', [SolicitudController::class, 'actualizarEstado'])->name('solicitud.actualizarEstado');
    Route::put('/solicitudes/{id}/actualizar', [SolicitudController::class, 'actualizar'])->name('solicitudes.actualizar');
        //Route::post('/solicitudes/{solicitud}/agregar-herramienta', [SolicitudController::class, 'agregarHerramienta'])->name('solicitudes.agregarHerramienta');
    Route::get('/solicitudes/filtrar', [SolicitudController::class, 'filtrarHerramientas'])->name('solicitudes.filtrar');
    Route::delete('/solicitudes/{solicitudId}/herramienta/{codHerramienta}', [SolicitudController::class, 'eliminarHerramienta'])->name('eliminar.herramienta');
    Route::post('/solicitudes/{id}/agregarHerramienta', [SolicitudController::class, 'agregarHerramienta'])->name('solicitudes.agregarHerramienta');
    Route::put('/solicitudes/{solicitudId}/detalle/{detalleId}/cantidad', [SolicitudController::class, 'actualizarCantidad'])->name('actualizar.cantidad');
    Route::get('/archivo', [SolicitudController::class, 'finalizadas'])->name('archivo');
    Route::get('/solicitudes/{id}/edit', [SolicitudController::class, 'edit'])->name('solicitud.edit');

    //Route::post('/solicitudes/{solicitudId}/agregar-herramienta', [SolicitudController::class, 'agregarHerramienta'])->name('solicitudes.agregarHerramienta');
    Route::get('/verificar-codigo-herramienta/{herramientaId}/{codigoBarras}', [SolicitudController::class, 'verificarCodigo']);
    
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::resource('/users', UserController::class);
    
    Route::get('/inventario', [HerramientaController::class, 'inventario'])->name('inventario.index');
    Route::post('/inventario', [HerramientaController::class, 'handlePost'])->name('inventario.store');
    Route::delete('/inventario/{id}', [HerramientaController::class, 'handlePost'])->name('inventario.destroy');
    Route::post('/inventario/{post}/stock/{action}', [HerramientaController::class, 'adjustarStock'])->name('inventario.adjustarStock');
    
    Route::get('/monitores', [UserController::class, 'monitoresIndex'])->name('monitores')->middleware('auth');
    Route::post('/monitor', [UserController::class, 'createMonitor'])->name('createMonitor')->middleware('auth');
    Route::post('/monitorIn', [UserController::class, 'convertirInstructor'])->name('convertirInstructor')->middleware('auth');

    Route::get('/monitores', [UserController::class, 'Roles'])->name('monitores');
    Route::get('/crearMonitor', [UserController::class, 'mostrarFormularioCrearMonitor'])->name('mostrarFormularioCrearMonitor');
    Route::post('/crearMonitor', [UserController::class, 'crearMonitor'])->name('crearMonitor');

    Route::post('/logout', [AuthController::class, 'destroy'])->middleware('web')->name('logout');

});

/*Route::get('/solicitudes', function () {
    return view('solicitudes');
})->name('solicitudes.create');

Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');

Route::get('/admin/solicitudes', [SolicitudController::class, 'index'])->name('admin.solicitudes');
Route::post('/admin/solicitudes/{id}/aceptar', [SolicitudController::class, 'aceptar'])->name('admin.solicitudes.aceptar');
Route::post('/admin/solicitudes/{id}/rechazar', [SolicitudController::class, 'rechazar'])->name('admin.solicitudes.rechazar');
*/
