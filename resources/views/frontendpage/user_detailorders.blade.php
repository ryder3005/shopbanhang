@extends('front_layout')
@section('front_content')
    <!-- breadcrumb -->
    {{-- <div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
            Men
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Lightweight Jacket
        </span>
    </div>
</div> --}}
    <br>
    <br>
    <br>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <!-- Menu bên trái -->
                <nav class="col-3 d-md-block  ">
                    <div class="">
                        <ul class="nav flex-column">

                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    Thông tin cá nhân
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    Thay đổi mật khẩu
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Cài đặt tài khoản
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Phần thông tin cá nhân -->
                <main class="col-9 ms-sm-auto  px-4">
                    <h2>Thông tin cá nhân</h2>
                    <br>
                    {{-- <form>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Nhập họ và tên" value="{{ $user->FullName }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email" value="{{ $user->Email }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại" value="{{ $user->PhoneNumber }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ" value="{{ $user->Address }}">
                    </div>
                    <div class="mb-3">
                        <label for="ward" class="form-label">Phường</label>
                        <input type="text" class="form-control" id="ward" placeholder="Nhập phường" value="{{ $user->Ward }}">
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">Quận</label>
                        <input type="text" class="form-control" id="district" placeholder="Nhập quận" value="{{ $user->District }}">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Thành phố</label>
                        <input type="text" class="form-control" id="city" placeholder="Nhập thành phố" value="{{ $user->City }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                </form> --}}

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#Mã sản phẩm </th>
                                <th scope="col">Tên</th>
                                <th scope="col">Bộ nhớ</th>
                                <th scope="col">Ram</th>
                                <th scope="col">Màu sắc</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                {{-- <th scope="col">Trạng thái</th> --}}
                                <th scope="col">Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $key => $value)
                                <tr>
                                    <th scope="row">#{{ $value->product_id }}</th>
                                    <td>{{ $value->products->product_name}}</td>
                                    <td>{{ $value->product_details->StorageCapacity}}</td>
                                    <td>{{ $value->product_details->RAM}}</td>
                                    <td>{{ $value->product_details->Color}}</td>
                                    <td>{{ number_format($value->product_details->Price, 0, ',', '.') }}</td>

                                    <td>{{ $value->Quantity}}</td>
                                    <td>{{ number_format($value->product_details->Price, 0, ',', '.') }} VND</td>
                                    <!-- Định dạng tiền -->
                                    
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="card-body justify-content-end">
                        <div class="row justify-content-end ">
                            <div class="col-4">
                                <div class="d-flex justify-content-between">
                                    <span class="">Tổng giá trị:</span>
                                    <span>{{ number_format($order->TotalPrice, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="">Giảm giá:</span>
                                    <span>{{ number_format($order->DiscountAmount, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="">Phí vận chuyển:</span>
                                    <span>{{ number_format($order->ShippingFee, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class=" fw-bold">Tổng cộng:</span>
                                    <span class="fw-bold">{{ number_format($order->FinalPrice, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    Họ tên: {{ $order->FullName }}
                    <br>
                    Địa chỉ: {{ $order->Address }}

                    <br>
                <br>
                <br>
                <br>
                <br><br>
                <br>
                <br>
                <br>
                <br>
                </main>
                
            </div>
        </div>


    </div>
@endsection
