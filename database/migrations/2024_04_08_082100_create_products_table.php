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
        Schema::create('products', function (Blueprint $table) {
            $table->id("ProductNumber");
            $table->string("ProductName", 60);
            $table->text("ProductDescription");
            $table->integer("RetailPrice");
            $table->smallInteger("QuantityOnHand");
            $table->foreignId("CategoryId")->constrained("categories", "CategoryId");
            $table->string("image", 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
