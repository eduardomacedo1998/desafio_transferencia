<?php

namespace App\Http\Controllers;

use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        $warehouses = $this->warehouseService->getAllWarehouses();
        return response()->json($warehouses);
    }

    public function show($id)
    {
        $warehouse = $this->warehouseService->getWarehouseById($id);
        if (!$warehouse) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }
        return response()->json($warehouse);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $warehouse = $this->warehouseService->createWarehouse($data);
        return response()->json($warehouse, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $warehouse = $this->warehouseService->updateWarehouse($id, $data);
        if (!$warehouse) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }
        return response()->json($warehouse);
    }

    public function destroy($id)
    {
        $deleted = $this->warehouseService->deleteWarehouse($id);
        if (!$deleted) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }
        return response()->json(['message' => 'Warehouse deleted']);
    }
}