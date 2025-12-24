<?php

namespace App\Http\Controllers;

use App\Services\StockTransferService;
use App\Services\TransferService;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    protected $stockTransferService;
    protected $transferService;

    public function __construct(StockTransferService $stockTransferService, TransferService $transferService)
    {
        $this->stockTransferService = $stockTransferService;
        $this->transferService = $transferService;
    }

    /**
     * Endpoint para realizar transferência de estoque
     */
    public function transfer(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'source_warehouse_id' => 'required|exists:warehouses,id',
            'destination_warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|integer|min:1',
            'user_id' => 'nullable|exists:users,id',
        ]);

        try {
            $transfer = $this->stockTransferService->transfer($data);
            
            return response()->json([
                'message' => 'Transferência realizada com sucesso!',
                'transfer' => $transfer->load(['product', 'sourceWarehouse', 'destinationWarehouse', 'user'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function index()
    {
        $transfers = $this->transferService->getAllTransfers();
        return response()->json($transfers);
    }

    public function show($id)
    {
        $transfer = $this->transferService->getTransferById($id);
        if (!$transfer) {
            return response()->json(['message' => 'Transfer not found'], 404);
        }
        return response()->json($transfer);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer',
            'source_warehouse_id' => 'required|integer',
            'destination_warehouse_id' => 'required|integer',
            'quantity' => 'required|integer',
            'user_id' => 'nullable|integer',
            'status' => 'required|string',
        ]);

        $transfer = $this->transferService->createTransfer($data);
        return response()->json($transfer, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'product_id' => 'nullable|integer',
            'source_warehouse_id' => 'nullable|integer',
            'destination_warehouse_id' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'status' => 'nullable|string',
        ]);

        $transfer = $this->transferService->updateTransfer($id, $data);
        if (!$transfer) {
            return response()->json(['message' => 'Transfer not found'], 404);
        }
        return response()->json($transfer);
    }

    public function destroy($id)
    {
        $deleted = $this->transferService->deleteTransfer($id);
        if (!$deleted) {
            return response()->json(['message' => 'Transfer not found'], 404);
        }
        return response()->json(['message' => 'Transfer deleted']);
    }

    
}