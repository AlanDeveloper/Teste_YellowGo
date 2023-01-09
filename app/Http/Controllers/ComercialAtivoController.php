<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ComoSoube;
use Illuminate\Http\Request;

class ComercialAtivoController extends Controller
{
    public function index()
    {
        $cliente = Cliente::orderBy('nome', 'asc')->simplePaginate(25);
        return view('comercial_ativo.index', ['cliente' => $cliente]);
    }

    public function adiciona()
    {
        $como_soube = ComoSoube::orderBy('titulo', 'asc')->get();
        $cliente = Cliente::where('responsavel_id', auth()->user()->id)->first();
        return view('comercial_ativo.adiciona', ['como_soube' => $como_soube, 'cliente' => $cliente]);
    }

    public function atualiza(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        return view('comercial_ativo.atualiza', ['cliente' => $cliente]);
    }

    public function salva(Request $request, $id = null)
    {
        try {
            if (isset($id)) {
                $method = 'PUT';
                $cliente = Cliente::where('id', $id)->update($request->except(['_token', '_method']));
            } else {
                $method = 'POST';

                $data = $request->all();
                $data['status'] = '0';
                $data['responsavel_id'] = auth()->user()->id;
                $cliente = Cliente::create($data);
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed ' . ($method == 'POST' ? 'created' : 'updated') . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Successfully ' . ($method == 'POST' ? 'created' : 'updated'))
            ->with('status', 'success');
    }

    public function deleta($id)
    {
        try {
            Cliente::where('id', $id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('comercial_ativo.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }

    public function atender_cliente()
    {
        $cliente = Cliente::where('responsavel_id', auth()->user()->id)->first();
        return view('comercial_ativo.atendimento', ['cliente' => $cliente]);
    }

    public function atualizar_cliente(Request $request, $id)
    {
        try {
            Cliente::where('id', $id)->update(array(
                'status' => $request->status,
                'responsavel_id' => null,
            ));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('comercial_ativo.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
