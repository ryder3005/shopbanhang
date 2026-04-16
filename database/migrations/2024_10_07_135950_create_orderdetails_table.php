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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id('OrderDetailID');
            $table->foreignId('OrderID')->constrained('orders','OrderID');
            $table->foreignId('product_id')->constrained('products','product_id');
            $table->foreignId('ProductDetailID')->constrained('product_details','ProductDetailID');
            $table->integer('Quantity');
            $table->decimal('Price', 10, 2);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};
