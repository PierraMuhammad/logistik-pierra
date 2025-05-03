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
            $table->string('tp_storage_location');
            $table->foreign('tp_storage_location')->references('storage_location')->on('storages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_products', function (Blueprint $table) {
            $table->dropForeign(['tp_storage_location']);
            $table->dropColumn(['tp_storage_location']);
        });
    }
};
