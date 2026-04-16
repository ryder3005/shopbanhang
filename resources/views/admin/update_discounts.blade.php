@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <h5 class="card-header">Chỉnh sửa mã giảm giá</h5>
            <div class="card-body">
                <form role="form" action="{{ route('discounts.update', $discount->DiscountID) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Sử dụng phương thức PUT -->

                    <!-- Mã giảm giá -->
                    <div>
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" name="code" 
                               value="{{ $discount->code }}" required>
                    </div>

                    <!-- Số tiền giảm giá -->
                    <div>
                        <label for="amount" class="form-label">Số tiền giảm giá</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" 
                               value="{{ $discount->amount }}" required>
                    </div>

                    <!-- Loại giảm giá -->
                    <div>
                        <label for="type" class="form-label">Loại giảm giá</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="fixed" {{ $discount->type === 'fixed' ? 'selected' : '' }}>Cố định</option>
                            <option value="percent" {{ $discount->type === 'percent' ? 'selected' : '' }}>Phần trăm</option>
                        </select>
                    </div>

                    <!-- Ngày bắt đầu -->
                    <div>
                        <label for="start_date" class="form-label">Ngày bắt đầu</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" 
                               value="{{ $discount->start_date ? date('Y-m-d\TH:i', strtotime($discount->start_date)) : '' }}">
                    </div>

                    <!-- Ngày kết thúc -->
                    <div>
                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" 
                               value="{{ $discount->end_date ? date('Y-m-d\TH:i', strtotime($discount->end_date)) : '' }}">
                    </div>

                    <!-- Giới hạn sử dụng -->
                    <div>
                        <label for="usage_limit" class="form-label">Giới hạn số lần sử dụng</label>
                        <input type="number" class="form-control" id="usage_limit" name="usage_limit" 
                               value="{{ $discount->usage_limit }}">
                    </div>

                    <!-- Trạng thái -->
                    <div>
                        <label for="is_active" class="form-label">Trạng thái</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{ $discount->is_active ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ !$discount->is_active ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                    <br>

                    <!-- Nút cập nhật -->
                    <button type="submit" class="btn btn-info">Cập nhật mã giảm giá</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
