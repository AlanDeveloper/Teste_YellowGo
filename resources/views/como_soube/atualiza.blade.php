@extends('layout')

@section('content')
<form action="#" method="post" id="formCreateOrUpdate">
    @csrf
    @method('put')
    <h1>Atualizar opção de como soube</h1>
    <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" maxlength="255" value="{{ $como_soube->titulo }}" required>
    </div>
    <div>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" cols="30" rows="10" maxlength="1000">{{ $como_soube->descricao }}</textarea>
    </div>
    <input type="submit" value="Salvar">
</form>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@endsection
