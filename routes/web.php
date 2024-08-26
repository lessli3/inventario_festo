<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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



