@extends('layout')

@if (isset($cliente))
@section('content')
<h2>Atendimento lead</h2>
<form action="{{ route('comercial_passivo.atualizar_cliente', $cliente->id) }}" method="post" id="formCreateOrUpdate">
    @csrf
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); column-gap: 10px;">
        <p>Nome: {{ $cliente->nome }}</p>
        <p>Telefone: {{ $cliente->telefone }}</p>
        <p>Bairro: {{ $cliente->bairro }}</p>
        <p>Cidade: {{ $cliente->Cidade }}</p>
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
@endsection
@else
@section('styles')
<link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
<style>
    #map {
        position: relative;
        top: 0;
        bottom: 0;
        width: 100%;
        min-height: 500px;
    }
</style>
@endsection

@section('content')
<form action="#" method="post" id="formCreateOrUpdate">
    @csrf
    <h1>Cadastrar lead</h1>
    <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" maxlength="255" value="{{ old('nome') }}">
    </div>
    <div>
        <label for="telefone">Telefone(sem caracteres especiais):</label>
        <input type="text" id="telefone" name="telefone" class="mascTelefone" maxlength="11" value="{{ old('telefone') }}" required>
    </div>
    <div>
        <label for="como_soube_id">Como soube:</label>
        <select name="como_soube_id" id="como_soube_id">
            <option value="">Selecione</option>
            @foreach ($como_soube as $cs)
            <option value="{{ $cs->id }}">{{ $cs->titulo }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="cpf">CPF(sem caracteres especiais):</label>
        <input type="text" id="cpf" name="cpf" class="mascCPF" maxlength="11" value="{{ old('cpf') }}">
    </div>
    <div>
        <label for="cep">CEP(sem caracteres especiais):</label>
        <input type="text" id="cep" name="cep" class="mascCEP" maxlength="9" value="{{ old('cep') }}">
    </div>
    <div>
        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua" maxlength="255" value="{{ old('rua') }}" readonly>
    </div>
    <div>
        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" maxlength="255" value="{{ old('numero') }}">
    </div>
    <div>
        <label for="complemento">Complemento:</label>
        <input type="text" id="complemento" name="complemento" maxlength="255" value="{{ old('complemento') }}">
    </div>
    <div>
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" maxlength="255" value="{{ old('bairro') }}" readonly>
    </div>
    <div>
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" maxlength="255" value="{{ old('cidade') }}" readonly>
    </div>
    <div>
        <label for="viabilidade">Viabilidade:</label>
        <select name="viabilidade" id="viabilidade">
            <option value="">Selecione</option>
            <option value="0">Rádio</option>
            <option value="1">Fibra</option>
            <option value="2">Inviável</option>
        </select>
    </div>
    <div>
        <label for="observação">Observação:</label>
        <textarea name="observação" id="observação" cols="30" rows="10" maxlength="1000">{{ old('observação') }}</textarea>
    </div>
    <div id="map"></div>
    <input type="hidden" name="latitude" id="latitude" required>
    <input type="hidden" name="longitude" id="longitude" required>
    <input type="submit" value="Salvar">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection

@section('scripts')
<script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>
<script>
    mapboxgl.accessToken = "{{ env('MAPBOX_ID') }}";
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [-52.3375886, -31.7653989],
        zoom: 8
    });

    // Add geolocate control to the map.
    const geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
            },
            // When active the map will receive updates to the device's location as it changes.
            trackUserLocation: true,
            // Draw an arrow next to the location dot to indicate which direction the device is heading.
            showUserHeading: true
        }
    );
    map.addControl(geolocate);

    // Get coordinates from geolocate control to the map
    geolocate.on('geolocate', function(e) {
        let lon = e.coords.longitude;
        let lat = e.coords.latitude

        $("#latitude").val(lat);
        $("#longitude").val(lon);
    });
</script>
@endsection
@endif

