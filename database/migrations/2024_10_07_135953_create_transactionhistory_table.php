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
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->id('TransactionID'); // ID của giao dịch
            $table->foreignId('OrderID')
                  ->constrained('orders', 'OrderID')
                  ->onDelete('cascade'); // Liên kết với đơn hàng
        
            $table->foreignId('UserID')
                  ->constrained('users', 'UserID')
                  ->onDelete('cascade'); // Người thực hiện giao dịch
            
            $table->decimal('Amount', 10, 2); // Số tiền giao dịch
            $table->enum('TransactionType', ['payment', 'refund'])->default('payment'); // Loại giao dịch
            $table->enum('Status', ['success', 'pending', 'failed'])->default('pending'); // Trạng thái giao dịch
            
            $table->string('PaymentMethod')->nullable(); // Phương thức thanh toán (MoMo, Stripe,...)
            $table->timestamp('TransactionDate')->default(DB::raw('CURRENT_TIMESTAMP')); // Ngày thực hiện giao dịch
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionhistory');
    }
};
