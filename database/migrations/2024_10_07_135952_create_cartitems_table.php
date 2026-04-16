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
        Schema::create('cartitems', function (Blueprint $table) {
            $table->id('CartItemID');
            $table->foreignId('UserID')->constrained('users','UserID')->onDelete('cascade'); // Khóa ngoại liên kết với bảng users
            $table->foreignId('product_id')->constrained('products','product_id');
            $table->foreignId('ProductDetailID')->constrained('product_details','ProductDetailID');
            $table->integer('Quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartitems');
    }
};
