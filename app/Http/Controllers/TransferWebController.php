<?php

namespace App\Http\Controllers;

use App\Services\TransferService;
use App\Services\ProductService;
use App\Services\WarehouseService;
use App\Services\StockTransferService;
use Illuminate\Http\Request;

class TransferWebController extends Controller
{
    protected $transferService;
    protected $productService;
    protected $warehouseService;
    protected $stockTransferService;

    public function __construct(TransferService $transferService, ProductService $productService, WarehouseService $warehouseService, StockTransferService $stockTransferService)
    {
        $this->transferService = $transferService;
        $this->productService = $productService;
        $this->warehouseService = $warehouseService;
        $this->stockTransferService = $stockTransferService;
    }

    public function index()
    {
        $transfers = $this->transferService->getAllTransfers();
        return view('transfers.index', compact('transfers'));
    }

    public function create()
    {
        $products = $this->productService->getAllProducts();
        $warehouses = $this->warehouseService->getAllWarehouses();
        return view('transfers.create', compact('products', 'warehouses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'source_warehouse_id' => 'required|integer|exists:warehouses,id',
            'destination_warehouse_id' => 'required|integer|exists:warehouses,id',
            'quantity' => 'required|integer|min:1',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        try {
            // Usar StockTransferService para garantir atualização de estoque
            $this->stockTransferService->transfer($data);
            return redirect()->route('transfers.index')->with('success', 'Transferência criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $transfer = $this->transferService->getTransferById($id);
        if (!$transfer) {
            abort(404);
        }
        $transfer->load(['product', 'sourceWarehouse', 'destinationWarehouse', 'user']);
        return view('transfers.show', compact('transfer'));
    }

    public function edit($id)
    {
        $transfer = $this->transferService->getTransferById($id);
        if (!$transfer) {
            abort(404);
        }
        return view('transfers.edit', compact('transfer'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|string',
        ]);

        $transfer = $this->transferService->updateTransfer($id, $data);
        if (!$transfer) {
            abort(404);
        }
        return redirect()->route('transfers.index')->with('success', 'Transferência atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $deleted = $this->transferService->deleteTransfer($id);
        if (!$deleted) {
            abort(404);
        }
        return redirect()->route('transfers.index')->with('success', 'Transferência excluída com sucesso!');
    }
}