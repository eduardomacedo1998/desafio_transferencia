@extends('layouts.app')

@section('title', 'Criar Transferência')

@section('content')
<h1>Criar Transferência</h1>

<form action="{{ route('transfers.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="product_id" class="form-label">Produto</label>
        <select class="form-control" id="product_id" name="product_id" required>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="source_warehouse_id" class="form-label">Armazém de Origem</label>
        <select class="form-control" id="source_warehouse_id" name="source_warehouse_id" required>
            @foreach($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="destination_warehouse_id" class="form-label">Armazém de Destino</label>
        <select class="form-control" id="destination_warehouse_id" name="destination_warehouse_id" required>
            @foreach($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantidade</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="pending">Pendente</option>
            <option value="completed">Concluída</option>
            <option value="cancelled">Cancelada</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('transfers.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection