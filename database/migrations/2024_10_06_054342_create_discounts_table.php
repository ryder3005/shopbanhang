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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id('DiscountID'); // Khóa chính tự động tăng, đặt tên là DiscountID
            $table->string('code')->unique(); // Mã giảm giá duy nhất
            $table->decimal('amount', 10, 2); // Số tiền giảm giá
            $table->enum('type', ['fixed', 'percent']); // Loại giảm giá: cố định hoặc phần trăm
            $table->dateTime('start_date')->nullable(); // Ngày bắt đầu áp dụng giảm giá
            $table->dateTime('end_date')->nullable(); // Ngày kết thúc áp dụng giảm giá
            $table->integer('usage_limit')->nullable(); // Số lần sử dụng tối đa của mã giảm giá
            $table->integer('used')->default(0); // Số lần đã sử dụng mã giảm giá
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động của mã giảm giá
        
            // $table->timestamps(); // Thêm các cột created_at và updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
