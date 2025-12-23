<?php

namespace App\Repository;

use App\Models\Warehouse;

class WareHouseRepository {

    protected $wareHouseModel;

    public function __construct(Warehouse $wareHouseModel) {
        $this->wareHouseModel = $wareHouseModel;
    }

    public function getWareHouseById($wareHouseId) {
        return $this->wareHouseModel->find($wareHouseId);
    }

    public function createWareHouse($data) {
        return $this->wareHouseModel->create($data);
    }

    public function updateWareHouse($wareHouseId, $data) {
        $wareHouse = $this->getWareHouseById($wareHouseId);
        if ($wareHouse) {
            $wareHouse->update($data);
            return $wareHouse;
        }
        return null;
    }

    public function deleteWareHouse($wareHouseId) {
        $wareHouse = $this->getWareHouseById($wareHouseId);
        if ($wareHouse) {
            return $wareHouse->delete();
        }
        return false;
    }

    public function getAllWarehouses() {
        return $this->wareHouseModel->all();
    }
}