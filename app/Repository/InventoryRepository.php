<?php

namespace App\Repository;

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

    public function createInventory($warehouseId, $productId, $quantity) {
        return $this->inventoryModel->updateOrCreate(
            ['warehouse_id' => $warehouseId, 'product_id' => $productId],
            ['quantity' => $quantity]
        );
    }

    public function getInventoryById($id) {
        return $this->inventoryModel->find($id);
    }

    public function updateInventoryById($id, $data) {
        $inventory = $this->getInventoryById($id);
        if ($inventory) {
            $inventory->update($data);
            return $inventory;
        }
        return null;
    }

    public function deleteInventory($id) {
        $inventory = $this->getInventoryById($id);
        if ($inventory) {
            return $inventory->delete();
        }
        return false;
    }

    public function getAllInventories() {
        return $this->inventoryModel->with(['product', 'warehouse'])->get();
    }

}