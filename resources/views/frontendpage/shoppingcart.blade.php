@extends('front_layout')
@section('front_content')
    <style>
        .form-select {
            height: 45px;
            /* Chiều cao hợp lý */
            width: 100%;
            display: flex;
            /* Hiển thị linh hoạt */
            align-items: center;
            /* Canh giữa theo chiều dọc */
            padding: 0 12px;
            /* Thêm khoảng cách giữa nội dung và viền */
            font-size: 14px;
            /* Kích thước chữ dễ đọc */
            color: #333;
            /* Màu chữ nổi bật */
            border: 1px solid #ccc;
            /* Viền nhẹ để phân biệt */
            background-color: #fff;
            /* Màu nền trắng sạch */
            border-radius: 4px;
            /* Bo góc nhẹ */
            outline: none;
            /* Loại bỏ khung mặc định khi focus */
            box-shadow: none;
            /* Không có đổ bóng mặc định */
            transition: all 0.3s ease;
            /* Hiệu ứng mượt khi hover hoặc focus */
        }

        /* Khi hover */
        .form-select:hover {
            border-color: #007bff;
            /* Đổi màu viền khi rê chuột */
            background-color: #f8f9fa;
            /* Nền nhẹ khi hover */
        }

        /* Khi focus */
        .form-select:focus {
            border-color: #007bff;
            /* Viền đổi màu khi focus */
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
            /* Thêm hiệu ứng ánh sáng */
            background-color: #fff;
            /* Giữ màu nền khi focus */
        }

        /* Tùy chỉnh mũi tên thả xuống */
        .form-select::after {
            content: '';
            /* Giữ nguyên icon mũi tên */
            display: inline-block;
            position: absolute;
            right: 10px;
            top: 50%;
            width: 0;
            height: 0;
            margin-top: -3px;
            border-width: 6px 6px 0;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
            /* Mũi tên tam giác */
            pointer-events: none;
        }

        /* Tùy chỉnh khi disabled */
        .form-select:disabled {
            background-color: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }
    </style>
    <form class="bg0 p-t-75 p-b-85" id="cart-form" action="{{ route('cart.update') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Sản phẩm </th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Giá </th>
                                    <th class="column-4">Số lượng </th>
                                    <th class="column-5">Tổng cộng</th>
                                    <!-- <th class="column-6"></th> -->
                                    <!-- <th class="column-6">cau hinh</th> -->
                                </tr>
                                @foreach ($cart as $key => $value)
                                    {{-- <input type="hidden" name="cart_items[{{ $value->CartItemID }}][number]" value="{{ $value->CartItemID }}"> --}}
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <a href={{ route('cart.delete', $value->ProductDetailID) }}>
                                                <div class="how-itemcart1">


                                                    <img src="{{ asset("storage/app/public/$value->image") }}"
                                                        alt="IMG">

                                                </div>
                                            </a>
                                        </td>
                                        <td class="column-2">{{ $value->name }} {{ $value->detail->RAM }}GB
                                            {{ $value->detail->StorageCapacity }}GB</td>
                                        <td class="column-3">{{ number_format($value->detail->Price, 0, ',', '.') }}VND</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                    name="num_product[{{ $value->ProductDetailID }}]"
                                                    value={{ $value->Quantity }}>

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5">{{ number_format($value->total, 0, ',', '.') }} VND</td>
                                    </tr>
                                @endforeach



                            </table>
                        </div>


                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <!-- Chọn địa chỉ -->
                            <div class="m-b-20">
                                <label class="stext-104 cl2 size-116 p-b-10">Chọn địa chỉ giao
                                    hàng:</label>
                                <div class="m-t-10">
                                    <!-- Địa chỉ từ user -->

                                    <label>
                                        <input type="radio" name="address_option" id="default" value="default"
                                            @if (session('address_option') !== 'new') checked @endif>
                                        <span>Địa chỉ từ tài khoản:
                                            <strong>
                                                {{ implode(', ', array_map(fn($field) => Auth::user()->$field ?? 'Không có địa chỉ', ['Address', 'Ward', 'District', 'City'])) }}
                                            </strong>

                                    </label>
                                </div>

                                <div class="m-t-10">
                                    <!-- Nhập địa chỉ mới -->

                                    <label>
                                        <input type="radio" @if (session('address_option') === 'new') checked @endif
                                            name="address_option" id="new_address" value="new">
                                        <span>Nhập địa chỉ mới:</span>
                                    </label>

                                    <div class="flex-w flex-r-m p-b-10 mb-4 " id="cityShow">
                                        <div class="size-203 flex-c-m respon6">
                                            <label for="citySelect" class="form-label">Tỉnh/Thành phố</label>
                                        </div>

                                        <div class="size-204 respon6-next">
                                            <div class="rs1-select2 bor8 bg0">
                                                <select id="citySelect" class="form-select " name="city" required>
                                                    @if (session('address_option') === 'new')
                                                        <option value="{{ session()->get('Province', 'default') }}">
                                                            {{ session()->get('Province', 'default') }}</option>
                                                    @else
                                                        <option value="">-- Chọn Phường/Xã --</option>
                                                    @endif
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-w flex-r-m p-b-10 mb-4">
                                        <div class="size-203 flex-c-m respon6">
                                            <label for="districtSelect" class="form-label">Quận/Huyện</label>
                                        </div>

                                        <div class="size-204 respon6-next">
                                            <div class="rs1-select2 bor8 bg0">
                                                <select id="districtSelect" class="form-select " name="district" required>
                                                    @if (session('address_option') === 'new')
                                                        <option value="{{ session()->get('District', 'default') }}">
                                                            {{ session()->get('District', 'default') }}</option>
                                                    @else
                                                        <option value="">-- Chọn Phường/Xã --</option>
                                                    @endif
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-w flex-r-m p-b-10 mb-4">
                                        <div class="size-203 flex-c-m respon6">
                                            <label for="wardSelect" class="form-label">Phường/Xã</label>
                                        </div>

                                        <div class="size-204 respon6-next">
                                            <div class="rs1-select2 bor8 bg0">
                                                <select id="wardSelect" class="form-select " name="ward" required>
                                                    @if (session('address_option') === 'new')
                                                        <option value="{{ session()->get('Ward', 'default') }}">
                                                            {{ session()->get('Ward', 'default') }}</option>
                                                    @else
                                                        <option value="">-- Chọn Phường/Xã --</option>
                                                    @endif

                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="mb-3">
                                        <label for="Address" class="form-label">Đường</label>

                                        @if (session('address_option') === 'new')
                                            <input type="text" style="height: 50px;" style="font-size: 14px"
                                                class="form-control" id="Address" name="Address"
                                                value="{{ session()->get('Street', 'default') }}" required />
                                        @else
                                            <input type="text" style="height: 50px;" style="font-size: 14px"
                                                class="form-control" id="Address" name="Address" required />
                                        @endif
                                    </div>
                                    {{-- <input type="text" name="Address"
                                        class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5"
                                        placeholder="Nhập địa chỉ mới" style="display: none;" id="new_address_input"> --}}
                                </div>
                            </div>


                        </div>


                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                    name="code" placeholder="Coupon Code" value="{{ session('code', '') }}">
                                {{-- <div
                                    class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Apply coupon
                                </div> --}}
                            </div>

                            <button type="submit" onclick="submitForm('{{ route('cart.update') }}')"
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Cập nhật giỏ hàng
                            </button>

                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Tổng số giỏ hàng
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Tổng đơn hàng :
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    {{ number_format($totalprice, 0, ',', '.') }} VND
                                </span>
                            </div>
                        </div>

                        @if (session()->has('ShippingFee'))
                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        Phí ship:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        {{ number_format(session('ShippingFee'), 0, ',', '.') }} VND
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if (session()->has('discounted_total'))
                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        Mã giảm giá {{ session('amount') }}:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        - {{ number_format(session('discounted_total'), 0, ',', '.') }} VND
                                    </span>
                                </div>
                            </div>
                        @endif



                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Tổng tiền:
                                </span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2">
                                    {{ number_format($total, 0, ',', '.') }} VND

                                </span>
                            </div>
                        </div>

                        <button onclick="submitForm('{{ route('cart.checkout') }}')"
                            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Tiến hành thanh toán
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function submitForm(action) {
            const form = document.getElementById('cart-form');
            form.action = action;
            console.log(form.action)
            // form.submit();
        }
    </script>
    <script>
        // Đường dẫn tới file JSON
        const jsonPath = "{{ asset('/front_file/vietnamAddress.json') }}";

        // Lấy tham chiếu tới các dropdown
        const citySelect = document.getElementById("citySelect");
        const cityShow = document.getElementById("cityShow")
        const districtSelect = document.getElementById("districtSelect");
        console.log(districtSelect);

        const wardSelect = document.getElementById("wardSelect");

        // Hàm tạo danh sách option
        function populateSelect(selectElement, data, placeholder) {
            selectElement.innerHTML = `<option> ${placeholder} </option>`;
            data.forEach((item) => {
                const option = document.createElement("option");
                option.value = item.Name; // Chỉnh lại để value là Name thay vì Id
                option.textContent = item.Name;
                selectElement.appendChild(option);
            });
        }

        // Tải dữ liệu từ file JSON
        fetch(jsonPath)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);

                // Gán dữ liệu tỉnh/thành phố
                populateSelect(citySelect, data, "Chọn Tỉnh/Thành phố");

                // Khi chọn tỉnh/thành phố
                citySelect.addEventListener("change", (event) => {
                    console.log(event.target.value);

                    const selectedCity = data.find((city) => city.Name === event.target.value);
                    if (selectedCity) {
                        populateSelect(districtSelect, selectedCity.Districts, "Chọn Quận/Huyện");
                        wardSelect.innerHTML = `<option>-- Chọn Phường/Xã --</option>`;
                    } else {
                        districtSelect.innerHTML = `<option>-- Chọn Quận/Huyện --</option>`;
                        wardSelect.innerHTML = `<option>-- Chọn Phường/Xã --</option>`;
                    }
                });

                // Khi chọn quận/huyện
                districtSelect.addEventListener("change", (event) => {
                    const selectedCity = data.find((city) => city.Name === citySelect.value);
                    const selectedDistrict = selectedCity?.Districts.find(
                        (district) => district.Name === event.target.value
                    );
                    console.log("selectedDistrict");
                    if (selectedDistrict) {
                        populateSelect(wardSelect, selectedDistrict.Wards, "Chọn Phường/Xã");
                    } else {
                        wardSelect.innerHTML = `<option>-- Chọn Phường/Xã --</option>`;
                    }
                });
                @if (session('address_option') === 'new')
                    const event = new Event('change');
                    citySelect.value = "{{ session()->get('Province', 'default') }}"; // Đổi giá trị
                    citySelect.dispatchEvent(event);
                    districtSelect.value = "{{ session()->get('District', 'default') }}"
                    districtSelect.dispatchEvent(event);
                    wardSelect.value = "{{ session()->get('Ward', 'default') }}"

                    // Kích hoạt sự kiện change thủ công



                    wardSelect.dispatchEvent(event);
                @endif

            })
            .catch((error) => console.error("Lỗi khi tải dữ liệu:", error));
    </script>
    <script>
        // Lấy checkbox và các phần tử form-select

        const defaul = document.getElementById('default');
        const new_address = document.getElementById('new_address');
        const Address = document.getElementById('Address');
        const formSelects = document.querySelectorAll('.form-select');

        // Cập nhật trạng thái ban đầu
        formSelects.forEach(select => {
            select.disabled = defaul.checked;
            console.log("trang thai" + select.disabled);
            Address.disabled = defaul.checked;
            // Vô hiệu hóa nếu checkbox được chọn
        });

        // Thêm sự kiện 'change' để kiểm tra trạng thái của checkbox
        defaul.addEventListener('change', () => {
            console.log("Trạng thái thay đổi:", defaul.checked);
            formSelects.forEach(select => {
                select.disabled = defaul
                    .checked; // Kích hoạt hoặc vô hiệu hóa tùy thuộc vào trạng thái checkbox
            });
            Address.disabled = true;
        });
        new_address.addEventListener('change', () => {
            formSelects.forEach(select => {
                select.disabled = false; // Kích hoạt hoặc vô hiệu hóa tùy thuộc vào trạng thái checkbox
            });
            Address.disabled = false;
        })
    </script>
@endsection
