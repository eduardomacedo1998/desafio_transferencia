@extends('layouts.app')

@section('title', 'Criar Armazém')

@section('content')
<h1>Criar Armazém</h1>

<form action="{{ route('warehouses.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection