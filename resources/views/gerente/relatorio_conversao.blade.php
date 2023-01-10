@extends('layout')

@section('content')
<form method="get">
    <div>
        <label for="responsavel_id">Usuário</label>
        <select name="responsavel_id" id="responsavel_id">
            <option value="">Selecione</option>
            @foreach ($usuario2 as $u)
            <option value="{{ $u->id }}" @if (request('responsavel_id') == $u->id) selected @endif>{{ $u->nome }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="tipo_de_usuario">Tipo de usuário</label>
        <select name="tipo_de_usuario" id="tipo_de_usuario">
            <option value="">Selecione</option>
            <option value="1" @if (request('tipo_de_usuario') == '1') selected @endif>Comercial Ativo</option>
            <option value="2" @if (request('tipo_de_usuario') == '2') selected @endif>Comercial Passivo</option>
            <option value="3" @if (request('tipo_de_usuario') == '3') selected @endif>Comercial Reativo</option>
            <option value="4" @if (request('tipo_de_usuario') == '4') selected @endif>Comercial PAP</option>
        </select>
    </div>
    <div>
        <label for="data">Data</label>
        <input type="date" name="data" id="data" value="{{ request('data') }}">
    </div>
    <input type="submit" value="Procurar">
</form>
<a href="{{ route('gerente.exportarCSV') }}">Exportar CSV</a>
<a href="{{ route('gerente.exportarPDF') }}">Exportar PDF</a>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Total de conversões</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuario as $u)
        <tr>
            <td>{{ $u->nome }}</td>
            <td>{{ number_format($u->contratados / ($u->total == 0 ? 1 : $u->total) * 100, 0) }}%</td>
        </tr>
        @endforeach
        @if (count($usuario) == 0)
        <tr>
            <td colspan="1">Nenhum dado registrado</td>
        </tr>
        @endif
    </tbody>
</table>
<div style="text-align: center">
    {{ $usuario->links() }}
</div>

<canvas id="conversoes_contratados"></canvas>
<canvas id="todas_conversoes"></canvas>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let url = "?" + window.location.href.split('?')[1];
    $.getJSON("/gerente/conversoes_contratados" + url, function(colaboradores) {

        if (colaboradores.sucesso) {

            const ctx = document.getElementById('conversoes_contratados');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: colaboradores.data.map(usuario => usuario.nome),
                    datasets: [{
                        label: 'Clientes que contraram um plano',
                        data: colaboradores.data.map(usuario => usuario.contratados),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });

    $.getJSON("/gerente/todas_conversoes" + url, function(colaboradores) {

        if (colaboradores.sucesso) {

            const ctx = document.getElementById('todas_conversoes');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: colaboradores.data.map(usuario => usuario.nome),
                    datasets: [{
                        label: 'Clientes que contraram um plano',
                        data: colaboradores.data.map(usuario => usuario.atendimentos),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
