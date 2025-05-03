<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaction_products', function (Blueprint $table) {
            $table->string('tp_product_code');
            $table->foreign('tp_product_code')->references('product_code')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_products', function (Blueprint $table) {
            $table->dropForeign(['tp_product_code']);
            $table->dropColumn(['tp_product_code']);
        });
    }
};
