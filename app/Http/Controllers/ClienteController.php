<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ComoSoube;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = Cliente::orderBy('nome', 'asc')->simplePaginate(25);
        return view('cliente.index', ['cliente' => $cliente]);
    }

    public function adiciona()
    {
        $como_soube = ComoSoube::orderBy('titulo', 'asc')->get();
        return view('cliente.adiciona', ['como_soube' => $como_soube]);
    }

    public function atualiza(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        return view('cliente.atualiza', ['cliente' => $cliente]);
    }

    public function salva(Request $request, $id = null)
    {
        try {
            if (isset($id)) {
                $method = 'PUT';
                $cliente = Cliente::where('id', $id)->update($request->except(['_token', '_method']));
            } else {
                $method = 'POST';
                $cliente = Cliente::create($request->all());
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed ' . ($method == 'POST' ? 'created' : 'updated') . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->route('cliente.index')
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
        return redirect()->route('cliente.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
