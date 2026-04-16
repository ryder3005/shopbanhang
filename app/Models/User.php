<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'UserID';

    // Nếu bạn sử dụng Laravel 8 trở lên, hãy đảm bảo các thuộc tính của model tương ứng với các cột trong bảng
    protected $fillable = [
        'Email',
        'Password',
        'FullName',
        'Address',
        'PhoneNumber',
        'Role',
    ];

    // Tùy chọn: Thêm thuộc tính để ẩn Password và Timestamp nếu cần
    protected $hidden = [
        'Password',
    ];

    public $timestamps = true; // nếu bạn muốn sử dụng timestamps
}
