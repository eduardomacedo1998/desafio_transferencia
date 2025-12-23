<?php

namespace App\Services;

use App\Repository\UserRepository;

class UserService {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function createUser($data) {
        return $this->userRepository->createUser($data);
    }

    public function getUserById($id) {
        return $this->userRepository->getUserById($id);
    }

    public function updateUser($id, $data) {
        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser($id) {
        return $this->userRepository->deleteUser($id);
    }

    public function getAllUsers() {
        return $this->userRepository->getAllUsers();
    }
}