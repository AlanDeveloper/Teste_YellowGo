<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComercialReativoController extends Controller
{
    public function index()
    {
        $responsavel = DB::raw('(SELECT nome FROM usuarios WHERE usuarios.id = clientes.responsavel_id) AS responsavel');
        $cliente = Cliente::select('*', $responsavel)->where('status', '3')->simplePaginate(25);
        $c = Cliente::where('responsavel_id', auth()->user()->id)->first();
        return view('comercial_reativo.index', ['cliente' => $cliente, 'c' => $c]);
    }

    public function pegar_cliente($id)
    {
        try {
            $cliente = Cliente::where('id', $id)->update(
                array(
                    'status' => '0',
                    'responsavel_id' => auth()->user()->id
                )
            );
            Atendimento::create(
                array(
                    'status' => '0',
                    'cliente_id' => $id
                )
            );
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Falha ao atualizar com mensagem "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Sucesso ao atualizar')
            ->with('status', 'success');
    }

    public function atualizar_cliente(Request $request, $id)
    {
        try {
            Cliente::where('id', $id)->update(
                array(
                    'status' => $request->status,
                    'responsavel_id' => null,
                )
            );
            Atendimento::create(
                array(
                    'status' => $request->status,
                    'cliente_id' => $id
                )
            );
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Falha ao deletar com mensagem "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Sucesso ao atualizar')
            ->with('status', 'success');
    }
}
