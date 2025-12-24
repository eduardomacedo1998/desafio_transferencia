@extends('layouts.app')

@section('title', 'Detalhes do Inventário')

@section('content')
<h1>Detalhes do Inventário</h1>

<div class="card">
    <div class="card-body">
        <p class="card-text"><strong>ID:</strong> {{ $inventory->id }}</p>
        <p class="card-text"><strong>Produto:</strong> {{ $inventory->product ? $inventory->product->name : 'Produto não encontrado' }}</p>
        <p class="card-text"><strong>Armazém:</strong> {{ $inventory->warehouse ? $inventory->warehouse->name : 'Armazém não encontrado' }}</p>

<a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-warning mt-3">Editar</a>
<a href="{{ route('inventories.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection