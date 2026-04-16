<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'tbl_category_product';

    // Nếu không muốn sử dụng timestamps tự động, bạn có thể bỏ qua thuộc tính này
    public $timestamps = true;

    // Các thuộc tính có thể được gán giá trị thông qua Eloquent
    protected $fillable = [
        'category_name',
        'category_desc',
        'category_status',
    ];

    // Nếu bạn muốn bảo vệ các thuộc tính không được gán giá trị, có thể sử dụng $guarded
    // protected $guarded = ['category_id']; // category_id sẽ không thể gán giá trị từ phía người dùng
}
