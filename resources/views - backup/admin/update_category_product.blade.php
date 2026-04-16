@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
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
                    <form role="form" action="{{ route('category.update', $category->category_id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Tên danh mục</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" 
                                   value="{{ old('category_name', $category->category_name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Mô tả danh mục</label>
                            <textarea class="form-control" id="category_desc" name="category_desc" rows="5" 
                                      placeholder="Nhập mô tả danh mục" required>{{ old('category_desc', $category->category_desc) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_status">Trạng thái</label>
                            <select class="form-control" id="category_status" name="category_status">
                                <option value="1" {{ $category->category_status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $category->category_status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Sửa danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
