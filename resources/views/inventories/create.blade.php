@extends('layouts.app')

@section('title', 'Criar Inventário')

@section('content')
<h1>Criar Inventário</h1>

<form action="{{ route('inventories.store') }}" method="POST">
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
        <label for="warehouse_id" class="form-label">Armazém</label>
        <select class="form-control" id="warehouse_id" name="warehouse_id" required>
            @foreach($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantidade</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection