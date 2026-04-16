<?php

namespace App\Http\Controllers;
use App\Http\Requests;
// use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

session_start();
class BrandController extends Controller
{
    // Hiển thị danh sách thương hiệu
    public function allBrandProduct() {
        $all_brand_product = DB::table('tbl_brand_product')->get();
        return view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
    }

    // Hiển thị form thêm thương hiệu
    public function addBrandProduct() {
        return view('admin.add_brand_product');
    }

    // Lưu thương hiệu mới
    public function saveBrandProduct(Request $request) {
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_status'] = $request->brand_status;

        DB::table('tbl_brand_product')->insert($data);
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand-product');
    }

    // Hiển thị form chỉnh sửa thương hiệu
    public function editBrandProduct($brand_id) {
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id', $brand_id)->first();
        return view('admin.update_brand_product')->with('brand', $edit_brand_product);
    }

    // Cập nhật thương hiệu
    public function updateBrandProduct(Request $request, $brand_id) {
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;

        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    // Xóa thương hiệu
    public function deleteBrandProduct($brand_id) {
        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
}
