@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<h1>Editar Usuário</h1>

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Nova Senha (deixe em branco para manter)</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection