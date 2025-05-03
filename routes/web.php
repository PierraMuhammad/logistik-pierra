<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('master');
});

Route::get('/product', [ProductController::class, 'tableProduct']);

// Route::get('/transaction', [TransactionController::class, 'tableTransaction']);
Route::get('/transaction/formIn', [TransactionController::class, 'formInTransaction']);
Route::get('/transaction/formOut', [TransactionController::class, 'formOutTransaction']);
Route::get('/transaction/tableIn', [TransactionController::class, 'tableInTransaction']);
Route::get('/transaction/tableOut', [TransactionController::class, 'tableOutTransaction']);
