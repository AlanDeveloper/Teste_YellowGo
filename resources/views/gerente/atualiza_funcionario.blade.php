@extends('layout')

@section('content')
<form method="POST" id="formCreateOrUpdate">
    @csrf
    @method('put')
    <div>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" max="255" value="{{ $usuario->nome }}">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" max="255" value="{{ $usuario->email }}">
    </div>
    <div>
        <label for="tipo_de_usuario">Tipo de usuário</label>
        <select name="tipo_de_usuario" id="tipo_de_usuario">
            <option value="">Selecione</option>
            <option value="0" @if ($usuario->tipo_de_usuario == '0') selected @endif>Gerente</option>
            <option value="1" @if ($usuario->tipo_de_usuario == '1') selected @endif>Comercial Ativo</option>
            <option value="2" @if ($usuario->tipo_de_usuario == '2') selected @endif>Comercial Passivo</option>
            <option value="3" @if ($usuario->tipo_de_usuario == '3') selected @endif>Comercial Reativo</option>
            <option value="4" @if ($usuario->tipo_de_usuario == '4') selected @endif>Comercial PAP</option>
            <option value="5" @if ($usuario->tipo_de_usuario == '5') selected @endif>Marketing</option>
        </select>
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="">Selecione</option>
            <option value="0" @if ($usuario->status == '0') selected @endif>Inativo</option>
            <option value="1" @if ($usuario->status == '1') selected @endif>Ativo</option>
        </select>
    </div>
    <div>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">
    </div>
    <input type="submit" value="Enviar">
</form>
@endsection
