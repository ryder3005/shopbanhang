@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <div class="panel-body">
                @php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<div class="alert alert-success">' . $message . '</div>';
                        Session::put('message', null);
                    }
                @endphp
                <div class="position-center">
                    <form role="form" action="{{ url('/save-category-product') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Tên danh mục</label>
                            <input type="text" class="form-control" id="category_name" name="category_name"
                                placeholder="Nhập tên danh mục" required>
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Mô tả danh mục</label>
                            <textarea class="form-control" id="category_desc" name="category_desc" rows="5" placeholder="Nhập mô tả danh mục"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_status">Trạng thái</label>
                            <select class="form-control" id="category_status" name="category_status">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
