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
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->id('admin_id'); // Cột ID chính cho quản trị viên
            $table->string('admin_name'); // Tên quản trị viên
            $table->string('admin_email')->unique(); // Email quản trị viên
            $table->string('admin_password'); // Mật khẩu quản trị viên
            $table->string('admin_phone'); // Số điện thoại quản trị viên
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_admin');
    }
};
