@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
            </header>
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{ url('/save-brand-product') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="brand_name">Tên thương hiệu</label>
                            <input type="text" class="form-control" id="brand_name" name="brand_name"
                                placeholder="Nhập tên thương hiệu" required>
                        </div>
                        <div class="form-group">
                            <label for="brand_desc">Mô tả thương hiệu</label>
                            <textarea class="form-control" id="brand_desc" name="brand_desc" rows="5" placeholder="Nhập mô tả thương hiệu"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="brand_status">Trạng thái</label>
                            <select class="form-control" id="brand_status" name="brand_status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
