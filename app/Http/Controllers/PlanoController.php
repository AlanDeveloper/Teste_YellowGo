<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    public function index()
    {
        $plano = Plano::orderBy('nome', 'asc')->simplePaginate(25);
        return view('plano.index', ['plano' => $plano]);
    }

    public function adiciona()
    {
        return view('plano.adiciona');
    }

    public function atualiza(Request $request, $id)
    {
        $plano = Plano::find($id);
        return view('plano.atualiza', ['plano' => $plano]);
    }

    public function salva(Request $request, $id = null)
    {
        try {
            if (isset($id)) {
                $method = 'PUT';
                $plano = Plano::where('id', $id)->update($request->except(['_token', '_method']));
            } else {
                $method = 'POST';
                $plano = Plano::create($request->all());
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed ' . ($method == 'POST' ? 'created' : 'updated') . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->route('plano.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully ' . ($method == 'POST' ? 'created' : 'updated'))
            ->with('status', 'success');
    }

    public function deleta($id)
    {
        try {
            Plano::where('id', $id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('plano.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
