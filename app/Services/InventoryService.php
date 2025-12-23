<?php

namespace App\Services;

use App\Repository\InventoryRepository;

class InventoryService {

    protected $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository) {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function createInventory($data) {
        return $this->inventoryRepository->createInventory($data['warehouse_id'], $data['product_id'], $data['quantity']);
    }

    public function getInventoryById($id) {
        return $this->inventoryRepository->getInventoryById($id);
    }

    public function updateInventory($id, $data) {
        return $this->inventoryRepository->updateInventoryById($id, $data);
    }

    public function deleteInventory($id) {
        return $this->inventoryRepository->deleteInventory($id);
    }

    public function getAllInventories() {
        return $this->inventoryRepository->getAllInventories();
    }
}