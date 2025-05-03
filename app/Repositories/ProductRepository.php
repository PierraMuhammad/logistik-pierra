<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository
{
    public function getAllProducts()
    {
        return Product::get();
    }

    public function findProductById(string $id)
    {
        return Product::where('product_id', $id)->firstOrFail();
    }

    public function LockProductById(string $id)
    {
        return Product::where('product_id', $id)->lockForUpdate()->first();
    }

    public function createProduct(Request $request, string $id)
    {
        return Product::create([
            'product_id' => $id,
            'product_code' => $request['code'],
            'product_name' => $request['name'],
            'product_quantity' => $request['quantity'],
        ]);
    }

    public function updateProduct(Request $request, string $id)
    {
        return Product::where('product_id', $id)->update([
            'product_code' => $request['code'],
            'product_name' => $request['name'],
            'product_quantity' => $request['quantity']
        ]);
    }

    public function deleteProduct(string $id)
    {
        return Product::where('product_id', $id)->delete();
    }
}
