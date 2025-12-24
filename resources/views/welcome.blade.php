<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Transferência</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Sistema de Transferência de Produtos</h1>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Gerencie produtos, armazéns, inventários e transferências.</p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg w-100">Produtos</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('warehouses.index') }}" class="btn btn-success btn-lg w-100">Armazéns</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('inventories.index') }}" class="btn btn-warning btn-lg w-100">Inventários</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('transfers.index') }}" class="btn btn-info btn-lg w-100">Transferências</a>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg w-100">Usuários</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
