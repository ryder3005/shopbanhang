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


        }
    </script>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 >Liệt kê thương hiệu</h1> 
            </div>

            <a href={{ route('brand.add') }}><button class="btn btn-primary mb-3">Thêm Danh Mục</button></a>

            <div class="table-responsive">
                <table id="brandgoryTable" class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Chi tiết</th>
                            <th style="width:30px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_brand_product as $key => $brand)
                            <tr>
                                <td>{{ $brand->brand_id }}</td>
                                <td> {{ $brand->brand_name }} </td>
                                <td><span class="text-ellipsis">{{ $brand->brand_desc }}</span></td>
                                <td style="display: flex; align-items: center;">
                                    <a href="javascript:void(0);" class="btn"
                                        onclick="toggleStatus({{ $brand->brand_id }})">
                                        <i class="fas {{ $brand->brand_status ? 'fa-eye' : 'fa-eye-slash' }}"
                                            data-id="{{ $brand->brand_id }}" data-status="{{ $brand->brand_status }}"
                                            style="color: {{ $brand->brand_status ? 'green' : 'red' }}; cursor: pointer;"></i>
                                    </a>
                                    {{-- <form action="{{ url('edit-brandgory', $brand->brandgory_id) }}" method="GET">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-edit"></i> Sửa
                                        </button>
                                    </form> --}}

                                    <a href="{{ route('brand.edit', $brand->brand_id) }}" class="btn">
                                        <i class="fa fa-edit"></i>
                                    </a>


                                    <form action="{{ route('brand.delete', $brand->brand_id) }}" method="POST"
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
                    $('#brandgoryTable').DataTable({

                    });
                });
            </script>


        </div>
    </div>
@endsection
