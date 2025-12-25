<?php

namespace App\Services;

use App\Repository\TransferRepository;

class TransferService {

    protected $transferRepository;

    public function __construct(TransferRepository $transferRepository) {
        $this->transferRepository = $transferRepository;
    }

    public function createTransfer($data) {
        return $this->transferRepository->createTransfer($data);
    }

    public function getTransferById($id) {
        return $this->transferRepository->getTransferById($id);
    }

    public function updateTransfer($id, $data) {
        return $this->transferRepository->updateTransfer($id, $data);
    }

    public function deleteTransfer($id) {
        return $this->transferRepository->deleteTransfer($id);
    }

    public function getAllTransfers() {
        return $this->transferRepository->getAllTransfers();
    }
       
    public function getStatusMessage($status) {
        $statusMessages = [
            'pending' => 'Pendente',
            'completed' => 'Concluído',
            'canceled' => 'Cancelado',
        ];

        return $statusMessages[$status] ?? 'Desconhecido';
    }
}