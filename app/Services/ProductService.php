<?php

namespace App\Services;

use App\Repository\ProductRepository;

class ProductService {

    protected $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function createProduct($data) {
        return $this->productRepository->createProduct($data);
    }

    public function getProductById($id) {
        return $this->productRepository->getProductById($id);
    }

    public function updateProduct($id, $data) {
        return $this->productRepository->updateProduct($id, $data);
    }

    public function deleteProduct($id) {
        return $this->productRepository->deleteProduct($id);
    }

    public function getAllProducts() {
        return $this->productRepository->getAllProducts();
    }
}