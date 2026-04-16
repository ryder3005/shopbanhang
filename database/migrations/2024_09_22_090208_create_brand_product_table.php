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
        Schema::create('tbl_brand_product', function (Blueprint $table) {
            $table->id('brand_id'); // Khóa chính tự động tăng
            $table->string('brand_name'); // Tên thương hiệu
            $table->text('brand_desc'); // Mô tả thương hiệu, có thể để trống
            $table->integer('brand_status')->default(true); // Trạng thái thương hiệu, mặc định là true (hoạt động)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_brand_product');
    }
};
