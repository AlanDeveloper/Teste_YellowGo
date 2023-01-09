<?php

namespace App\Http\Controllers;

use App\Models\ComoSoube;
use Illuminate\Http\Request;

class ComoSoubeController extends Controller
{
    public function index()
    {
        $como_soube = ComoSoube::orderBy('titulo', 'asc')->simplePaginate(25);
        return view('como_soube.index', ['como_soube' => $como_soube]);
    }

    public function adiciona()
    {
        return view('como_soube.adiciona');
    }

    public function atualiza(Request $request, $id)
    {
        $como_soube = ComoSoube::find($id);
        return view('como_soube.atualiza', ['como_soube' => $como_soube]);
    }

    public function salva(Request $request, $id = null)
    {
        try {
            if (isset($id)) {
                $method = 'PUT';
                $como_soube = ComoSoube::where('id', $id)->update($request->except(['_token', '_method']));
            } else {
                $method = 'POST';
                $como_soube = ComoSoube::create($request->all());
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed ' . ($method == 'POST' ? 'created' : 'updated') . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->route('como_soube.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully ' . ($method == 'POST' ? 'created' : 'updated'))
            ->with('status', 'success');
    }

    public function deleta($id)
    {
        try {
            ComoSoube::where('id', $id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('como_soube.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
