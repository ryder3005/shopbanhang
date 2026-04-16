<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();
class CategoryProductController extends Controller
{
    public function add_category_product()
    {
        return view('admin.add_category_product');
    }
    public function all_category_product()
    {


        return view('admin.all_category_product')->with('all_category_product', DB::table('tbl_category_product')->get());
    }
    
    public function save_category_product(Request $request)
    {
        // Tạo một mảng chứa dữ liệu từ request
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;

        // Chèn dữ liệu vào bảng tbl_category_product
        DB::table('tbl_category_product')->insert($data);
        $request->session()->put('message', "Thêm danh mục thành công");
        // Có thể thêm thông báo nếu cần
        return redirect('/add-category-product');
    }
    public function toggleCategoryStatus(Request $request)
    {
        try {
            // Xác thực dữ liệu
            $request->validate([
                'id' => 'required|integer',
                'status' => 'required|integer',
            ]);

            // Cập nhật trạng thái danh mục
            DB::table('tbl_category_product')
                ->where('category_id', $request->id)
                ->update(['category_status' => $request->status]);

            // Trả về phản hồi thành công
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Bắt lỗi và trả về phản hồi lỗi
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
    public function editCategory($id)
    {
        $category = DB::table('tbl_category_product')->where('category_id', $id)->first();
        return view('admin.update_category_product')->with('category', $category);
    }

    public function updateCategory(Request $request, $id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;

        DB::table('tbl_category_product')->where('category_id', $id)->update($data);
        return redirect()->route('category.edit', $id)->with('message', 'Category updated successfully!');
    }
    public function deleteCategory($id)
    {
        // Xóa danh mục theo ID
        DB::table('tbl_category_product')->where('category_id', $id)->delete();

        // Điều hướng về trang danh sách với thông báo thành công
        return redirect()->route('category.all')->with('success', 'Danh mục đã được xóa thành công!');
    }
}
