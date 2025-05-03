<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class TransactionService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected TransactionRepository $transactionRepository
    ) {}

    public function getAllTransaction()
    {
        return $this->transactionRepository->getAllTransaction();
    }

    public function getTransactionIn()
    {
        return $this->transactionRepository->getTransactionIn();
    }

    public function getTransactionOut()
    {
        return $this->transactionRepository->getTransactionOut();
    }

    public function checkInProduct(Request $request)
    {
        try {
            if ($request['id'] == null) {
                $transaction = $this->newProduct($request);
            } else {
                $transaction = $this->updateProduct($request, "+");
            }

            return $transaction;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkOutProduct(Request $request)
    {
        try {
            $id = $request['id'];
            $product = $this->productRepository->findProductById($id);

            if (!$product) {
                throw new Exception('Product not found');
            }

            if ($product['product_quantity'] - $request['quantity'] > 0) {
                return $this->updateProduct($request, "-");
            } elseif ($product['product_quantity'] - $request['quantity'] == 0) {
                return $this->deleteProduct($request);
            } else {
                throw new Exception('product quantity cannot lower than 0');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function newProduct(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = Str::random(32); // id product
            $product = $this->productRepository->createProduct($request, $id);
            if (!$product) {
                DB::rollback();
                return null;
            }

            $count = $this->transactionRepository->countTransaction();
            $count = $count + 1;

            $request['id'] = Str::random(32); // id transaction
            $request['status'] = true; // true = +, false = -
            $request['status_id'] = 'TP' . sprintf('%03d', $count);
            $request['code'] = $product['product_code'];
            $request['created_at'] = now();
            $request['updated_at'] = now();

            $transaction = $this->transactionRepository->createTransaction($request);
            if (!$transaction) {
                DB::rollback();
                return null;
            }

            DB::commit();
            return $transaction;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Error create transaction: ' . $e->getMessage());
        }
    }

    private function updateProduct(Request $request, string $plusminus)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            $product = $this->productRepository->LockProductById($id);
            if (!$product) {
                DB::rollback();
                return null;
            }

            if ($plusminus == "+") {
                $request['old_quantity'] = $request['quantity'];
                $request['quantity'] = $product['product_quantity'] + $request['quantity'];
                $request['status'] = true;
            } else {
                $request['old_quantity'] = $request['quantity'];
                $request['quantity'] = $product['product_quantity'] - $request['quantity'];
                $request['status'] = false;
            }

            if ($request['quantity'] <= 0) {
                DB::rollback();
                throw new Exception('product quantity cannot lower than 1');
            }

            $request['code'] = $product['product_code'];
            $request['name'] = $product['product_name'];
            $product = $this->productRepository->updateProduct($request, $id);

            $count = $this->transactionRepository->countTransaction();
            $count = $count + 1;

            $request['id'] = Str::random(32); // id transaction
            $request['status_id'] = 'TP' . sprintf('%03d', $count);
            $request['quantity'] = $request['old_quantity'];
            $request['created_at'] = now();
            $request['updated_at'] = now();

            $transaction = $this->transactionRepository->createTransaction($request);
            if (!$transaction) {
                DB::rollback();
                return null;
            }

            DB::commit();
            return $transaction;
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Error update transaction: ' . $e->getMessage());
        }
    }

    private function deleteProduct(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            $product = $this->productRepository->LockProductById($id);
            if (!$product) {
                DB::rollback();
                return false;
            }

            if ($request['quantity'] != $product['product_quantity']) {
                DB::rollback();
                throw new Exception('product will be delete, quantity should be same');
            }

            $count = $this->transactionRepository->countTransaction();
            $count = $count + 1;

            $request['id'] = Str::random(32); // id transaction
            $request['status'] = false; // in = 1, out = 0
            $request['status_id'] = 'TP' . sprintf('%03d', $count);
            $request['code'] = $product['product_code'];
            $request['created_at'] = now();
            $request['updated_at'] = now();

            $transaction = $this->transactionRepository->createTransaction($request);
            if (!$transaction) {
                DB::rollback();
                return null;
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
            throw new Exception('Error delete transaction: ' . $e->getMessage());
        }
    }
}
