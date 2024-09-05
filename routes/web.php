<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\SolicitudController;

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

Route::get('/home', function () {
    return view('home');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/check-document', [AuthController::class, 'sendVerificationCode'])->name('check.document');
// Ruta para verificar el código de verificación
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('verify.code');
// Ruta para enviar el código de verificación
Route::post('/verify-code-ing', [AuthController::class, 'verifyCodeIng'])->name('verify.codeIng');


Route::resource('/herramientas', HerramientaController::class);
Route::resource('/solicitudes', SolicitudController::class);


Route::get('/solicitudItems', function () {
    return view('solicitudItems');
})->name('solicitudItems');

/*Route::get('/solicitudes', function () {
    return view('solicitudes');
})->name('solicitudes.create');

Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');

Route::get('/admin/solicitudes', [SolicitudController::class, 'index'])->name('admin.solicitudes');
Route::post('/admin/solicitudes/{id}/aceptar', [SolicitudController::class, 'aceptar'])->name('admin.solicitudes.aceptar');
Route::post('/admin/solicitudes/{id}/rechazar', [SolicitudController::class, 'rechazar'])->name('admin.solicitudes.rechazar');
*/