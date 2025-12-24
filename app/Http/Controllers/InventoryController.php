<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    protected $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function index()
    {
        $inventories = $this->inventoryService->getAllInventories();
        return response()->json($inventories);
    }

    public function show($id)
    {
        $inventory = $this->inventoryService->getInventoryById($id);
        if (!$inventory) {
            return response()->json(['message' => 'Inventory not found'], 404);
        }
        return response()->json($inventory);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'warehouse_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $inventory = $this->inventoryService->createInventory($data);
        return response()->json($inventory, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer',
        ]);

        $inventory = $this->inventoryService->updateInventory($id, $data);
        if (!$inventory) {
            return response()->json(['message' => 'Inventory not found'], 404);
        }
        return response()->json($inventory);
    }

    public function destroy($id)
    {
        $deleted = $this->inventoryService->deleteInventory($id);
        if (!$deleted) {
            return response()->json(['message' => 'Inventory not found'], 404);
        }
        return response()->json(['message' => 'Inventory deleted']);
    }
}