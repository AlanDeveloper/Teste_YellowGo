@extends('layout')

@section('content')
<form method="POST" id="formCreateOrUpdate">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
    </div>
    <div>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">
    </div>
    <input type="submit" value="Enviar">
</form>
@endsection
