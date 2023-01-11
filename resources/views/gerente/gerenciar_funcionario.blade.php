@extends('layout')

@section('content')
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
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
            <td>{{ $c->status == '1' ? 'Ativo' : 'Inativo' }}</td>
            <td><a href="{{ route('gerente.atualiza_funcionario', $c->id) }}">Atualizar</a></td>
            <td>
                <form action="{{ route('gerente.delete_funcionario', $c->id) }}" method="post">
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
