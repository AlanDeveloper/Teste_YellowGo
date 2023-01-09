<?php

use App\Http\Controllers\ComercialAtivoController;
use App\Http\Controllers\ComercialPAPController;
use App\Http\Controllers\ComercialPassivoController;
use App\Http\Controllers\ComercialReativoController;
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
    Route::get('/cliente/adiciona', [ComercialAtivoController::class, 'adiciona'])->name('cliente.adiciona');
    Route::post('/cliente/adiciona', [ComercialAtivoController::class, 'salva']);

    Route::post('/comercial_ativo/{id}/atualizar_cliente', [ComercialAtivoController::class, 'atualizar_cliente'])->name('comercial_ativo.atualizar_cliente');

    ## MÓDULO COMO SOUBE
    Route::get('/comercial_passivo', [ComercialPassivoController::class, 'index'])->name('comercial_passivo.index');

    Route::get('/comercial_passivo/{id}/pegar_cliente', [ComercialPassivoController::class, 'pegar_cliente'])->name('comercial_passivo.pegar_cliente');
    Route::post('/comercial_passivo/{id}/atualizar_cliente', [ComercialPassivoController::class, 'atualizar_cliente'])->name('comercial_passivo.atualizar_cliente');

    # MÓDULO COMO SOUBE
    Route::get('/comercial_pap/adiciona', [ComercialPAPController::class, 'adiciona'])->name('comercial_pap.adiciona');
    Route::post('/comercial_pap/adiciona', [ComercialPAPController::class, 'salva']);

    Route::post('/comercial_pap/{id}/atualizar_cliente', [ComercialPAPController::class, 'atualizar_cliente'])->name('comercial_pap.atualizar_cliente');

    # MÓDULO COMO SOUBE
    Route::get('/comercial_reativo', [ComercialReativoController::class, 'index'])->name('comercial_reativo.index');

    Route::get('/register', [UsuarioController::class, 'register'])->name('register');
    Route::post('/register', [UsuarioController::class, 'authenticate2']);
});
