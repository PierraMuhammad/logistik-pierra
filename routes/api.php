<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'get']);
Route::post('/products', [ProductController::class, 'create']);
Route::get('/products/{id}', [ProductController::class, 'findById']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);

Route::post('/transactions', [TransactionController::class, 'get']);
Route::post('/transactions/tableIn', [TransactionController::class, 'getTransactionIn']);
Route::post('/transactions/tableOut', [TransactionController::class, 'getTransactionOut']);
Route::post('/transactions/formIn', [TransactionController::class, 'checkInProduct']);
Route::post('/transactions/formOut', [TransactionController::class, 'checkOutProduct']);
