@extends('layout')

@section('content')
@php
    $nenhum_resultado = true;
@endphp
<form method="get">
    <div>
        <label for="email">Email</label>
        <select name="email" id="email">
            <option value="">Selecione</option>
            <option value="0" @if (request('email') == '0') selected @endif>Sem email</option>
            <option value="1" @if (request('email') == '1') selected @endif>Com email</option>
        </select>
    </div>
    <div>
        <label for="data">Data</label>
        <input type="date" name="data" id="data" value="{{ request('data') }}">
    </div>
    <input type="submit" value="Procurar">
</form>
<div>
    <label for="selecionar_todos">Selecionar todos</label>
    <input type="checkbox" name="selecionar_todos" id="selecionar_todos">
</div>
<form method="post">
    @csrf
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Email</th>
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
            @if ($status < 40)
            <tr>
                <td>
                    <input type="checkbox" name="cliente_id" value="{{ $c->id }}" @if (is_null($c->email)) disabled @endif>
                </td>
                <td>{{ $c->nome }}</td>
                <td>{{ is_null($c->email) ? '-' : $c->email  }}</td>
            </tr>
            @php
                $nenhum_resultado = false;
            @endphp
            @endif
            @endforeach
            @if (count($cliente) == 0 || $nenhum_resultado)
            <tr>
                <td colspan="20">Nenhum dado registrado</td>
            </tr>
            @endif
        </tbody>
    </table>
    <input type="submit" value="Enviar emails" @if (count($cliente) == 0) disabled @endif>
</form>
<div style="text-align: center">
    {{ $cliente->links() }}
</div>
@endsection

@section('scripts')
<script>
    $("#selecionar_todos").change(function() {
        let checked = $(this).is(":checked");

        $("form input[type='checkbox']").each(function () {
            if (!$(this).attr("disabled")) {
                $(this).prop( "checked", checked);
            }
        });
    });
</script>
@endsection
