@extends('layout')

@section('content')
<a href="{{ route('plano.adiciona') }}">
    <button>Cadastrar</button>
</a>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Valor</th>
            <th>Status</th>
            <th>Descrição</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($plano as $p)
        <tr>
            <td>{{ $p->nome }}</td>
            <td>R$ {{ number_format($p->valor, 2) }}</td>
            <td>{{ $p->status == '1' ? 'Ativo' : 'Inativo' }}</td>
            <td>{{ $p->descricao }}</td>
            <td><a href="{{ route('plano.atualiza', $p->id) }}">Atualizar</a></td>
            <td>
                <form action="{{ route('plano.deleta', $p->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Deletar">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($plano) == 0)
        <tr>
            <td colspan="1">Nenhum dado registrado</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $plano->links() }}
</div>
@endsection
