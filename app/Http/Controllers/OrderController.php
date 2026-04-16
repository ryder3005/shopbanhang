<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;
use Illuminate\Support\Facades\Session;

session_start();
class OrderController extends Controller
{
    public function showall()
    {
        // Lấy tất cả các đơn hàng
        $orders = DB::table('orders')->get();

        foreach ($orders as $order) {
            // Lấy các chi tiết đơn hàng dựa trên OrderID
            $details = DB::table('orderdetails')
                ->where('OrderID', $order->OrderID)
                ->get();

            $images = []; // Mảng lưu các URL hình ảnh

            foreach ($details as $detail) {
                // Lấy hình ảnh đầu tiên của sản phẩm trong orderdetails
                $image = DB::table('product_images')
                    ->where('product_id', $detail->product_id)
                    ->pluck('image_url')
                    ->first();


                if ($image) {
                    $images[] = $image; // Thêm hình ảnh vào mảng
                }
            }
            $user = DB::table('users')
                ->where('UserID', $order->UserID)
                ->first();
            // Gắn mảng hình ảnh vào đối tượng đơn hàng
            $order->images = $images;
            $order->FullName = $user->FullName;
            $order->Email = $user->Email;

            $order->Address = implode(', ', array_filter([
                $user->Address,
                $user->Ward,
                $user->District,
                $user->City
            ]));
        }
        // dd($orders);
        // Trả về view kèm dữ liệu
        return view('admin.all_order')->with('orders', $orders);
    }
    public function showdetail(string $OrderID)
    {

        $order = DB::table('orders')
            ->where('OrderID', $OrderID)
            ->first();



        $details = DB::table('orderdetails')
            ->where('OrderID', $OrderID)
            ->get();


        foreach ($details as $detail) {
            // Lấy hình ảnh đầu tiên của sản phẩm trong orderdetails
            $image = DB::table('product_images')
                ->where('product_id', $detail->product_id)
                ->pluck('image_url')
                ->first();
            $products  = DB::table('products')
                ->where('product_id', $detail->product_id)
                ->first();
            $product_details   = DB::table('product_details')
                ->where('ProductDetailID', $detail->ProductDetailID)
                ->first();

            $detail->image = $image;
            $detail->products = $products;
            $detail->product_details = $product_details;
        }
        $user = DB::table('users')
            ->where('UserID', $order->UserID)
            ->first();
        // Gắn mảng hình ảnh vào đối tượng đơn hàng
        $order->details = $details;
        $order->FullName = $user->FullName;
        $order->Email = $user->Email;

        $order->Address = implode(', ', array_filter([
            $user->Address,
            $user->Ward,
            $user->District,
            $user->City
        ]));
        // dd($order);
        return view('admin.detail_order')->with('order', $order);
    }
    public function updateOrderStatus(Request $request, $orderId)
    {
        // Cập nhật trạng thái đơn hàng qua DB query
        $status = $request->input('status');

        // Sử dụng DB để cập nhật trạng thái cho đơn hàng
        $updated = DB::table('orders')
            ->where('OrderID', $orderId)
            ->update(['Status' => $status]);

        // Kiểm tra xem cập nhật có thành công không
        if ($updated) {
            // Trả về thông báo thành công
            return redirect()->route('order.all', $orderId)->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
        }

        // Trường hợp không tìm thấy đơn hàng
        return redirect()->route('orders.all')->with('error', 'Không tìm thấy đơn hàng.');
    }
}
