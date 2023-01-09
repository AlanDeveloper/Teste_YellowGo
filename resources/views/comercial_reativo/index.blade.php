@extends('layout')

@section('content')
@if (isset($c))
<h2>Atendimento lead</h2>
<form action="{{ route('comercial_passivo.atualizar_cliente', $c->id) }}" method="post" id="formCreateOrUpdate">
    @csrf
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); column-gap: 10px;">
        <p>Nome: {{ $c->nome }}</p>
        <p>Telefone: {{ $c->telefone }}</p>
        <p>Bairro: {{ $c->bairro }}</p>
        <p>Cidade: {{ $c->Cidade }}</p>
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="">Selecione</option>
            <option value="1">Contratou</option>
            <option value="2">Não contratou</option>
            <option value="3">Interesse</option>
        </select>
    </div>
    <input type="submit" value="Salvar">
</form>
@else
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Status</th>
            <th>Responsável</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cliente as $c)
        @php
            $count = 0;
            $total = 0;
            foreach ($c->toArray() as $key => $value) {
                if (!is_null($value)) {
                    $count ++;
                }
                $total++;
            }

            $status = number_format (($count - 5) / ($total - 5) * 100, 0);
        @endphp
        <tr>
            <td>{{ $c->nome }}</td>
            <td>{{ $status >= 75 ? 'Quente' : ($status < 75 && $status >= 40 ? 'Morno' : 'Frio') }} ({{ $status }}%)</td>
            <td>{{ isset($c->responsavel) ? $c->responsavel : '-'}}</td>
            <td>
                <form action="{{ route('comercial_reativo.pegar_cliente', $c->id) }}">
                    @csrf
                    <input type="submit" value="Pegar" @if (isset($c->responsavel_id) || $c->status != 3) disabled @endif>
                </form>
            </td>
        </tr>
        @endforeach
        @if (count($cliente) == 0)
        <tr>
            <td colspan="1">Nenhum dado registrado</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $cliente->links() }}
</div>
@endif
@endsection
