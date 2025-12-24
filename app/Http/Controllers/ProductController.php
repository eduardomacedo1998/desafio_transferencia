<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products',
        ]);

        $product = $this->productService->createProduct($data);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $id,
        ]);

        $product = $this->productService->updateProduct($id, $data);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function destroy($id)
    {
        $deleted = $this->productService->deleteProduct($id);
        if (!$deleted) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['message' => 'Product deleted']);
    }
}