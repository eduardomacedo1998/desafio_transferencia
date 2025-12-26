@extends('layouts.app')

@section('title', 'Editar Transferência')

@section('content')
<h1>Editar Transferência</h1>

<form action="{{ route('transfers.update', $transfer) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="pending" {{ $transfer->status == 'pending' ? 'selected' : '' }}>Pendente</option>
            <option value="completed" {{ $transfer->status == 'completed' ? 'selected' : '' }}>Concluída</option>
            <option value="cancelled" {{ $transfer->status == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="{{ route('transfers.index') }}" class="btn btn-secondary">Voltar</a>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>  
    @endif
</form>
@endsection