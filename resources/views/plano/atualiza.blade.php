@extends('layout')

@section('content')
<form action="#" method="post" id="formCreateOrUpdate">
    @csrf
    @method('put')
    <h1>Atualizar opção de como soube</h1>
    <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" maxlength="255" value="{{ $plano->nome }}" required>
    </div>
    <div>
        <label for="valor">Valor:</label>
        <input type="integer" id="valor" name="valor" value="{{ $plano->valor }}" required>
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="">Selecione</option>
            <option value="0" @if ($plano->status == '0') selected @endif>Inativo</option>
            <option value="1" @if ($plano->status == '1') selected @endif>Ativo</option>
        </select>
    </div>
    <div>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" cols="30" rows="10" maxlength="1000">{{ $plano->descricao }}</textarea>
    </div>
    <input type="submit" value="Salvar">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection
