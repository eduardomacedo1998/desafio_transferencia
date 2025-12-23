<?php

namespace App\Repository;


use App\Models\Product;



class ProductRepository {

    protected $productModel;

    public function __construct(Product $productModel) {
        $this->productModel = $productModel;
    }

    public function getProductById($productId) {
        return $this->productModel->find($productId);
    }

    public function createProduct($data) {
        return $this->productModel->create($data);
    }

    public function updateProduct($productId, $data) {
        $product = $this->getProductById($productId);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function deleteProduct($productId) {
        $product = $this->getProductById($productId);
        if ($product) {
            return $product->delete();
        }
        return false;
    }

    public function getAllProducts() {
        return $this->productModel->all();
    }
}