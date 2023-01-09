<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComoSoubeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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
    if (auth()->user()) {
        return redirect()->route('dashboard.index');
    } else {
        return redirect()->route('login');
    }
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [UsuarioController::class, 'login'])->name('login');
    Route::post('/login', [UsuarioController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {

    Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    # MÓDULO COMO SOUBE
    Route::get('/como_soube', [ComoSoubeController::class, 'index'])->name('como_soube.index');

    Route::get('/como_soube/adiciona', [ComoSoubeController::class, 'adiciona'])->name('como_soube.adiciona');
    Route::post('/como_soube/adiciona', [ComoSoubeController::class, 'salva']);

    Route::get('/como_soube/{id}', [ComoSoubeController::class, 'atualiza'])->name('como_soube.atualiza');
    Route::put('/como_soube/{id}', [ComoSoubeController::class, 'salva']);

    Route::delete('/como_soube/{id}', [ComoSoubeController::class, 'deleta'])->name('como_soube.deleta');

    ## MÓDULO COMO SOUBE
    Route::get('/cliente/adiciona', [ClienteController::class, 'adiciona'])->name('cliente.adiciona');
    Route::post('/cliente/adiciona', [ClienteController::class, 'salva']);

    Route::get('/register', [UsuarioController::class, 'register'])->name('register');
    Route::post('/register', [UsuarioController::class, 'authenticate2']);
});
