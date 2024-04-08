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
        Schema::create('order_details', function (Blueprint $table) {
            $table->foreignId("OrderNumber")->constrained("orders", "OrderNumber");
            $table->foreignId("ProductNumber")->constrained("products", "ProductNumber");
            $table->decimal("QuotedPrice", 15, 2);
            $table->smallInteger("QuotedOrders");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
