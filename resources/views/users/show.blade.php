@extends('layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')
<h1>Detalhes do Usuário</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $user->name }}</h5>
        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
    </div>
</div>

<a href="{{ route('users.edit', $user) }}" class="btn btn-warning mt-3">Editar</a>
<a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection