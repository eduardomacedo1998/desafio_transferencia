@extends('layouts.app')

@section('title', 'Editar Armazém')

@section('content')
<h1>Editar Armazém</h1>

<form action="{{ route('warehouses.update', $warehouse) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $warehouse->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection