<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComercialPassivoController extends Controller
{
    public function index()
    {
        $responsavel = DB::raw('(SELECT nome FROM usuarios WHERE usuarios.id = clientes.responsavel_id) AS responsavel');
        $cliente = Cliente::select('*', $responsavel)->simplePaginate(15);
        $c = Cliente::where('responsavel_id', auth()->user()->id)->first();
        return view('comercial_passivo.index', ['cliente' => $cliente, 'c' => $c]);
    }

    public function pegar_cliente($id)
    {
        try {
            $cliente = Cliente::where('id', $id)->update(array(
                'status' => '0',
                'responsavel_id' => auth()->user()->id
            ));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed updated' . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Successfully updated')
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
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
