<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction_products';

    protected $fillable = [
        'tp_id',
        'tp_status',
        'tp_status_id',
        'tp_product_code',
        'tp_storage_location',
        'tp_quantity',
        'created_at',
        'updated_at',
    ];
}
