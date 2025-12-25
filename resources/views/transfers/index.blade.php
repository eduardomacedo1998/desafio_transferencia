@extends('layouts.app')

@section('title', 'Transferências')

@section('content')
<h1>Transferências</h1>
<a href="{{ route('transfers.create') }}" class="btn btn-primary mb-3">Nova Transferência</a>

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

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Origem</th>
            <th>Destino</th>
            <th>Quantidade</th>
            <th>Status</th>
            <th>Mensagem</th>
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
            <td>
                @if($transfer->status === 'pending')
                    <span class="badge bg-warning">{{ ucfirst($transfer->status) }}</span>
                @elseif($transfer->status === 'completed')
                    <span class="badge bg-success">{{ ucfirst($transfer->status) }}</span>
                @else
                    <span class="badge bg-danger">{{ ucfirst($transfer->status) }}</span>
                @endif
            </td>
            <td>
                @if($transfer->status === 'pending')
                    <small class="text-warning">⏳ Aguardando conclusão...</small>
                @elseif($transfer->status === 'completed')
                    <small class="text-success">✅ Concluída com sucesso!</small>
                @else
                    <small class="text-danger">❌ Cancelada</small>
                @endif
            </td>
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