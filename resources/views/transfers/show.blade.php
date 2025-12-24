@extends('layouts.app')

@section('title', 'Detalhes da Transferência')

@section('content')
<h1>Detalhes da Transferência</h1>

<div class="card">
    <div class="card-body">
        <p class="card-text"><strong>ID:</strong> {{ $transfer->id }}</p>
        <p class="card-text"><strong>Produto:</strong> {{ $transfer->product ? $transfer->product->name : 'Produto não encontrado' }}</p>
        <p class="card-text"><strong>Origem:</strong> {{ $transfer->sourceWarehouse ? $transfer->sourceWarehouse->name : 'Armazém não encontrado' }}</p>
        <p class="card-text"><strong>Destino:</strong> {{ $transfer->destinationWarehouse ? $transfer->destinationWarehouse->name : 'Armazém não encontrado' }}</p>
    </div>
</div>

<a href="{{ route('transfers.edit', $transfer) }}" class="btn btn-warning mt-3">Editar</a>
<a href="{{ route('transfers.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection