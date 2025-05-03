<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository
    ) {}

    public function getAllProducts()
    {
        try {
            $products = $this->productRepository->getAllProducts();

            if ($products->isEmpty()) {
                throw new Exception('There is no Product');
            }

            return $products;
        } catch (Exception $e) {
            throw new Exception('Error get product: ' . $e->getMessage());
        }
    }

    public function findProductById(string $id)
    {
        try {
            $product = $this->productRepository->findProductById($id);

            if (!$product) {
                throw new Exception('Product not found');
            }

            return $product;
        } catch (Exception $e) {
            throw new Exception('Error find product: ' . $e->getMessage());
        }
    }

    public function createProduct(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = Str::random(32);
            $product = $this->productRepository->createProduct($request, $id);


            if (!$product) {
                DB::rollback();
                return null;
            }

            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Error create product: ' . $e->getMessage());
        }
    }

    public function updateProduct(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->LockProductById($id);
            if (!$product) {
                DB::rollback();
                return null;
            }

            $product = $this->productRepository->updateProduct($request, $id);
            DB::commit();

            return $product;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Error update product: ' . $e->getMessage());
        }
    }

    public function deleteProduct(String $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->LockProductById($id);
            if (!$product) {
                DB::rollback();
                return false;
            }

            $product = $this->productRepository->deleteProduct($id);
            if (!$product === 0) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Error delete product: ' . $e->getMessage());
        }
    }
}
