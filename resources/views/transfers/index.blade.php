@extends('layouts.app')

@section('title', 'Transferências')

@section('content')
<h1>Transferências</h1>
<a href="{{ route('transfers.create') }}" class="btn btn-primary mb-3">Nova Transferência</a>

<table class="table table-striped">

@if (session('error'))
    <div class="alert alert-danger">   
        {{ session('error') }}
    </div>
@endif 

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<thead>

    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Origem</th>
            <th>Destino</th>
            <th>Quantidade</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transfers as $transfer)
        <tr>
            <td>{{ $transfer->id }}</td>
            <td>{{ $transfer->product ? $transfer->product->name : 'Produto não encontrado' }}</td>
            <td>{{ $transfer->sourceWarehouse ? $transfer->sourceWarehouse->name : 'Armazém não encontrado' }}</td>
            <td>{{ $transfer->destinationWarehouse ? $transfer->destinationWarehouse->name : 'Armazém não encontrado' }}</td>
            <td>{{ $transfer->quantity }}</td>
            <td>{{ $transfer->status }}</td>
            <td>
                <a href="{{ route('transfers.show', $transfer) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('transfers.edit', $transfer) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('transfers.destroy', $transfer) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection