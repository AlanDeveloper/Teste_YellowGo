<?php

use App\Http\Controllers\ComercialAtivoController;
use App\Http\Controllers\ComercialPAPController;
use App\Http\Controllers\ComercialPassivoController;
use App\Http\Controllers\ComercialReativoController;
use App\Http\Controllers\ComoSoubeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PlanoController;
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

    # MÓDULO DE PERFIL
    Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('perfil');
    Route::put('/perfil', [UsuarioController::class, 'salva_perfil'])->name('salva_perfil');

    # MÓDULO COMO SOUBE
    Route::get('/como_soube', [ComoSoubeController::class, 'index'])->name('como_soube.index');

    Route::get('/como_soube/adiciona', [ComoSoubeController::class, 'adiciona'])->name('como_soube.adiciona');
    Route::post('/como_soube/adiciona', [ComoSoubeController::class, 'salva']);

    Route::get('/como_soube/{id}', [ComoSoubeController::class, 'atualiza'])->name('como_soube.atualiza');
    Route::put('/como_soube/{id}', [ComoSoubeController::class, 'salva']);

    Route::delete('/como_soube/{id}', [ComoSoubeController::class, 'deleta'])->name('como_soube.deleta');

    ## MÓDULO DE COMERCIAL ATIVO
    Route::get('/comercial_ativo/adiciona', [ComercialAtivoController::class, 'adiciona'])->name('comercial_ativo.adiciona');
    Route::post('/comercial_ativo/adiciona', [ComercialAtivoController::class, 'salva']);

    Route::post('/comercial_ativo/{id}/atualizar_cliente', [ComercialAtivoController::class, 'atualizar_cliente'])->name('comercial_ativo.atualizar_cliente');

    ## MÓDULO DE COMERCIAL PASSIVO
    Route::get('/comercial_passivo', [ComercialPassivoController::class, 'index'])->name('comercial_passivo.index');

    Route::get('/comercial_passivo/{id}/pegar_cliente', [ComercialPassivoController::class, 'pegar_cliente'])->name('comercial_passivo.pegar_cliente');
    Route::post('/comercial_passivo/{id}/atualizar_cliente', [ComercialPassivoController::class, 'atualizar_cliente'])->name('comercial_passivo.atualizar_cliente');

    # MÓDULO DE COMERCIAL PAP
    Route::get('/comercial_pap/adiciona', [ComercialPAPController::class, 'adiciona'])->name('comercial_pap.adiciona');
    Route::post('/comercial_pap/adiciona', [ComercialPAPController::class, 'salva']);

    Route::post('/comercial_pap/{id}/atualizar_cliente', [ComercialPAPController::class, 'atualizar_cliente'])->name('comercial_pap.atualizar_cliente');

    # MÓDULO DE COMERCIAL REATIVO
    Route::get('/comercial_reativo', [ComercialReativoController::class, 'index'])->name('comercial_reativo.index');

    Route::get('/comercial_reativo/{id}/pegar_cliente', [ComercialPassivoController::class, 'pegar_cliente'])->name('comercial_reativo.pegar_cliente');
    Route::post('/comercial_reativo/{id}/atualizar_cliente', [ComercialPassivoController::class, 'atualizar_cliente'])->name('comercial_reativo.atualizar_cliente');

    # MÓDULO DE MARKETING
    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
    Route::post('/marketing', [MarketingController::class, 'enviar_emails'])->name('marketing.enviar_emails');

    # MÓDULO DE GERENTE
    Route::get('/gerente/relatorio_conversao', [GerenteController::class, 'relatorio_conversao'])->name('gerente.relatorio_conversao');

    Route::get('/gerente/cadastro_funcionario', [GerenteController::class, 'cadastro_funcionario'])->name('gerente.cadastro_funcionario');
    Route::post('/gerente/cadastro_funcionario', [GerenteController::class, 'authenticate2']);

    Route::get('/gerente/exportarCSV', [GerenteController::class, 'exportarCSV'])->name('gerente.exportarCSV');
    Route::get('/gerente/exportarPDF', [GerenteController::class, 'exportarPDF'])->name('gerente.exportarPDF');

    Route::get('/gerente/conversoes_contratados', [GerenteController::class, 'conversoes_contratados'])->name('gerente.conversoes_contratados');
    Route::get('/gerente/todas_conversoes', [GerenteController::class, 'todas_conversoes'])->name('gerente.todas_conversoes');

    Route::get('/gerente/gerenciar_funcionario', [GerenteController::class, 'gerenciar_funcionario'])->name('gerente.gerenciar_funcionario');

    Route::get('/gerente/{id}/atualiza_funcionario', [GerenteController::class, 'atualiza_funcionario'])->name('gerente.atualiza_funcionario');
    Route::put('/gerente/{id}/atualiza_funcionario', [GerenteController::class, 'atualiza_funcionario_2'])->name('gerente.atualiza_funcionario_2');

    Route::delete('/gerente/{id}', [GerenteController::class, 'delete_funcionario'])->name('gerente.delete_funcionario');

    # MÓDULO DE PLANOS
    Route::get('/plano', [PlanoController::class, 'index'])->name('plano.index');

    Route::get('/plano/adiciona', [PlanoController::class, 'adiciona'])->name('plano.adiciona');
    Route::post('/plano/adiciona', [PlanoController::class, 'salva']);

    Route::get('/plano/{id}', [PlanoController::class, 'atualiza'])->name('plano.atualiza');
    Route::put('/plano/{id}', [PlanoController::class, 'salva']);

    Route::delete('/plano/{id}', [PlanoController::class, 'deleta'])->name('plano.deleta');
});
