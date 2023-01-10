<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GerenteController extends Controller
{
    public function relatorio_conversao(Request $request)
    {
        $contratados = DB::raw('(SELECT COUNT(*) FROM atendimentos WHERE deleted_at IS NULL AND atendimentos.created_by = usuarios.id AND atendimentos.status = 1) AS contratados');
        $total = DB::raw('(SELECT COUNT(DISTINCT cliente_id) FROM atendimentos WHERE deleted_at IS NULL AND atendimentos.created_by = usuarios.id) AS total');
        $usuario = Usuario::select('*', $contratados, $total)->orderBy('nome', 'asc');

        if ($request->responsavel_id) {

            $usuario = $usuario->where('id', $request->responsavel_id);
        }
        if ($request->tipo_de_usuario) {

            $usuario = $usuario->where('tipo_de_usuario', $request->tipo_de_usuario);
        }
        $usuario = $usuario->simplePaginate(25);
        $usuario2 = Usuario::orderBy('nome', 'asc')->get();
        return view('gerente.relatorio_conversao', ['usuario' => $usuario, 'usuario2' => $usuario2]);
    }

    public function cadastro_funcionario()
    {
        return view('gerente.cadastro_funcionario');
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

    public function exportarCSV(Request $request)
    {
        $contratados = DB::raw('(SELECT COUNT(*) FROM atendimentos WHERE deleted_at IS NULL AND atendimentos.created_by = usuarios.id AND atendimentos.status = 1) AS contratados');
        $total = DB::raw('(SELECT COUNT(DISTINCT cliente_id) FROM atendimentos WHERE deleted_at IS NULL AND atendimentos.created_by = usuarios.id) AS total');
        $usuario = Usuario::select('*', $contratados, $total)->orderBy('nome', 'asc');

        if ($request->responsavel_id) {

            $usuario = $usuario->where('id', $request->responsavel_id);
        }
        if ($request->tipo_de_usuario) {

            $usuario = $usuario->where('tipo_de_usuario', $request->tipo_de_usuario);
        }
        $usuario = $usuario->simplePaginate(25);
        $data = array();
        for ($i=0; $i < count($usuario); $i++) {
            array_push($data, array(
                'nome' => $usuario[$i]->nome,
                'email' => $usuario[$i]->email,
                'total_de_conversoes' => number_format($usuario[$i]->contratados / $usuario[$i]->total * 100, 0) . '%',
            ));
        }
        $headers = array(
            'Nome',
            'Email',
            'Total de conversões'
        );

        $output = '';
        $output .= implode(",", $headers);

        foreach ($data as $row) {
            $output .= "\n";
            $output .= implode(",", $row);
        }
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="relatório.csv"',
        );

        return \Response::make(rtrim($output, "\n"), 200, $headers);
    }

    public function exportarPDF(Request $request)
    {
        //
    }
}
