<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

session_start();
class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        if(Auth::check()){
            $u=Auth::user();
            // return $u->role;
            // return $u;
            if ($u->Role=="admin"){
                
                return view('admin.dashboard');
            }
        }
        
        return redirect()-> route('user.loginpage');
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)->first();
        if ($result) {
            $request->session()->put('admin_name', $result->admin_name);
            $request->session()->put('admin_id', $result->admin_id);
            return  redirect('/dashboard');
        } else {
            $request->session()->put('message', 'Mật khẩu hoặc tài khoản không đúng');
            return  redirect('/admin');
        }
    }
    public function logout(Request $request)
    {
        session()->put('admin_name', null);
        session()->put('admin_name', null);
        return redirect('/admin');
    }
    public function listDiscounts()
    {
        // Lấy danh sách mã giảm giá từ cơ sở dữ liệu
        $discounts = DB::table('discounts')->get();
        // return compact('discounts');
        // Trả về view kèm dữ liệu
        return view('admin.all_discounts', compact('discounts'));
    }

    public function toggleDiscount()
    {
        // Lấy danh sách mã giảm giá từ cơ sở dữ liệu
        $discounts = DB::table('discounts')->get();
        // return compact('discounts');
        // Trả về view kèm dữ liệu
        return view('admin.all_discounts', compact('discounts'));
    }
    public function deleteDiscount()
    {
        // Lấy danh sách mã giảm giá từ cơ sở dữ liệu
        $discounts = DB::table('discounts')->get();
        // return compact('discounts');
        // Trả về view kèm dữ liệu
        return view('admin.all_discounts', compact('discounts'));
    }
    public function addDiscount()
    {
        // Lấy danh sách mã giảm giá từ cơ sở dữ liệu
        $discounts = DB::table('discounts')->get();
        // return compact('discounts');
        // Trả về view kèm dữ liệu
        return view('admin.add_discounts');
    }

    public function storeDiscount(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:discounts,code',
            'amount' => 'required|numeric',
            'type' => 'required|in:fixed,percent',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'required|boolean',
        ]);
        // return $request;
        $data = [
            'code' => $request->code,
            'amount' => $request->amount,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'usage_limit' => $request->usage_limit ?? null,
            'used' => 0, // Ban đầu chưa có lượt sử dụng nào
            'is_active' => $request->is_active
        ];

        // Sử dụng DB::insert() để thêm dữ liệu
        DB::table('discounts')->insert($data);

        // return redirect()->route('discounts.list')->with('success', 'Mã giảm giá đã được thêm thành công.');
        return view('admin.add_discounts');
    }

    public function editDiscount($DiscountID)
    {
        // Lấy danh sách mã giảm giá từ cơ sở dữ liệu
        $discount = DB::table('discounts')
            ->where('DiscountID', $DiscountID)
            ->first();
        // return $discounts;
        // return $discount;
        // Trả về view kèm dữ liệu
        return view('admin.update_discounts')->with("discount", $discount);
    }
    public function updateDiscount(Request $request, $DiscountID)
    {
        // Xác thực dữ liệu nhận được từ form
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:fixed,percent',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        // Cập nhật mã giảm giá trong cơ sở dữ liệu
        $update = DB::table('discounts')
            ->where('DiscountID', $DiscountID)
            ->update([
                'code' => $validated['code'],
                'amount' => $validated['amount'],
                'type' => $validated['type'],
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'usage_limit' => $validated['usage_limit'] ?? null,
                'is_active' => $validated['is_active'],
            ]);

        // Kiểm tra xem có bản ghi nào bị ảnh hưởng không (nếu không có bản ghi nào, có thể không tồn tại mã giảm giá)
        if ($update) {
            return redirect()->route('discounts.all')->with('success', 'Cập nhật mã giảm giá thành công!');
        } else {
            return redirect()->route('discounts.all')->with('error', 'Không tìm thấy mã giảm giá để cập nhật!');
        }
    }
}
