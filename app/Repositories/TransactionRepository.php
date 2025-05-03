<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionRepository
{
    public function getAllTransaction()
    {
        return Transaction::get();
    }

    public function getTransactionIn()
    {
        return Transaction::where('tp_status', 1)->get();
    }

    public function getTransactionOut()
    {
        return Transaction::where('tp_status', 0)->get();
    }

    public function countTransaction()
    {
        return Transaction::select('tp_id')->count();
    }

    public function findTransactionById(string $id)
    {
        return Transaction::where('tp_id', $id)->firstOrFail();
    }

    public function LockTransactionById(string $id)
    {
        return Transaction::where('tp_id', $id)->lockForUpdate()->first();
    }

    public function createTransaction(Request $request)
    {
        return Transaction::create([
            'tp_id' => $request['id'],
            'tp_status' => $request['status'],
            'tp_status_id' => $request['status_id'],
            'tp_quantity' => $request['quantity'],
            'tp_product_code' => $request['code'],
            'tp_storage_location' => $request['origin'],
            'created_at' => $request['created_at'],
            'updated_at' => $request['updated_at'],
        ]);
    }

    public function deleteTransaction(string $id)
    {
        return Transaction::where('tp_id', $id)->delete();
    }
}
