<?php

use App\Models\User;


class UserRepository {

    protected $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function getUserById($userId) {
        return $this->userModel->find($userId);
    }

    public function createUser($data) {
        return $this->userModel->create($data);
    }

    public function updateUser($userId, $data) {
        $user = $this->getUserById($userId);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function deleteUser($userId) {
        $user = $this->getUserById($userId);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}