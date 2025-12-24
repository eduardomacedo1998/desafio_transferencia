<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use App\Services\ProductService;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class InventoryWebController extends Controller
{
    protected $inventoryService;
    protected $productService;
    protected $warehouseService;

    public function __construct(InventoryService $inventoryService, ProductService $productService, WarehouseService $warehouseService)
    {
        $this->inventoryService = $inventoryService;
        $this->productService = $productService;
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        $inventories = $this->inventoryService->getAllInventories();
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        $products = $this->productService->getAllProducts();
        $warehouses = $this->warehouseService->getAllWarehouses();
        return view('inventories.create', compact('products', 'warehouses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'warehouse_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $this->inventoryService->createInventory($data);
        return redirect()->route('inventories.index')->with('success', 'Inventário criado ou atualizado com sucesso!');
    }

    public function show($id)
    {
        $inventory = $this->inventoryService->getInventoryById($id);
        if (!$inventory) {
            abort(404);
        }
        $inventory->load(['product', 'warehouse']);
        return view('inventories.show', compact('inventory'));
    }

    public function edit($id)
    {
        $inventory = $this->inventoryService->getInventoryById($id);
        if (!$inventory) {
            abort(404);
        }
        return view('inventories.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer',
        ]);

        $inventory = $this->inventoryService->updateInventory($id, $data);
        if (!$inventory) {
            abort(404);
        }
        return redirect()->route('inventories.index')->with('success', 'Inventário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $deleted = $this->inventoryService->deleteInventory($id);
        if (!$deleted) {
            abort(404);
        }
        return redirect()->route('inventories.index')->with('success', 'Inventário excluído com sucesso!');
    }
}