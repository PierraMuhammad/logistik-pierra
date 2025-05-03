<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function tableTransaction()
    {
        return view('content.transaction.table');
    }

    public function tableInTransaction()
    {
        return view('content.transaction.tableIn');
    }

    public function tableOutTransaction()
    {
        return view('content.transaction.tableOut');
    }

    public function formInTransaction()
    {
        return view('content.transaction.formCheckIn');
    }

    public function formOutTransaction()
    {
        return view('content.transaction.formCheckOut');
    }

    public function get()
    {
        try {
            $transactions = $this->transactionService->getAllTransaction();

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $transactions
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getTransactionIn()
    {
        try {
            $transactions = $this->transactionService->getTransactionIn();

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $transactions
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getTransactionOut()
    {
        try {
            $transactions = $this->transactionService->getTransactionOut();

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $transactions
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function checkInProduct(Request $request)
    {
        try {
            $transaction = $this->transactionService->checkInProduct($request);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $transaction,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function checkOutProduct(Request $request)
    {
        try {
            $transaction = $this->transactionService->checkOutProduct($request);

            return response()->json([
                'code' => 200,
                'message' => 'Ok',
                'data' => $transaction,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
