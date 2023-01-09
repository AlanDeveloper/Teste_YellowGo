@extends('layout')

@section('content')
<form method="POST" id="formCreateOrUpdate">
    @csrf
    <div>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" max="255" value="{{ old('nome') }}" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" max="255" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="tipo_de_usuario">Tipo de usuário</label>
        <select name="tipo_de_usuario" id="tipo_de_usuario" required>
            <option value="">Selecione</option>
            <option value="0" @if (old('tipo_de_usuario') == '0') selected @endif>Gerente</option>
            <option value="1" @if (old('tipo_de_usuario') == '1') selected @endif>Comercial Ativo</option>
            <option value="2" @if (old('tipo_de_usuario') == '2') selected @endif>Comercial Passivo</option>
            <option value="3" @if (old('tipo_de_usuario') == '3') selected @endif>Comercial Reativo</option>
            <option value="4" @if (old('tipo_de_usuario') == '4') selected @endif>Comercial PAP</option>
            <option value="5" @if (old('tipo_de_usuario') == '5') selected @endif>Marketing</option>
        </select>
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="">Selecione</option>
            <option value="0" @if (old('status') == '0') selected @endif>Inativo</option>
            <option value="1" @if (old('status') == '1') selected @endif>Ativo</option>
        </select>
    </div>
    <div>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required>
    </div>
    <input type="submit" value="Enviar">
</form>
@endsection
