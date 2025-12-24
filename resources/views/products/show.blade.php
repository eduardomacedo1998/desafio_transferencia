@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')
<h1>Detalhes do Produto</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text"><strong>SKU:</strong> {{ $product->sku }}</p>
        <p class="card-text"><strong>ID:</strong> {{ $product->id }}</p>
                <p class="card-text"><strong>ID:</strong> {{ $product->id }}</p>


    </div>
</div>

<a href="{{ route('products.edit', $product) }}" class="btn btn-warning mt-3">Editar</a>
<a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection