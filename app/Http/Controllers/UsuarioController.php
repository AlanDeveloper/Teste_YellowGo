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
            ->with('message', 'The provided credentials do not match our records')
            ->with('status', 'error')
            ->withInput();
    }

    public function register()
    {
        return view('register');
    }

    public function authenticate2(Request $request)
    {
        try {
            $user = new Usuario();
            $user->senha = Hash::make($request->senha);
            $user->email = $request->email;
            $user->nome = $request->nome;
            $user->status = $request->status;
            $user->tipo_de_usuario = $request->tipo_de_usuario;
            $user->save();
            $request->session()->regenerate();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed created with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Successfully created')
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