@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="card">
            <form method="POST" enctype="multipart/form-data" id="productForm" action="{{ route('products.store') }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <h5 class="card-header">Thêm Sản Phẩm</h5>
                <div class="card-body">
                    <form role="form" action="{{ url('/save-product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="card col-lg-6">
                                <div>
                                    <label for="product_name" class="form-label">Tên Sản Phẩm</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control"
                                        required>
                                </div>

                                <div>
                                    <label for="product_description" class="form-label">Mô Tả Sản Phẩm</label>
                                    <textarea name="product_description" id="product_description" class="form-control"></textarea>
                                </div>

                                <div>
                                    <label for="brands_id" class="form-label">Thương Hiệu</label>
                                    <select name="brands_id" id="brands_id" class="form-control">
                                        <option value="">Chọn Thương Hiệu</option>
                                        @foreach ($all_brand_product as $key => $brand)
                                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="category_id" class="form-label">Danh Mục</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Chọn Danh Mục</option>
                                        @foreach ($all_category_product as $key => $category)
                                            <option value="{{ $category->category_id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Cấu hình và bộ nhớ -->
                                <div>
                                    <label for="operating_system" class="form-label">Hệ điều hành:</label>
                                    <input type="text" id="operating_system" name="OperatingSystem" class="form-control"
                                        maxlength="50" placeholder="Nhập hệ điều hành" />
                                </div>
                                <div>
                                    <label for="in_stock" class="form-label">Số lượng</label>
                                    <input type="number" id="in_stock" name="in_stock" class="form-control" maxlength="50"
                                        placeholder="Nhập hệ số lượng" />
                                </div>
                                <div>
                                    <label for="cpu" class="form-label">Chip xử lý (CPU):</label>
                                    <input type="text" id="cpu" name="CPU" class="form-control" maxlength="100"
                                        placeholder="Nhập chip xử lý" />
                                </div>
                                <div>
                                    <label for="cpu_speed" class="form-label">Tốc độ CPU:</label>
                                    <input type="text" id="cpu_speed" name="CPU_Speed" class="form-control"
                                        maxlength="100" placeholder="Nhập tốc độ CPU" />
                                </div>
                                <div>
                                    <label for="gpu" class="form-label">Chip đồ họa (GPU):</label>
                                    <input type="text" id="gpu" name="GPU" class="form-control" maxlength="50"
                                        placeholder="Nhập chip đồ họa" />
                                </div>

                                <!-- Camera & Màn hình -->
                                <div>
                                    <label for="rear_camera_resolution" class="form-label">Độ phân giải camera
                                        sau:</label>
                                    <input type="text" id="rear_camera_resolution" name="RearCameraResolution"
                                        class="form-control" maxlength="100" placeholder="Nhập độ phân giải camera sau" />
                                </div>

                                <div>
                                    <label for="rear_camera_features" class="form-label">Tính năng camera
                                        sau:</label>
                                    <textarea id="rear_camera_features" name="RearCameraFeatures" class="form-control"
                                        placeholder="Nhập tính năng camera sau"></textarea>
                                </div>

                                <div>
                                    <label for="front_camera_resolution" class="form-label">Độ phân giải camera
                                        trước:</label>
                                    <input type="text" id="front_camera_resolution" name="FrontCameraResolution"
                                        class="form-control" maxlength="100"
                                        placeholder="Nhập độ phân giải camera trước" />
                                </div>

                                <div>
                                    <label for="front_camera_features" class="form-label">Tính năng camera
                                        trước:</label>
                                    <textarea id="front_camera_features" name="FrontCameraFeatures" class="form-control"
                                        placeholder="Nhập tính năng camera trước"></textarea>
                                </div>

                                <div>
                                    <label for="display_technology" class="form-label">Công nghệ màn hình:</label>
                                    <input type="text" id="display_technology" name="DisplayTechnology"
                                        class="form-control" maxlength="50" placeholder="Nhập công nghệ màn hình" />
                                </div>

                                <div>
                                    <label for="display_resolution" class="form-label">Độ phân giải màn
                                        hình:</label>
                                    <input type="text" id="display_resolution" name="DisplayResolution"
                                        class="form-control" maxlength="50" placeholder="Nhập độ phân giải màn hình" />
                                </div>

                                <div>
                                    <label for="display_size" class="form-label">Màn hình rộng:</label>
                                    <input type="text" id="display_size" name="DisplaySize" class="form-control"
                                        maxlength="50" placeholder="Nhập kích thước màn hình" />
                                </div>

                                <div>
                                    <label for="refresh_rate" class="form-label">Tần số quét:</label>
                                    <input type="text" id="refresh_rate" name="RefreshRate" class="form-control"
                                        maxlength="50" placeholder="Nhập tần số quét" />
                                </div>

                                <div>
                                    <label for="max_brightness" class="form-label">Độ sáng tối đa:</label>
                                    <input type="text" id="max_brightness" name="MaxBrightness" class="form-control"
                                        maxlength="50" placeholder="Nhập độ sáng tối đa" />
                                </div>

                                <div>
                                    <label for="display_glass" class="form-label">Mặt kính cảm ứng:</label>
                                    <input type="text" id="display_glass" name="DisplayGlass" class="form-control"
                                        maxlength="50" placeholder="Nhập loại kính cảm ứng" />
                                </div>

                                <!-- Pin & Sạc -->
                                <div>
                                    <label for="battery_capacity" class="form-label">Dung lượng pin:</label>
                                    <input type="text" id="battery_capacity" name="BatteryCapacity"
                                        class="form-control" maxlength="50" placeholder="Nhập dung lượng pin" />
                                </div>

                                <div>
                                    <label for="battery_type" class="form-label">Loại pin:</label>
                                    <input type="text" id="battery_type" name="BatteryType" class="form-control"
                                        maxlength="50" placeholder="Nhập loại pin" />
                                </div>

                                <div>
                                    <label for="max_charging_support" class="form-label">Hỗ trợ sạc tối
                                        đa:</label>
                                    <input type="text" id="max_charging_support" name="MaxChargingSupport"
                                        class="form-control" maxlength="50" placeholder="Nhập hỗ trợ sạc tối đa" />
                                </div>

                                <div>
                                    <label for="charger_included" class="form-label">Sạc kèm theo máy:</label>
                                    <input type="text" id="charger_included" name="ChargerIncluded"
                                        class="form-control" maxlength="50" placeholder="Nhập thông tin sạc kèm theo" />
                                </div>

                                <div>
                                    <label for="battery_technology" class="form-label">Công nghệ pin:</label>
                                    <textarea id="battery_technology" name="BatteryTechnology" class="form-control" placeholder="Nhập công nghệ pin"></textarea>
                                </div>

                                <!-- Tiện ích -->
                                <div>
                                    <label for="advanced_security" class="form-label">Bảo mật nâng cao:</label>
                                    <textarea id="advanced_security" name="AdvancedSecurity" class="form-control"
                                        placeholder="Nhập thông tin bảo mật nâng cao"></textarea>
                                </div>

                                <div>
                                    <label for="special_features" class="form-label">Tính năng đặc biệt:</label>
                                    <textarea id="special_features" name="SpecialFeatures" class="form-control" placeholder="Nhập tính năng đặc biệt"></textarea>
                                </div>

                                <div>
                                    <label for="water_dust_resistance" class="form-label">Kháng nước, bụi:</label>
                                    <input type="text" id="water_dust_resistance" name="WaterDustResistance"
                                        class="form-control" maxlength="50" placeholder="Nhập kháng nước, bụi" />
                                </div>

                                <div>
                                    <label for="recording" class="form-label">Ghi âm:</label>
                                    <textarea id="recording" name="Recording" class="form-control" placeholder="Nhập thông tin ghi âm"></textarea>
                                </div>

                                <div>
                                    <label for="radio" class="form-label">Radio:</label>
                                    <input type="checkbox" id="radio" name="Radio" class="form-check-input" />
                                </div>

                                <!-- Kết nối -->
                                <div>
                                    <label for="mobile_network" class="form-label">Mạng di động:</label>
                                    <input type="text" id="mobile_network" name="MobileNetwork" class="form-control"
                                        maxlength="50" placeholder="Nhập mạng di động" />
                                </div>

                                <div>
                                    <label for="sim_support" class="form-label">Hỗ trợ SIM:</label>
                                    <input type="text" id="sim_support" name="SIMSupport" class="form-control"
                                        maxlength="50" placeholder="Nhập hỗ trợ SIM" />
                                </div>

                                <div>
                                    <label for="wifi_support" class="form-label">Wifi:</label>
                                    <input type="text" id="wifi_support" name="WifiSupport" class="form-control"
                                        maxlength="50" placeholder="Nhập thông tin Wifi" />
                                </div>

                                <div>
                                    <label for="gps" class="form-label">GPS:</label>
                                    <input type="text" id="gps" name="GPS" class="form-control"
                                        maxlength="100" placeholder="Nhập thông tin GPS" />
                                </div>

                                <div>
                                    <label for="bluetooth" class="form-label">Bluetooth:</label>
                                    <input type="text" id="bluetooth" name="Bluetooth" class="form-control"
                                        maxlength="50" placeholder="Nhập thông tin Bluetooth" />
                                </div>

                                <div>
                                    <label for="charging_port" class="form-label">Cổng sạc:</label>
                                    <input type="text" id="charging_port" name="ChargingPort" class="form-control"
                                        maxlength="50" placeholder="Nhập thông tin cổng sạc" />
                                </div>

                                <div>
                                    <label for="headphone_jack" class="form-label">Jack tai nghe:</label>
                                    <input type="text" id="headphone_jack" name="HeadphoneJack" class="form-control"
                                        maxlength="50" placeholder="Nhập thông tin jack tai nghe" />
                                </div>

                                <div>
                                    <label for="other_connections" class="form-label">Kết nối khác:</label>
                                    <textarea id="other_connections" name="OtherConnections" class="form-control"
                                        placeholder="Nhập thông tin kết nối khác"></textarea>
                                </div>

                                <!-- Thiết kế -->
                                <div>
                                    <label for="design_type" class="form-label">Thiết kế:</label>
                                    <input type="text" id="design_type" name="DesignType" class="form-control"
                                        maxlength="50" placeholder="Nhập thông tin thiết kế" />
                                </div>

                                <div>
                                    <label for="material" class="form-label">Chất liệu:</label>
                                    <input type="text" id="material" name="Material" class="form-control"
                                        maxlength="100" placeholder="Nhập chất liệu" />
                                </div>

                                <div>
                                    <label for="dimensions" class="form-label">Kích thước:</label>
                                    <input type="text" id="dimensions" name="Dimensions" class="form-control"
                                        maxlength="100" placeholder="Nhập kích thước" />
                                </div>

                                <div>
                                    <label for="weight" class="form-label">Khối lượng:</label>
                                    <input type="text" id="weight" name="Weight" class="form-control"
                                        maxlength="50" placeholder="Nhập khối lượng" />
                                </div>

                                <div>
                                    <label for="release_date" class="form-label">Thời điểm ra mắt:</label>
                                    <input type="date" id="release_date" name="ReleaseDate" class="form-control" />
                                </div>
                                <div>
                                    <label for="cover_image" class="form-label">Ảnh Bìa</label>
                                    <input type="file" id="cover_image" name="cover_image" class="form-control"
                                        accept="image/*">
                                </div>

                                <div>
                                    <label for="images" class="form-label">Hình Ảnh</label>
                                    <input type="file" name="images[]" multiple class="form-control">
                                </div>


                            </div>

                            <div class="col-lg-6">

                                <div class="card mb-6">
                                    <h5 class="card-header">Cấu Hình Sản Phẩm</h5>
                                    <div class="card-body">
                                        <div class="card m-6 " id="product-details">
                                        </div>
                                    </div>
                                    <div class="card mb-6">
                                        {{-- <h5 class="card-header">Checkboxes and Radios</h5> --}}
                                        <!-- Checkboxes and Radios -->
                                        <div class="card-body  " >
                                            <div class="row gy-6" id="config">
                                                <div class="col-md">
                                                    <small class="text-light fw-medium">Màu sắc</small>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input  color" type="checkbox"
                                                            value="Đen" name="color[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Đen
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input color" type="checkbox"
                                                            value="Trắng" name="color[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Trắng
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input color" type="checkbox"
                                                            value="Xám" name="color[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Xám
                                                        </label>
                                                    </div>


                                                </div>
                                                <div class="col-md">
                                                    <small class="text-light fw-medium">Ram</small>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input ram" type="checkbox"
                                                            value="4" name="ram[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            4GB
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input ram" type="checkbox"
                                                            value="8" name="ram[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            8GB
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input ram" type="checkbox"
                                                            value="16" name="ram[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            16GB
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="col-md">
                                                    <small class="text-light fw-medium">Bộ nhớ</small>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input storage" type="checkbox"
                                                            value="64" name="storage[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            64GB
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input storage" type="checkbox"
                                                            value="128" name="storage[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            128GB
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input storage" type="checkbox"
                                                            value="256" name="storage[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            256GB
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input storage" type="checkbox"
                                                            value="512" name="storage[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            512GB
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input storage" type="checkbox"
                                                            value="1024" name="storage[]" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            1024GB
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                            <button type="button" id="add-detail" class="btn btn-secondary">Thêm Cấu
                                                Hình
                                                Khác</button>
                                            <button type="button" id="add-mul" class="btn btn-secondary">Thêm Cấu Hình
                                                hàng loạt</button>
                                            <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                                        </div>
                                        {{-- <hr class="m-0"> --}}
                                        <!-- Inline Checkboxes -->

                                    </div>
                                    <div>

                                    </div>



                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </form>
        </div>



        <script>
            let detailIndex = 0;
            document.getElementById('add-mul').addEventListener('click', function() {
                const colors = Array.from(document.querySelectorAll('.color:checked')).map(checkbox => checkbox.value);
                const rams = Array.from(document.querySelectorAll('.ram:checked')).map(checkbox => checkbox.value);
                const storages = Array.from(document.querySelectorAll('.storage:checked')).map(checkbox => checkbox
                    .value);
                    document.getElementById("config").remove();
                if (colors.length === 0 || rams.length === 0 || storages.length === 0) {
                    alert("Vui lòng chọn ít nhất một giá trị cho mỗi thuộc tính!");
                    return;
                }
                colors.forEach(c => {
                    rams.forEach(r => {
                        storages.forEach(s => {
                            const newDetail = document.createElement('div');
                            newDetail.classList.add('product-detail');
                            newDetail.innerHTML = `
                <h4>Thêm cấu hình thứ ${detailIndex + 1}</h4>
                                        <div class="mb-4">
                                        <label for="color" class="form-label">Màu sắc</label>
                                        <select id="color" name="product_details[${detailIndex}][Color]" class="form-select">
                                            <option value="${c}"  selected>${c}</option>
                                            <option value="Đen">Đen</option>
                                            <option value="Trắng">Trắng</option>
                                            <option value="Xám">Xám</option>
                                        </select>
                                    </div>

                                        <div>
                                            <label for="ram" class="form-label">RAM:</label>
                                            <input type="number" id="ram" name="product_details[${detailIndex}][RAM]" class="form-control"
                                                maxlength="50" placeholder="Nhập dung lượng RAM" value=${r} />
                                        </div>

                                        <div>
                                            <label for="storage_capacity" class="form-label">Dung lượng lưu trữ:</label>
                                            <input type="number" id="storage_capacity" name="product_details[${detailIndex}][StorageCapacity]"
                                                class="form-control" maxlength="50" value=${s}
                                                placeholder="Nhập dung lượng lưu trữ" />
                                        </div>
                                                                                <div>
                                            <label for="price" class="form-label">Giá:</label>
                                            <input type="number" id="price" name="product_details[${detailIndex}][Price]" class="form-control"
                                                step="1000" value=1000 placeholder="Nhập giá" />
                                        </div>`;
                            
                            // Thêm phần tử mới vào danh sách cấu hình sản phẩm
                            document.getElementById('product-details').appendChild(newDetail);
                            
                            // Tăng chỉ số của cấu hình
                            detailIndex++;
                        });
                    });
                });
                const newDetail = document.createElement('div');
            });
            document.getElementById('add-detail').addEventListener('click', function() {
                const newDetail = document.createElement('div');
                newDetail.classList.add('product-detail');

                // Thêm thông báo hiển thị số thứ tự của cấu hình
                newDetail.innerHTML = `
                <h4>Thêm cấu hình thứ ${detailIndex + 1}</h4>
                                        <div class="mb-4">
    <label for="color">Chọn hoặc nhập màu sắc:</label>
<input id="color" name="product_details[${detailIndex}][Color]" list="color-options" class="form-control">
<datalist id="color-options">
    <option value="Đen">
    <option value="Trắng">
    <option value="Xám">
</datalist>

</div>

                                        <div>
                                            <label for="ram" class="form-label">RAM:</label>
                                            <input type="number" id="ram" name="product_details[${detailIndex}][RAM]" class="form-control"
                                                maxlength="50" placeholder="Nhập dung lượng RAM" />
                                        </div>

                                        <div>
                                            <label for="storage_capacity" class="form-label">Dung lượng lưu trữ:</label>
                                            <input type="number" id="storage_capacity" name="product_details[${detailIndex}][StorageCapacity]"
                                                class="form-control" maxlength="50"
                                                placeholder="Nhập dung lượng lưu trữ" />
                                        </div>
                                                                                <div>
                                            <label for="price" class="form-label">Giá:</label>
                                            <input type="number" id="price" name="product_details[${detailIndex}][Price]" class="form-control"
                                                step="0.01" placeholder="Nhập giá" />
                                        </div>
                                    
                    
                    
                `;

                // Thêm phần tử mới vào danh sách cấu hình sản phẩm
                document.getElementById('product-details').appendChild(newDetail);

                // Tăng chỉ số của cấu hình
                detailIndex++;
            });
        </script>

    </div>
@endsection
