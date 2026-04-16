@extends('admin_layout')
@section('admin_content')
    

    <div class="card">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="card-header">Liệt kê đơn hàng</h1>
                </div>

                {{-- <div class="card-body">
                    <a href={{ route('category.add') }}>
                        <button type="button" class="btn btn-primary">Thêm Danh Mục</button>
                    </a>
                </div> --}}

                <div class="table-responsive text-nowrap">
                    <table id="categoryTable" class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>ID / Ngày đặt hàng </th>
                                <th>Tổng giá trị</th>
                                <th>Người đặt hàng / Email / Địa chỉ giao</th>
                                <th>Sản phẩm</th>

                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $value)
                                
                                    <tr onclick="window.location.href='{{ route('order.details',$value->OrderID) }}';" style="cursor: pointer;">
                                        <td>
                                            Mã đơn: {{ $value->OrderID }}
                                            <br>
                                            {{ $value->OrderDate }}
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

                                            {!! $statusMap[$value->Status] ?? '<span class="badge bg-label-secondary">Không xác định</span>' !!}
                                        </td>
                                        <td>{{ number_format($value->FinalPrice, 0) }} VND
                                        </td>
                                        <td><span class="text-ellipsis">
                                                {{ $value->FullName }}
                                                <br>
                                                {{ $value->Email }}
                                                <br>
                                                {{ $value->Address }}</span></td>
                                        <td>
                                            @foreach ($value->images as $k => $value)
                                                <img src="{{ asset("storage/app/public/$value") }}" alt=""
                                                    style="height:45px; ">
                                            @endforeach
                                        </td>
                                        {{-- <td style="display: flex; align-items: center;">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Edit Action -->
                                                <a class="dropdown-item" href="{{ url('edit-category', $cate->category_id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
    
                                                <!-- Delete Action -->
                                                <form action="{{ route('category.delete', $cate->category_id) }}" method="POST" style="display:none;" id="deleteForm{{ $cate->category_id }}">
                                                    @csrf
                                                </form>
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $cate->category_id }}').submit();">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
    
                                            </div>
                                        </div>
                                    </td> --}}
                                    </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <script>
                    // $(document).ready(function() {
                    //     // Khởi tạo DataTable cho bảng danh mục sản phẩm
                    //     $('#categoryTable').DataTable();
                    // });
                </script>
            </div>
        </div>
    </div>
@endsection
