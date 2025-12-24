@extends('layouts.app')

@section('title', 'Inventários')

@section('content')
<h1>Inventários</h1>
<a href="{{ route('inventories.create') }}" class="btn btn-primary mb-3">Novo Inventário</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Armazém</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventories as $inventory)
        <tr>
            <td>{{ $inventory->id }}</td>
            <td>{{ $inventory->product ? $inventory->product->name : 'Produto não encontrado' }}</td>
            <td>{{ $inventory->warehouse ? $inventory->warehouse->name : 'Armazém não encontrado' }}</td>
            <td>{{ $inventory->quantity }}</td>
            <td>
                <a href="{{ route('inventories.show', $inventory) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('inventories.destroy', $inventory) }}" method="POST" style="display:inline;">
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