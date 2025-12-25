<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\Transfer;
use App\Repository\InventoryRepository;
use Illuminate\Support\Facades\DB;
use Exception;

class StockTransferService
{
    protected $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    /**
     * Realiza a transferência de estoque entre armazéns
     * @param array $data
     * @return Transfer|null
     * @throws Exception
     */
    public function transfer(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                // 1. Validar se armazém origem e destino são diferentes
                if ($data['source_warehouse_id'] == $data['destination_warehouse_id']) {
                    throw new Exception('O armazém de origem não pode ser igual ao de destino.');
                }

                // Apenas atualizar estoque se status for 'completed'
                if (($data['status'] ?? 'pending') === 'completed') {
                    // 2. Buscar e BLOQUEAR inventário de origem
                    $sourceInventory = Inventory::where('warehouse_id', $data['source_warehouse_id'])
                        ->where('product_id', $data['product_id'])
                        ->lockForUpdate()
                        ->first();

                    if (!$sourceInventory) {
                        throw new Exception('Inventário de origem não encontrado.');
                    }

                    if ($sourceInventory->quantity < $data['quantity']) {
                        throw new Exception('Estoque insuficiente no armazém de origem. Disponível: ' . $sourceInventory->quantity);
                    }

                    $destinationInventory = Inventory::firstOrCreate(
                        [
                            'warehouse_id' => $data['destination_warehouse_id'],
                            'product_id' => $data['product_id']
                        ],
                        ['quantity' => 0]
                    );

                    $sourceInventory->quantity -= $data['quantity'];
                    $sourceInventory->save();

                    $destinationInventory->quantity += $data['quantity'];
                    $destinationInventory->save();
                }

                // 3. Registrar a transferência
                $transfer = Transfer::create([
                    'product_id' => $data['product_id'],
                    'source_warehouse_id' => $data['source_warehouse_id'],
                    'destination_warehouse_id' => $data['destination_warehouse_id'],
                    'quantity' => $data['quantity'],
                    'user_id' => $data['user_id'] ?? null,
                    'status' => $data['status'] ?? 'pending'
                ]);

                return $transfer;
            });
        } catch (Exception $e) {
            throw new Exception('Erro na transferência: ' . $e->getMessage());
        }
    }
}