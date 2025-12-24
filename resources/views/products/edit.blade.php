@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
<h1>Editar Produto</h1>

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
    </div>
    <div class="mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection