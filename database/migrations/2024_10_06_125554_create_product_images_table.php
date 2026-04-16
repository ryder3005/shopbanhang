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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id('image_id'); // Khóa chính của bảng
            $table->foreignId('product_id') // Khóa ngoại liên kết với bảng products
                  ->constrained('products', 'product_id')
                  ->onDelete('cascade'); // Khi xóa sản phẩm, xóa luôn các ảnh liên quan
            
            $table->enum('type_image',['cover','normal'])->default('normal'); // Đường dẫn đến ảnh sản phẩm
            $table->string('image_url'); // Đường dẫn đến ảnh sản phẩm
            $table->boolean('is_active')->default(true); // Thuộc tính để ẩn/hiện ảnh

        }); 

    }

    /**         
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
