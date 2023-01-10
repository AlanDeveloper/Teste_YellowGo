<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class GerenteController extends Controller
{
    public function relatorio_conversao(Request $request)
    {
        $aux = "";
        if ($request->data) {
            $aux = (' AND DATE_FORMAT(atendimentos.created_at, "%Y-%m-%d") = "' . $request->data . '"');
        }
        $convertidos = DB::raw('(select count(*) from (select COUNT(*) from `atendimentos` where atendimentos.`status` != 0 and atendimentos.cliente_id IN (SELECT cliente_id FROM atendimentos WHERE atendimentos.status = 1 AND deleted_at IS NULL) and `atendimentos`.`deleted_at` is null and atendimentos.created_by' . $aux . ' group by cliente_id having COUNT(*) > 1) s) as convertidos');
        $total = DB::raw('(select count(*) from (select COUNT(*) from `atendimentos` where atendimentos.`status` != 0 and `atendimentos`.`deleted_at` is null and atendimentos.created_by' . $aux . ' group by cliente_id having COUNT(*) > 1) s2) as total');
        $usuario = Usuario::select('*', $convertidos, $total)->orderBy('nome', 'asc');

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
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Falha ao criar com mensagem "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Sucesso ao criar')
            ->with('status', 'success');
    }

    public function exportarCSV(Request $request)
    {
        $aux = "";
        if ($request->data) {
            $aux = (' AND DATE_FORMAT(atendimentos.created_at, "%Y-%m-%d") = "' . $request->data . '"');
        }
        $contratados = DB::raw('(SELECT COUNT(*) FROM atendimentos WHERE deleted_at IS NULL AND atendimentos.created_by = usuarios.id AND atendimentos.status = 1' . $aux . ') AS contratados');
        $total = DB::raw('(SELECT COUNT(DISTINCT cliente_id) FROM atendimentos WHERE deleted_at IS NULL AND atendimentos.created_by = usuarios.id' . $aux . ') AS total');
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
        $usuario = Usuario::all();
        return view('gerente.pdf', ['usuario' => $usuario]);
        // retreive all records from db
        // share data to view
        view()->share('usuario', $usuario);
        $pdf = PDF::loadView('gerente.teste', $usuario);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function conversoes_contratados(Request $request)
    {
        try {
            $aux = "";
            if ($request->data) {
                $aux = (' AND DATE_FORMAT(atendimentos.created_at, "%Y-%m-%d") = "' . $request->data . '"');
            }
            $contratados = DB::raw('(SELECT COUNT(*) FROM atendimentos WHERE deleted_at IS NULL AND atendimentos.created_by = usuarios.id AND atendimentos.status = 1' . $aux . ') AS contratados');
            $usuario = Usuario::select('*', $contratados)->orderBy('nome', 'asc');

            if ($request->responsavel_id) {
                $usuario = $usuario->where('id', $request->responsavel_id);
            }
            if ($request->tipo_de_usuario) {
                $usuario = $usuario->where('tipo_de_usuario', $request->tipo_de_usuario);
            }
            $usuario = $usuario->get();
        } catch (\Exception $e) {
            return response()->json(array('sucesso' => false, 'error' => $e->getMessage()));
        }
        return response()->json(array('sucesso' => true, 'data' => $usuario));
    }

    public function todas_conversoes(Request $request)
    {
        try {
            $aux = "";
            if ($request->data) {
                $aux = (' AND DATE_FORMAT(atendimentos.created_at, "%Y-%m-%d") = "' . $request->data . '"');
            }
            $atendimentos = DB::raw('(SELECT COUNT(*) FROM atendimentos WHERE deleted_at IS NULL AND atendimentos.created_by = usuarios.id' . $aux . ') AS atendimentos');
            $usuario = Usuario::select('*', $atendimentos)->orderBy('nome', 'asc');

            if ($request->responsavel_id) {
                $usuario = $usuario->where('id', $request->responsavel_id);
            }
            if ($request->tipo_de_usuario) {
                $usuario = $usuario->where('tipo_de_usuario', $request->tipo_de_usuario);
            }
            $usuario = $usuario->get();
        } catch (\Exception $e) {
            return response()->json(array('sucesso' => false, 'error' => $e->getMessage()));
        }
        return response()->json(array('sucesso' => true, 'data' => $usuario));
    }

    public function gerenciar_funcionario()
    {
        $usuario = Usuario::orderBy('nome', 'asc')->simplePaginate(25);
        return view('gerente.gerenciar_funcionario', ['usuario' => $usuario]);
    }

    public function atualiza_funcionario($id)
    {
        $usuario = Usuario::where('id', $id)->first();
        return view('gerente.atualiza_funcionario', ['usuario' => $usuario]);
    }

    public function atualiza_funcionario_2(Request $request, $id)
    {
        try {
            if (is_null($request->senha)) {
                $data = $request->except(['_token', '_method', 'senha']);
            } else {
                $data = $request->except(['_token', '_method']);
            }
            Usuario::where('id', $id)->update($data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Falha ao atualizar com mensagem "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Sucesso ao atualizar')
            ->with('status', 'success');
    }

    public function deleta_usuario($id)
    {
        try {
            Usuario::where('id', $id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Falha ao deletar com mensagem "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('gerente.gerenciar_funcionario')
            ->with('header', 'Success')
            ->with('message', 'Sucesso ao deletar')
            ->with('status', 'success');
    }
}
