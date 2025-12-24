<?php

namespace App\Http\Controllers;

use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseWebController extends Controller
{
    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        $warehouses = $this->warehouseService->getAllWarehouses();
        return view('warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->warehouseService->createWarehouse($data);
        return redirect()->route('warehouses.index')->with('success', 'Armazém criado com sucesso!');
    }

    public function show($id)
    {
        $warehouse = $this->warehouseService->getWarehouseById($id);
        if (!$warehouse) {
            abort(404);
        }
        return view('warehouses.show', compact('warehouse'));
    }

    public function edit($id)
    {
        $warehouse = $this->warehouseService->getWarehouseById($id);
        if (!$warehouse) {
            abort(404);
        }
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $warehouse = $this->warehouseService->updateWarehouse($id, $data);
        if (!$warehouse) {
            abort(404);
        }
        return redirect()->route('warehouses.index')->with('success', 'Armazém atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $deleted = $this->warehouseService->deleteWarehouse($id);
        if (!$deleted) {
            abort(404);
        }
        return redirect()->route('warehouses.index')->with('success', 'Armazém excluído com sucesso!');
    }
}