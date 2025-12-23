<?php

namespace App\Services;

use App\Repository\WareHouseRepository;

class WarehouseService {

    protected $warehouseRepository;

    public function __construct(WareHouseRepository $warehouseRepository) {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function createWarehouse($data) {
        return $this->warehouseRepository->createWareHouse($data);
    }

    public function getWarehouseById($id) {
        return $this->warehouseRepository->getWareHouseById($id);
    }

    public function updateWarehouse($id, $data) {
        return $this->warehouseRepository->updateWareHouse($id, $data);
    }

    public function deleteWarehouse($id) {
        return $this->warehouseRepository->deleteWareHouse($id);
    }

    public function getAllWarehouses() {
        return $this->warehouseRepository->getAllWarehouses();
    }
}