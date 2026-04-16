@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật thương hiệu sản phẩm
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
                <form role="form" action="{{ route('brand.update', $brand->brand_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="brand_name">Tên thương hiệu</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name"
                        value="{{ $brand->brand_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="brand_desc">Mô tả thương hiệu</label>
                        <textarea class="form-control" id="brand_desc" name="brand_desc" rows="5" placeholder="Nhập mô tả thương hiệu"
                            required>{{ $brand->brand_desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="brand_status">Trạng thái</label>
                        <select class="form-control" id="brand_status" name="brand_status">
                            <option value="1" {{ $brand->brand_status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $brand->brand_status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Cập nhật thương hiệu</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
