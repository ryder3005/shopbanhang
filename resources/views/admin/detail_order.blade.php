@extends('admin_layout')
@section('admin_content')
<div class="row g-2 mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="demo-inline-spacing">
                    <form action="{{ route('order.update', $order->OrderID) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if ($order->Status==='pending')
                        <button type="submit" name="status" value="shipped" class="btn btn-outline-info">
                            <i class='menu-icon tf-icons bx bxs-truck'></i> Giao hàng
                        </button>
                        @endif
                        @if ($order->Status==='shipped')
                        <button type="submit" name="status" value="delivered" class="btn btn-outline-success">
                            <i class='menu-icon tf-icons bx bx-check-circle'></i> Đã nhận hàng
                        </button>    
                        @endif
                        
                        
                        <button type="submit" name="status" value="cancelled" class="btn btn-outline-danger">
                            <i class='menu-icon tf-icons bx bx-x-circle'></i> Hủy đơn hàng
                        </button>
                        
                        
                    </form>
                    
                  </div>
            </div>
        </div>
    </div>
</div>
    <div class="row g-2 mb-5">
        <div class="col-8 ">
            <div class="card">
                <div class="card-header">
                    <h4> Số lượng sản phẩm {{ count($order->details) }} tổng cộng:
                        {{ number_format($order->FinalPrice, 0, ',', '.') }} VND</h1>
                </div>
                @foreach ($order->details as $key => $value)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset("storage/app/public/$value->image") }}" alt=""
                                    style="height:45px; ">
                            </div>
                            <div class="col-8">
                                <h5>{{ $value->products->product_name }}</h5>

                                Bộ nhớ: {{ $value->product_details->StorageCapacity }} GB
                                RAM: {{ $value->product_details->RAM }} GB
                                Màu sắc: {{ $value->product_details->Color }}
                                <br>
                                Đơn giá {{ number_format($value->product_details->Price, 0, ',', '.') }} VND x Số lượng
                                {{ $value->Quantity }}
                                <br>
                            </div>
                            <div class="col-2">
                                {{ number_format($value->Price * $value->Quantity, 0, ',', '.') }} VND
                            </div>
                        </div>
                    </div>
                @endforeach
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
                                <span class="text- fw-bold">Tổng cộng:</span>
                                <span class="fw-bold">{{ number_format($order->FinalPrice, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>

        <div class=" col-4 ">
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne"
                        aria-expanded="true" aria-controls="accordionOne">
                        Thông tin khách hàng
                    </button>
                </h2>

                <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample"
                    style="">
                    <div class="accordion-body">
                        Họ tên: {{ $order->FullName }}
                        <br>
                        Email: {{ $order->Email }}
                        <br>
                        Địa chỉ: {{ $order->Address }}

                    </div>
                </div>
            </div>
            <br>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne"
                        aria-expanded="true" aria-controls="accordionOne">
                        Thông tin đơn hàng
                    </button>
                </h2>

                <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample"
                    style="">
                    <div class="accordion-body">
                        Ngày đặt hàng: {{ $order->OrderDate }}
                        <br>
                        @php
                        $statusMap = [
                            'pending' =>
                                '<span class="badge bg-label-warning">Đang xử lý</span>',
                            'shipped' =>
                                '<span class="badge bg-label-primary">Đang giao hàng</span>',
                            'delivered' =>
                                '<span class="badge bg-label-success">Đã giao xong</span>',
                            'cancelled' => 
                                '<span class="badge bg-label-danger">Đã hủy</span>',
                        ];
                    @endphp
                        Trạng thái: {!! $statusMap[$order->Status] ?? '<span class="badge bg-label-secondary">Không xác định</span>' !!}


                    </div>
                </div>
            </div>
            <br>
            {{-- <div class="card">

                <div class="card-header">
                    sdfsdf
                </div>
                <div class="card-body">
                    sdfsdf
                </div>
            </div> --}}
        </div>


    </div>
@endsection
