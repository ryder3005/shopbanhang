@extends('admin_layout')
@section('admin_content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4">
            <h5 class="card-header">Cập nhật thương hiệu sản phẩm</h5>
            <div class="card-body">
                @php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<div class="alert alert-success">' . $message . '</div>';
                        Session::put('message', null);
                    }
                @endphp
                <form role="form" action="{{ route('brand.update', $brand->brand_id) }}" method="POST">
                    @csrf
                    <div>
                        <label for="brand_name" class="form-label">Tên thương hiệu</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ $brand->brand_name }}" required>
                    </div>

                    <div>
                        <label for="brand_desc" class="form-label">Mô tả thương hiệu</label>
                        <textarea class="form-control" id="brand_desc" name="brand_desc" rows="5" placeholder="Nhập mô tả thương hiệu" required>{{ $brand->brand_desc }}</textarea>
                    </div>

                    <div>
                        <label for="brand_status" class="form-label">Trạng thái</label>
                        <select class="form-control" id="brand_status" name="brand_status">
                            <option value="1" {{ $brand->brand_status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ $brand->brand_status == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-info">Cập nhật thương hiệu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
