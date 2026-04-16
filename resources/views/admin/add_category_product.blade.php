@extends('admin_layout')
@section('admin_content')

    <div class="row ">
        <div class="col-lg-6">
            <div class="card mb-4">
                <h5 class="card-header">Thêm danh mục sản phẩm</h5>
                <div class="card-body">
                    <form role="form" action="{{ url('/save-category-product') }}" method="POST">
                        @csrf
                        <div>
                            <label for="category_name" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="category_name" name="category_name"
                                placeholder="Nhập tên danh mục" required>
                        </div>
                        
                        <div>
                            <label for="category_desc" class="form-label">Mô tả danh mục</label>
                            <textarea class="form-control" id="category_desc" name="category_desc" rows="5" placeholder="Nhập mô tả danh mục"
                                required></textarea>
                        </div>
                        
                        <div>
                            <label for="category_status" class="form-label">Trạng thái</label>
                            <select class="form-control" id="category_status" name="category_status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
