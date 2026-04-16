@extends('front_layout')
@section('front_content')
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">

                                @foreach ($product->images as $key => $value)
                                    <div class="item-slick3" data-thumb={{ asset("storage/app/public/$value") }}>
                                        <div class="wrap-pic-w pos-relative">
                                            <img src={{ asset("storage/app/public/$value") }} alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href={{ asset("storage/app/public/$value") }}>
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach



                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->product_name }}
                        </h4>

                        <span class="mtext-106 cl2" id="price">

                            @php
                                // Lọc danh sách details theo Color, RAM và StorageCapacity
                                $filteredDetails = collect($product->details)->filter(function ($detail) {
                                    return $detail->RAM == session('SelectRAM') &&
                                        $detail->StorageCapacity == session('SelectStorageCapacity') &&
                                        $detail->Color == session('SelectColor'); // Lọc theo màu sắc
                                });

                                // Kiểm tra nếu có chi tiết phù hợp
                                $price = $filteredDetails->isNotEmpty()
                                    ? number_format($filteredDetails->first()->Price, 0, ',', '.')
                                    : 'Giá chưa có';
                            @endphp

                            <span>{{ $price }} </span>


                        </span>


                        <form action={{ route('cart.add') }} method="POST" id="form1">
                            @csrf
                            <input type="hidden" name="product_id" value={{ $product->product_id }}>
                            <input type="hidden" name="ProductDetailID"
                                value={{ session()->get('SelectProductDetailID', 'default') }}>

                            <div class="p-t-33">
                                <!-- RAM -->
                                @php
                                    $rams = collect($product->details)
                                        ->map(function ($detail) {
                                            return $detail->RAM; // Truy cập thuộc tính của đối tượng
                                        })
                                        ->unique()
                                        ->values();
                                    $StorageCapacity = collect($product->details)
                                        ->map(function ($detail) {
                                            return $detail->StorageCapacity; // Truy cập thuộc tính của đối tượng
                                        })
                                        ->unique()
                                        ->values();
                                    $Color = collect($product->details)
                                        ->map(function ($detail) {
                                            return $detail->Color; // Truy cập thuộc tính của đối tượng
                                        })
                                        ->unique()
                                        ->values();

                                @endphp

                                {{-- {{ $rams }} --}}
                                <div class="pick-section">
                                    <h4 class="pick-title">Chọn dung lượng</h4>
                                    <div class="pick-options">
                                        @foreach ($StorageCapacity as $i)
                                            @php
                                                $filteredDetails = collect($product->details)->filter(function ($detail) use ($i) {
                                                    return $detail->StorageCapacity == $i;
                                                });
                                
                                                $isSelected = session('SelectStorageCapacity') == $i;
                                                $productDetailID = optional($filteredDetails->first())->ProductDetailID;
                                            @endphp
                                
                                            @if ($productDetailID)
                                                <a href="{{ route('home.detail', ['product_id' => $product->product_id, 'detail_id' => $productDetailID]) }}"
                                                   class="option {{ $isSelected ? 'selected' : '' }}">
                                                    {{ $i }} GB
                                                </a>
                                            @else
                                                {{-- Hiển thị thông báo fallback hoặc ẩn tùy chọn --}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="pick-section">
                                    <h4 class="pick-title">Chọn RAM</h4>
                                    <div class="pick-options">
                                        @foreach ($rams as $i)
                                            @php
                                                $filteredDetails = collect($product->details)->filter(function ($detail) use ($i) {
                                                    return $detail->RAM == $i && 
                                                           $detail->StorageCapacity == session('SelectStorageCapacity');
                                                });
                                
                                                $isSelected = session('SelectRAM') == $i;
                                                $productDetailID = optional($filteredDetails->first())->ProductDetailID;
                                            @endphp
                                
                                            @if ($productDetailID)
                                                <a href="{{ route('home.detail', ['product_id' => $product->product_id, 'detail_id' => $productDetailID]) }}"
                                                   class="option {{ $isSelected ? 'selected' : '' }}">
                                                    {{ $i }} GB
                                                </a>
                                            @else
                                                {{-- Hiển thị thông báo fallback hoặc ẩn tùy chọn --}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                

                                <div class="pick-section">
                                    <h4 class="pick-title">Chọn màu sắc</h4>
                                    <div class="pick-options">
                                        @foreach ($Color as $i)
                                            @php
                                                $filteredDetails = collect($product->details)->filter(function (
                                                    $detail,
                                                ) use ($i) {
                                                    return $detail->Color == $i &&
                                                        $detail->RAM == session('SelectRAM') &&
                                                        $detail->StorageCapacity == session('SelectStorageCapacity');
                                                });

                                                $isSelected = session('SelectColor') == $i;
                                                $productDetailID = optional($filteredDetails->first())->ProductDetailID;
                                            @endphp

                                            @if ($productDetailID)
                                                <a href="{{ route('home.detail', ['product_id' => $product->product_id, 'detail_id' => $productDetailID]) }}"
                                                    class="option colorpick {{ $isSelected ? 'selected' : '' }}">
                                                    <i class="color-icon"></i> {{ $i }}
                                                </a>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>




                                @foreach ($product->details as $detail)
                                    {{-- <option value="{{ $detail->ProductDetailID }}" data-price="{{ number_format($detail->Price, 0, ',', '.') }}" data-storage="{{ $detail->StorageCapacity }}">
                            {{ $detail->RAM }} GB {{$detail->StorageCapacity  }} GB {{ $detail->Color }}
                        </option>
                        <a href="#">
                            <div class="op">
                                <div class="color" style="background-color: white;" ></div>
                                <div class="text" value="Trắng">Trắng</div>
                            </div>
                        </a> --}}
                                @endforeach
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        {{-- Cấu hình --}}
                                    </div>
                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">


                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Color -->
                                {{-- <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Màu sắc
                                </div>
                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" id="select-color" name="color" onchange="updatePrice()">
                                            <option value="">Chọn</option>
                                            @foreach ($product->details as $detail)
                                                <option value="{{ $detail->ProductDetailID }}" data-price="{{ $detail->Price }}" data-ram="{{ $detail->RAM }}">
                                                    {{ ucfirst($detail->Color) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div> --}}

                                <!-- Quantity and Add to Cart -->
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num_product" value="1">
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 "
                                            type="submit" form="form1">
                                            Thêm vào giỏ hàng

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <script>
                            function updatePrice() {
                                const ramSelect = document.getElementById('select-ram');
                                // const colorSelect = document.getElementById('select-color');

                                // Kiểm tra nếu người dùng đã chọn cả RAM và Color
                                if (ramSelect.value) {
                                    // Lấy giá từ option đã chọn
                                    const price = ramSelect.options[ramSelect.selectedIndex].getAttribute('data-price');
                                    document.getElementById('price').textContent = price + " VND";
                                } else {
                                    document.getElementById('price').textContent = "Chọn cấu hình";
                                }
                            }
                        </script>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả</a>
                        </li>

                        {{-- <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional
                                information</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
                        </li> --}}
                    </ul>
                    <div>
                        {{-- {{ $product->product_description }} --}}
                    </div>
                    @php
                        $attributes = [
                            'CPU' => $product->CPU,
                            'Tốc độ CPU' => $product->CPU_Speed,
                            'GPU' => $product->GPU,
                            'Độ phân giải camera sau' => $product->RearCameraResolution,
                            'Tính năng camera sau' => $product->RearCameraFeatures,
                            'Độ phân giải camera trước' => $product->FrontCameraResolution,
                            'Tính năng camera trước' => $product->FrontCameraFeatures,
                            'Công nghệ màn hình' => $product->DisplayTechnology,
                            'Độ phân giải màn hình' => $product->DisplayResolution,
                            'Kích thước màn hình' => $product->DisplaySize,
                            'Tần số quét' => $product->RefreshRate,
                            'Độ sáng tối đa' => $product->MaxBrightness,
                            'Kính màn hình' => $product->DisplayGlass,
                            'Dung lượng pin' => $product->BatteryCapacity,
                            'Loại pin' => $product->BatteryType,
                            'Công suất sạc tối đa' => $product->MaxChargingSupport,
                            'Bộ sạc đi kèm' => $product->ChargerIncluded,
                            'Công nghệ pin' => $product->BatteryTechnology,
                            'Bảo mật nâng cao' => $product->AdvancedSecurity,
                            'Tính năng đặc biệt' => $product->SpecialFeatures,
                            'Khả năng chống nước/bụi' => $product->WaterDustResistance,
                            'Ghi âm' => $product->Recording,
                            'Radio' => $product->Radio,
                            'Mạng di động' => $product->MobileNetwork,
                            'Hỗ trợ SIM' => $product->SIMSupport,
                            'Hỗ trợ Wi-Fi' => $product->WifiSupport,
                            'GPS' => $product->GPS,
                            'Bluetooth' => $product->Bluetooth,
                            'Cổng sạc' => $product->ChargingPort,
                            'Jack tai nghe' => $product->HeadphoneJack,
                            'Các kết nối khác' => $product->OtherConnections,
                            'Kiểu thiết kế' => $product->DesignType,
                            'Chất liệu' => $product->Material,
                            'Kích thước' => $product->Dimensions,
                            'Trọng lượng' => $product->Weight,
                            'Ngày ra mắt' => $product->ReleaseDate,
                        ];
                    @endphp
                    <!-- Tab panes -->
                    <div class="tab-content p-t-43 justify-content-center">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $product->product_description }}

                                </p>
                            </div>
                            <br>
                            <table class="table  col-8">


                                <tbody>
                                    @foreach ($attributes as $attributeName => $attributeValue)
                                        <tr>
                                            <th scope="row">{{ $attributeName }}</th>
                                            <td>{{ $attributeValue }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{-- <style>
    .table {
    width: 100%; /* Bảng chiếm toàn bộ chiều rộng vùng chứa */
    table-layout: auto; /* Bảng điều chỉnh kích thước các cột theo nội dung */
    border-collapse: collapse; /* Loại bỏ khoảng trống giữa các ô */
}

.table th, .table td {
    word-wrap: break-word; /* Ngắt dòng khi nội dung quá dài */
    word-break: break-word; /* Hỗ trợ thêm cho các từ dài */
    white-space: normal; /* Đảm bảo nội dung xuống dòng thay vì chạy ra ngoài */
    padding: 10px; /* Tạo khoảng cách giữa nội dung và viền */
}
</style> --}}

                        <!-- - -->


                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row justify-content-center">
                                <table class="table col-8">
                                    {{-- <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                  </tr>
                                </thead> --}}
                                    <tbody>
                                        @foreach ($attributes as $attributeName => $attributeValue)
                                            <tr>
                                                <th scope="row">{{ $attributeName }}</th>
                                                <td>{{ $attributeValue }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <table class="col-8 m-lr-auto">






                                </table>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="images/avatar-01.jpg" alt="AVATAR">
                                            </div>

                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        Ariana Grande
                                                    </span>

                                                    <span class="fs-18 cl11">
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star-half"></i>
                                                    </span>
                                                </div>

                                                <p class="stext-102 cl6">
                                                    Quod autem in homine praestantissimum atque optimum est, id deseruit.
                                                    Apud ceteros autem philosophos
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Add review -->
                                        <form class="w-full">
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add a review
                                            </h5>

                                            <p class="stext-102 cl6">
                                                Your email address will not be published. Required fields are marked *
                                            </p>

                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">
                                                    Your Rating
                                                </span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input class="dis-none" type="number" name="rating">
                                                </span>
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Your review</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="name">Name</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name"
                                                        type="text" name="name">
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="email">Email</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                        type="text" name="email">
                                                </div>
                                            </div>
                                            {{-- <input type="text"> --}}
                                            <button
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var product = @json($product->details, JSON_UNESCAPED_UNICODE);
            console.log(product);
        </script>

    </section>
    <style>
        .pick-section {
            margin-bottom: 20px;
        }

        .pick-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .pick-options {
            display: flex;
            gap: 10px;
        }

        .option {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }

        .option.selected {
            background-color: #007bff;
            /* Màu nền xanh lam */
            color: white;
            /* Màu chữ trắng */
            border-color: #0056b3;
            /* Đổi màu viền */
            font-weight: bold;
            /* Tô đậm chữ */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Hiệu ứng nổi */
        }

        .option:hover {
            background-color: #f0f0f0;
            color: #007bff;
        }

        .color-options .option {
            display: flex;
            align-items: center;
        }

        .color-indicator {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .color-black {
            background-color: black;
        }

        .color-white {
            background-color: white;
            border: 1px solid #ddd;
        }

        .add-to-cart {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .quantity-section {
            display: flex;
            align-items: center;
            gap: 5px;
        }



        .add-to-cart-btn {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background-color: #218838;
        }
    </style>
@endsection
