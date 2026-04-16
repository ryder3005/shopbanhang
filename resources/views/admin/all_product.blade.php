@extends('admin_layout')
@section('admin_content')
<script>
    function toggleStatus(id) {
        // Lấy icon tương ứng
        var icon = $('i[data-id="' + id + '"]');

        // Lấy trạng thái hiện tại từ thuộc tính data-status
        var currentStatus = parseInt(icon.attr('data-status'));

        // Đảo ngược trạng thái hiện tại (nếu currentStatus là 1, thì newStatus là 0, và ngược lại)
        var newStatus = currentStatus === 1 ? 0 : 1;

        $.ajax({
            url: "{{ route('category.toggle') }}", // Đường dẫn đến route xử lý yêu cầu
            type: 'POST',
            data: {
                id: id,
                status: newStatus,
                _token: '{{ csrf_token() }}' // CSRF token để bảo mật
            },
            success: function(response) {
                console.log('newStatus:', newStatus);

                // Cập nhật lại trạng thái mới trong DOM và đổi icon
                icon.attr('data-status', newStatus); // Cập nhật trạng thái mới

                if (newStatus) {
                    icon.removeClass('fa-eye-slash').addClass('fa-eye').css('color', 'green');
                } else {
                    icon.removeClass('fa-eye').addClass('fa-eye-slash').css('color', 'red');
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    }
</script>

<div class="card">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="card-header">Liệt kê sản phẩm</h1>
            </div>

            <div class="card-body">
                <a href={{ route('products.add') }}>
                    <button type="button" class="btn btn-primary">Thêm sản phẩm</button>
                </a>
            </div>

            <div class="table-responsive text-nowrap">
                <table id="categoryTable" class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Chi Tiết</th>
                            <th >Hành động</th>
                            <th>Ảnh </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_product as $key => $cate)
                            <tr>
                                <td>{{ $cate->product_id }}</td>
                                <td>{{ $cate->product_name }}</td>
                                <td >
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Edit Action -->
                                            <a class="dropdown-item" href= {{ route("products.edit",$cate->product_id) }}>
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>

                                            <!-- Delete Action -->
                                            {{-- <form action="{{ route('products.delete', $cate->product_id) }}" method="delete" style="display:none;" id="deleteForm{{ $cate->product_id }}">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('deleteForm{{ $cate->category_id }}').submit();">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a> --}}

                                            <!-- Status toggle -->
                                            {{-- <a class="dropdown-item" href="javascript:void(0);" onclick="toggleStatus({{ $cate->category_id }})">
                                                <i class="fas {{ $cate->category_status ? 'fa-eye' : 'fa-eye-slash' }}" data-id="{{ $cate->category_id }}" data-status="{{ $cate->category_status }}" style="color: {{ $cate->category_status ? 'green' : 'red' }};"></i>
                                                {{ $cate->category_status ? 'Disable' : 'Enable' }}
                                            </a> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @foreach ($cate->images as $key => $value)
                                        <img src="{{ asset("storage/app/public/$value") }}" alt="" style="height:45px; ">
                                    @endforeach
                                </td>
                                <td>{{ $cate->product_description }}</td>
                                
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
