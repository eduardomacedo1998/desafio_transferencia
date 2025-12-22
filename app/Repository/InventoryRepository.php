<?php

use App\Models\Inventory;


class InventoryRepository {

    protected $inventoryModel;

    public function __construct(Inventory $inventoryModel) {
        $this->inventoryModel = $inventoryModel;
    }

    public function getInventory($warehouseId, $productId) {
        return $this->inventoryModel
            ->where('warehouse_id', $warehouseId)
            ->where('product_id', $productId)
            ->first();
    }

    public function updateInventory($warehouseId, $productId, $quantity) {
        $inventory = $this->getInventory($warehouseId, $productId);
        if ($inventory) {
            $inventory->quantity = $quantity;
            return $inventory->save();
        }
        return false;
    }

}