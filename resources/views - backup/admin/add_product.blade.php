@extends('admin_layout')
@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>


    <div class="col-lg-12">


        <form method="POST" enctype="multipart/form-data" id="productForm" action="{{ route('products.store') }}">
            @csrf
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <h1>Thêm Sản Phẩm</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="product_name">Tên Sản Phẩm</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="product_description">Mô Tả Sản Phẩm</label>
                        <textarea name="product_description" id="product_description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="brands_id">Thương Hiệu</label>
                        <select name="brands_id" id="brands_id" class="form-control">
                            <option value="">Chọn Thương Hiệu</option>
                            @foreach ($all_brand_product as $key => $brand)
                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Danh Mục</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Chọn Danh Mục</option>
                            @foreach ($all_category_product as $key => $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="images[]" multiple>
                    </div>




                    <button type="button" id="add-detail" class="btn btn-secondary">Thêm Cấu Hình Khác</button>
                    <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                </div>

                <div class="col-lg-6">
                    <h3>Cấu Hình Sản Phẩm</h3>
                    <div id="product-details">
                        <div class="product-detail">
                            <div class="form-group">
                                <label for="color">Màu Sắc</label>
                                <input type="text" name="product_details[0][color]" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="size">Kích Thước</label>
                                <input type="text" name="product_details[0][size]" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="ram">RAM</label>
                                <input type="number" name="product_details[0][ram]" class="form-control" required
                                    min="0">
                            </div>

                            <div class="form-group">
                                <label for="storage">Bộ Nhớ</label>
                                <input type="number" name="product_details[0][storage]" class="form-control" required
                                    min="0">
                            </div>

                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input type="number" name="product_details[0][price]" class="form-control" required
                                    min="0">
                            </div>

                            <div class="form-group">
                                <label for="stock">Tồn Kho</label>
                                <input type="number" name="product_details[0][stock]" class="form-control" required
                                    min="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            let detailIndex = 1;

            document.getElementById('add-detail').addEventListener('click', function() {
                const newDetail = document.createElement('div');
                newDetail.classList.add('product-detail');

                // Thêm thông báo hiển thị số thứ tự của cấu hình
                newDetail.innerHTML = `
                    <h4>Thêm cấu hình thứ ${detailIndex + 1}</h4>
                    <div class="form-group">
                        <label for="color">Màu Sắc</label>
                        <input type="text" name="product_details[${detailIndex}][color]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="size">Kích Thước</label>
                        <input type="text" name="product_details[${detailIndex}][size]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ram">RAM</label>
                        <input type="number" name="product_details[${detailIndex}][ram]" class="form-control" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="storage">Bộ Nhớ</label>
                        <input type="number" name="product_details[${detailIndex}][storage]" class="form-control" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" name="product_details[${detailIndex}][price]" class="form-control" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="stock">Tồn Kho</label>
                        <input type="number" name="product_details[${detailIndex}][stock]" class="form-control" required min="0">
                    </div>
                `;

                // Thêm phần tử mới vào danh sách cấu hình sản phẩm
                document.getElementById('product-details').appendChild(newDetail);

                // Tăng chỉ số của cấu hình
                detailIndex++;
            });
        </script>

    </div>
@endsection
