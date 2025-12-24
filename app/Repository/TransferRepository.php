<?php

namespace App\Repository;

use App\Models\Transfer;

class TransferRepository {

    protected $transferModel;

    public function __construct(Transfer $transferModel) {
        $this->transferModel = $transferModel;
    }

    public function getTransferById($transferId) {
        return $this->transferModel->find($transferId);
    }

    public function createTransfer($data) {
        return $this->transferModel->create($data);
    }

    public function updateTransfer($transferId, $data) {
        $transfer = $this->getTransferById($transferId);
        if ($transfer) {
            $transfer->update($data);
            return $transfer;
        }
        return null;
    }

    public function deleteTransfer($transferId) {
        $transfer = $this->getTransferById($transferId);
        if ($transfer) {
            return $transfer->delete();
        }
        return false;
    }

    public function getAllTransfers() {
        return $this->transferModel->with(['product', 'sourceWarehouse', 'destinationWarehouse', 'user'])->get();
    }
}   