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
        Schema::create('users', function (Blueprint $table) { 
            $table->id('UserID');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('FullName');
            
            $table->text('Address');
            $table->string('Ward');  // Phường/xã
            $table->string('District')->nullable(); // Quận/huyện
            $table->string('City'); // Thành phố
        
            $table->string('PhoneNumber');
            $table->enum('Role', ['customer', 'admin'])->default('customer'); // Vai trò người dùng
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
