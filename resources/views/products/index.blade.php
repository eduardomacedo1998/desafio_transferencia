@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<h1>Produtos</h1>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Novo Produto</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>SKU</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>
                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
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