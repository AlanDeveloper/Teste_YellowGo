@extends('layout')

@section('content')
<form action="#" method="post" id="formCreateOrUpdate">
    @csrf
    <h1>Cadastrar lead</h1>
    <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" maxlength="255" value="{{ old('nome') }}">
    </div>
    <div>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" maxlength="255" value="{{ old('telefone') }}" required>
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
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" value="{{ old('cpf') }}">
    </div>
    <div>
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" value="{{ old('cep') }}">
    </div>
    <div>
        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua" maxlength="255" value="{{ old('rua') }}">
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
        <input type="text" id="bairro" name="bairro" maxlength="255" value="{{ old('bairro') }}">
    </div>
    <div>
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" maxlength="255" value="{{ old('cidade') }}">
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
@endsection
