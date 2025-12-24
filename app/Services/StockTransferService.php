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

                // 2. Buscar e BLOQUEAR inventário de origem (lock pessimista)
                $sourceInventory = Inventory::where('warehouse_id', $data['source_warehouse_id'])
                    ->where('product_id', $data['product_id'])
                    ->lockForUpdate()
                    ->first();

                // 3. Validar existência do inventário de origem
                if (!$sourceInventory) {
                    throw new Exception('Inventário de origem não encontrado.');
                }

                // 4. Validar estoque suficiente
                if ($sourceInventory->quantity < $data['quantity']) {
                    throw new Exception('Estoque insuficiente no armazém de origem. Disponível: ' . $sourceInventory->quantity);
                }

                // 5. Buscar ou criar inventário de destino
                $destinationInventory = Inventory::firstOrCreate(
                    [
                        'warehouse_id' => $data['destination_warehouse_id'],
                        'product_id' => $data['product_id']
                    ],
                    ['quantity' => 0]
                );

                // 6. DECREMENTAR estoque na origem
                $sourceInventory->quantity -= $data['quantity'];
                $sourceInventory->save();

                // 7. INCREMENTAR estoque no destino
                $destinationInventory->quantity += $data['quantity'];
                $destinationInventory->save();

                // 8. Registrar a transferência
                $transfer = Transfer::create([
                    'product_id' => $data['product_id'],
                    'source_warehouse_id' => $data['source_warehouse_id'],
                    'destination_warehouse_id' => $data['destination_warehouse_id'],
                    'quantity' => $data['quantity'],
                    'user_id' => $data['user_id'] ?? null,
                    'status' => 'completed'
                ]);

                return $transfer;
            });
        } catch (Exception $e) {
            throw new Exception('Erro na transferência: ' . $e->getMessage());
        }
    }
}