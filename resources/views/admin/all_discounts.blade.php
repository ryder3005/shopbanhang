@extends('admin_layout')
@section('admin_content')
    <script></script>

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Danh sách mã giảm giá</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('discounts.add') }}">
                <button type="button" class="btn btn-primary mb-3">Thêm mã giảm giá</button>
            </a>
            <div class="table-responsive ">
                <table id="discountTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã giảm giá</th>
                            <th>Loại</th>
                            <th>Số lượng</th>
                            <th>Lượt sử dụng</th>
                            <th>Giới hạn</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày hết hạn</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $key => $discount)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $discount->code }}</td>
                                <td>{{ $discount->type == 'fixed' ? 'Cố định' : 'Phần trăm' }}
                                </td>
                                <td>{{ number_format($discount->amount, 0, '.', ',') }}                                </td>
                                <td>{{ $discount->used }}</td>
                                <td>{{ $discount->usage_limit }}</td>
                                <td>{{ $discount->start_date }}</td>
                                <td>{{ $discount->end_date }}</td>
                                <td>
                                    {{ $discount->is_active == '1' ? 'Còn hạn' : 'Hết hạn' }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Edit -->
                                            
                                                <a class="dropdown-item" href="{{ route('discounts.edit', $discount->DiscountID) }}">
                                                    <i class="bx bx-edit-alt"></i> Chỉnh sửa
                                                </a>
                                            <!-- Delete -->
                                            
                                                <a href="{{ route('discounts.delete', $discount->DiscountID) }}" class="dropdown-item">
                                                    
                                                        <i class="bx bx-trash"></i> Xóa
                                                    
                                                </a>



                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#discountTable').DataTable(); // Nếu muốn sử dụng DataTables
        });
    </script>
@endsection
