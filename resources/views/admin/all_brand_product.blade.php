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
    <div class="card">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{-- <h1 ></h1>  --}}
                    <h1 class="card-header">Liệt kê thương hiệu</h1>
                </div>

                <div class="card-body">
                    <a href={{ route('brand.add') }}>
                        <button type="button" class="btn btn-primary">Thêm Brand</button>
                    </a>
                </div>

                <div class="table-responsive text-nowrap">

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
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="{{ route('brand.edit', $brand->brand_id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('brand.delete', $brand->brand_id) }}" method="POST"
                                                    style="display:none;" id="deleteForm{{ $brand->brand_id }}">
                                                    @csrf
                                                </form>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="event.preventDefault(); document.getElementById('deleteForm{{ $brand->brand_id }}').submit();">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>

                                            </div>
                                        </div>


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
    </div>
@endsection
