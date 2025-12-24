@extends('layouts.app')

@section('title', 'Armazéns')

@section('content')
<h1>Armazéns</h1>
<a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-3">Novo Armazém</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($warehouses as $warehouse)
        <tr>
            <td>{{ $warehouse->id }}</td>
            <td>{{ $warehouse->name }}</td>
            <td>
                <a href="{{ route('warehouses.show', $warehouse) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('warehouses.edit', $warehouse) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST" style="display:inline;">
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