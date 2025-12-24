<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products',
        ]);

        $this->productService->createProduct($data);
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            abort(404);
        }
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            abort(404);
        }
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
        ]);

        $product = $this->productService->updateProduct($id, $data);
        if (!$product) {
            abort(404);
        }
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $deleted = $this->productService->deleteProduct($id);
        if (!$deleted) {
            abort(404);
        }
        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
    }
}