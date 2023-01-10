<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function login ()
    {
        return view('login');
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->senha
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        return redirect()->back()
            ->with('header', 'Error')
            ->with('message', 'As credenciais fornecidas não correspondem aos nossos registros')
            ->with('status', 'error')
            ->withInput();
    }

    public function perfil()
    {
        return view('perfil');
    }

    public function salva_perfil(Request $request)
    {
        try {
            if (is_null($request->senha)) {
                $data = $request->except(['_token', '_method', 'senha']);
            } else {
                $data = $request->except(['_token', '_method']);
            }
            Usuario::where('id', auth()->user()->id)->update($data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Falha ao atualizar com mensagem "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('perfil')
            ->with('header', 'Success')
            ->with('message', 'Sucesso ao atualizar')
            ->with('status', 'success');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
