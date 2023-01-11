@extends('layout')

@section('content')
<a href="{{ route('como_soube.adiciona') }}">
    <button>Cadastrar</button>
</a>
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($como_soube as $cs)
        <tr>
            <td>{{ $cs->titulo }}</td>
            <td>{{ $cs->descricao }}</td>
            <td><a href="{{ route('como_soube.atualiza', $cs->id) }}">Atualizar</a></td>
            <td>
                <form action="{{ route('como_soube.deleta', $cs->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Deletar">
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($como_soube) == 0)
        <tr>
            <td colspan="20">Nenhum dado registrado</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $como_soube->links() }}
</div>
@endsection
