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
        Schema::create('tbl_category_product', function (Blueprint $table) {
            $table->id('category_id'); // Khóa chính tự động tăng
            $table->string('category_name'); // Tên danh mục
            $table->text('category_desc'); // Mô tả danh mục, có thể để trống
            $table->integer('category_status')->default(true); // Trạng thái danh mục, mặc định là true (hoạt động)
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_category_product');
    }
};
