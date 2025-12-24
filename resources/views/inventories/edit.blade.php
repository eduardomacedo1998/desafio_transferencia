@extends('layouts.app')

@section('title', 'Editar Inventário')

@section('content')
<h1>Editar Inventário</h1>

<form action="{{ route('inventories.update', $inventory) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantidade</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $inventory->quantity }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection