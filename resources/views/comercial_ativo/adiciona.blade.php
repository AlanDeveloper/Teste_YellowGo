@extends('layout')

@section('content')
@if (isset($cliente))
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
@else
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
    <input type="submit" value="Salvar">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endif
@endsection
