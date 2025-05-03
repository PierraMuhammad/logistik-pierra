<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function tableProduct()
    {
        return view('content.product.table');
    }

    public function formProduct()
    {
        return view('content.product.form');
    }

    public function get()
    {
        try {
            $products = $this->productService->getAllProducts();

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function findById(string $id)
    {
        try {
            $product = $this->productService->findProductById($id);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $product,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $product = $this->productService->createProduct($request);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $product,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $product = $this->productService->updateProduct($request, $id);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $product,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete(string $id)
    {
        try {
            $product = $this->productService->deleteProduct($id);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $product,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
