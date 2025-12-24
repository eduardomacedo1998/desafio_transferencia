<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Transferência')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Sistema de Transferência</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('products.index') }}">Produtos</a>
                <a class="nav-link" href="{{ route('warehouses.index') }}">Armazéns</a>
                <a class="nav-link" href="{{ route('inventories.index') }}">Inventários</a>
                <a class="nav-link" href="{{ route('transfers.index') }}">Transferências</a>
                <a class="nav-link" href="{{ route('users.index') }}">Usuários</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>