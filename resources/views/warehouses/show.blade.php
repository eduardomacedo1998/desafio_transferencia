@extends('layouts.app')

@section('title', 'Detalhes do Armazém')

@section('content')
<h1>Detalhes do Armazém</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $warehouse->name }}</h5>
        <p class="card-text"><strong>ID:</strong> {{ $warehouse->id }}</p>
    </div>
</div>

<a href="{{ route('warehouses.edit', $warehouse) }}" class="btn btn-warning mt-3">Editar</a>
<a href="{{ route('warehouses.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection