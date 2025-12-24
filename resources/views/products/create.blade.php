@extends('layouts.app')

@section('title', 'Criar Produto')

@section('content')
<h1>Criar Produto</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" class="form-control" id="sku" name="sku" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection