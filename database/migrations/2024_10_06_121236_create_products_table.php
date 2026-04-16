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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');                          // Khóa chính của bảng
            $table->string('product_name')->notNullable();      // Tên sản phẩm
            $table->text('product_description')->nullable();     // Mô tả sản phẩm
            $table->foreignId('brands_id')->nullable()          // Khóa ngoại liên kết với bảng Brand
                ->constrained('tbl_brand_product', 'brand_id')
                ->onDelete('set null');                      // Khi xóa thương hiệu, sẽ set null brand_id
            $table->foreignId('category_id')->nullable()       // Khóa ngoại liên kết với bảng Categories
                ->constrained('tbl_category_product', 'category_id')
                ->onDelete('set null');                      // Khi xóa danh mục, sẽ set null category_id
            $table->boolean('is_active')->default(true);        // Thuộc tính để ẩn/hiện sản phẩm
            $table->integer('in_stock');
            // $table->string('cover');
            
            // Cấu hình và bộ nhớ
            $table->string('OperatingSystem', 50)->nullable(); // Hệ điều hành
            $table->string('CPU', 100)->nullable(); // Chip xử lý (CPU)
            $table->string('CPU_Speed', 100)->nullable(); // Tốc độ CPU
            $table->string('GPU', 50)->nullable(); // Chip đồ họa (GPU)

            // Camera & Màn hình
            $table->string('RearCameraResolution', 100)->nullable(); // Độ phân giải camera sau
            $table->text('RearCameraFeatures')->nullable(); // Tính năng camera sau
            $table->string('FrontCameraResolution', 100)->nullable(); // Độ phân giải camera trước
            $table->text('FrontCameraFeatures')->nullable(); // Tính năng camera trước
            $table->string('DisplayTechnology', 50)->nullable(); // Công nghệ màn hình
            $table->string('DisplayResolution', 50)->nullable(); // Độ phân giải màn hình
            $table->string('DisplaySize', 50)->nullable(); // Màn hình rộng
            $table->string('RefreshRate', 50)->nullable(); // Tần số quét
            $table->string('MaxBrightness', 50)->nullable(); // Độ sáng tối đa
            $table->string('DisplayGlass', 50)->nullable(); // Mặt kính cảm ứng

            // Pin & Sạc
            $table->string('BatteryCapacity', 50)->nullable(); // Dung lượng pin
            $table->string('BatteryType', 50)->nullable(); // Loại pin
            $table->string('MaxChargingSupport', 50)->nullable(); // Hỗ trợ sạc tối đa
            $table->string('ChargerIncluded', 50)->nullable(); // Sạc kèm theo máy
            $table->text('BatteryTechnology')->nullable(); // Công nghệ pin

            // Tiện ích
            $table->text('AdvancedSecurity')->nullable(); // Bảo mật nâng cao
            $table->text('SpecialFeatures')->nullable(); // Tính năng đặc biệt
            $table->string('WaterDustResistance', 50)->nullable(); // Kháng nước, bụi
            $table->text('Recording')->nullable(); // Ghi âm
            $table->boolean('Radio')->nullable(); // Radio

            // Kết nối
            $table->string('MobileNetwork', 50)->nullable(); // Mạng di động
            $table->string('SIMSupport', 50)->nullable(); // Hỗ trợ SIM
            $table->string('WifiSupport', 50)->nullable(); // Wifi
            $table->string('GPS', 100)->nullable(); // GPS
            $table->string('Bluetooth', 50)->nullable(); // Bluetooth
            $table->string('ChargingPort', 50)->nullable(); // Cổng sạc
            $table->string('HeadphoneJack', 50)->nullable(); // Jack tai nghe
            $table->text('OtherConnections')->nullable(); // Kết nối khác

            // Thiết kế
            $table->string('DesignType', 50)->nullable(); // Thiết kế
            $table->string('Material', 100)->nullable(); // Chất liệu
            $table->string('Dimensions', 100)->nullable(); // Kích thước
            $table->string('Weight', 50)->nullable(); // Khối lượng
            $table->date('ReleaseDate')->nullable(); // Thời điểm ra mắt
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
