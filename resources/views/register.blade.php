@extends('layout')

@section('content')
<form method="POST" id="formCreateOrUpdate">
    @csrf
    <div>
        <label for="name">Nome</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Senha</label>
        <input type="password" name="password" id="password">
    </div>
    <input type="submit" value="Enviar">
</form>
<a href="{{ route('login') }}">Possuí uma conta? Entre</a>
@endsection
