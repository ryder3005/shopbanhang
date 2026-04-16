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
                        console.log('Updating icon to eye');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye').css('color', 'green');
                    } else {
                        console.log('Updating icon to eye-slash');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash').css('color', 'red');
                    }
                },
                error: function(xhr) {
                    // Hiển thị chi tiết lỗi từ phản hồi server
                    alert('Error: ' + xhr.responseJSON.message); // Lấy thông điệp lỗi từ phản hồi JSON
                }
            });
        }
    </script>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục sản phẩm
            </div>

            <a href={{ route('category.add') }}><button class="btn btn-primary mb-3">Thêm Danh Mục</button></a>

            <div class="table-responsive">
                <table id="categoryTable" class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Chi tiết</th>
                            <th>Ngày thêm</th>
                            <th style="width:30px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_category_product as $key => $cate)
                            <tr>
                                <td>{{ $cate->category_id }}</td>
                                <td> {{ $cate->category_name }} </td>
                                <td><span class="text-ellipsis">{{ $cate->category_desc }}</span></td>
                                <td style="display: flex; align-items: center;">
                                    <a href="javascript:void(0);" class="btn"
                                        onclick="toggleStatus({{ $cate->category_id }})">
                                        <i class="fas {{ $cate->category_status ? 'fa-eye' : 'fa-eye-slash' }}"
                                            data-id="{{ $cate->category_id }}" data-status="{{ $cate->category_status }}"
                                            style="color: {{ $cate->category_status ? 'green' : 'red' }}; cursor: pointer;"></i>
                                    </a>
                                    {{-- <form action="{{ url('edit-category', $cate->category_id) }}" method="GET">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-edit"></i> Sửa
                                        </button>
                                    </form> --}}

                                    <a href="{{ url('edit-category', $cate->category_id) }}" class="btn">
                                        <i class="fa fa-edit"></i>
                                    </a>


                                    <form action="{{ route('category.delete', $cate->category_id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        <a href="javascript:void(0);" class="btn"
                                            onclick="this.closest('form').submit();">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </a>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <script>
                $(document).ready(function() {
                    // Khởi tạo DataTable cho bảng danh mục sản phẩm
                    $('#categoryTable').DataTable({

                    });
                });
            </script>


        </div>
    </div>
@endsection
