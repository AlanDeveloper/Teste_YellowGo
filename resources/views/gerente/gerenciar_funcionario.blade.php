@extends('layout')

@section('content')
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo de função</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuario as $c)
        <tr>
            <td>{{ $c->nome }}</td>
            <td>{{ $c->email }}</td>
            <td>{{ $c->tipo_de_usuario == "0" ? 'Gerente' : ($c->tipo_de_usuario == "1" ? 'Comercial Ativo' : ($c->tipo_de_usuario == "2" ? 'Comercial Passivo' : ($c->tipo_de_usuario == "3" ? 'Comercial Reativo' : ($c->tipo_de_usuario == "4" ? 'Comercial PAP' : 'Marketing')))) }}</td>
            <td>{{ $c->status == '1' ? 'Ativo' : 'Inativo' }}</td>
            <td><a href="{{ route('gerente.atualiza_funcionario', $c->id) }}">Atualizar</a></td>
            <td>
                <form action="{{ route('gerente.deleta_funcionario', $c->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Deletar">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($usuario) == 0)
        <tr>
            <td colspan="20">Nenhum dado registrado</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $usuario->links() }}
</div>
@endsection
