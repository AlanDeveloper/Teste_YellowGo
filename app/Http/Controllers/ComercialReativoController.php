<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComercialReativoController extends Controller
{
    public function index()
    {
        $responsavel = DB::raw('(SELECT nome FROM usuarios WHERE usuarios.id = clientes.responsavel_id) AS responsavel');
        $cliente = Cliente::select('*', $responsavel)->where('status', '3')->simplePaginate(15);
        $c = Cliente::where('responsavel_id', auth()->user()->id)->first();
        return view('comercial_reativo.index', ['cliente' => $cliente, 'c' => $c]);
    }
}
