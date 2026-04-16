<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('OrderID'); // ID của đơn hàng
            $table->foreignId('UserID')
                  ->constrained('users', 'UserID')
                  ->onDelete('cascade'); // Khóa ngoại liên kết với bảng Users
        
            $table->decimal('TotalPrice', 10, 2)->notNull(); // Tổng giá trị ban đầu
            $table->foreignId('DiscountID')
                  ->nullable()
                  ->constrained('discounts', 'DiscountID')
                  ->onDelete('set null'); // Khóa ngoại liên kết với bảng discounts
        
            $table->decimal('DiscountAmount', 10, 2)->default(0); // Số tiền giảm giá (mặc định 0)
            $table->decimal('FinalPrice', 10, 2)->notNull(); // Tổng giá trị sau khi áp dụng mã giảm giá
        
            $table->enum('Status', ['pending', 'shipped', 'delivered', 'cancelled'])->default('pending'); // Trạng thái đơn hàng
            $table->timestamp('OrderDate')->default(DB::raw('CURRENT_TIMESTAMP')); // Thời gian tạo đơn hàng
        
            // Thông tin địa chỉ giao hàng
            $table->string('Province')->nullable(); // Tỉnh/Thành phố
            $table->string('District')->nullable(); // Quận/Huyện
            $table->string('Ward')->nullable(); // Xã/Phường
            $table->string('Street')->nullable(); // Đường
            $table->decimal('ShippingFee', 10, 2)->default(0); // Phí vận chuyển
        
        
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
