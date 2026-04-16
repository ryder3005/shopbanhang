<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;
use Illuminate\Support\Facades\Session;

session_start();
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả sản phẩm
        $products = DB::table('products')->get();

        // Duyệt qua từng sản phẩm và lấy hình ảnh
        foreach ($products as $product) {
            // Lấy tất cả URL hình ảnh liên quan đến product_id từ bảng 'product_images'
            $images = DB::table('product_images')
                ->where('product_id', $product->product_id)
                ->pluck('image_url');  // Chỉ lấy cột 'image_url'

            // Gán mảng hình ảnh cho thuộc tính 'images' của sản phẩm
            $product->images = $images;
        }

        // Trả về danh sách sản phẩm với hình ảnh kèm theo
        // return $products;

        return view('admin.all_product')->with('all_product', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_product')
            ->with('all_brand_product', DB::table('tbl_brand_product')->get())
            ->with('all_category_product', DB::table('tbl_category_product')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_description'] = $request->product_description;
        $data['brands_id'] = $request->brands_id;
        $data['category_id'] = $request->category_id;
        $data['in_stock'] = $request->category_id;

        $data['OperatingSystem'] = $request->OperatingSystem;
        $data['CPU'] = $request->CPU;
        $data['CPU_Speed'] = $request->CPU_Speed;
        $data['GPU'] = $request->GPU;
        $data['RearCameraResolution'] = $request->RearCameraResolution;
        $data['RearCameraFeatures'] = $request->RearCameraFeatures;
        $data['FrontCameraResolution'] = $request->FrontCameraResolution;
        $data['FrontCameraFeatures'] = $request->FrontCameraFeatures;
        $data['DisplayTechnology'] = $request->DisplayTechnology;
        $data['DisplayResolution'] = $request->DisplayResolution;
        $data['DisplaySize'] = $request->DisplaySize;
        $data['RefreshRate'] = $request->RefreshRate;
        $data['MaxBrightness'] = $request->MaxBrightness;
        $data['DisplayGlass'] = $request->DisplayGlass;
        $data['BatteryCapacity'] = $request->BatteryCapacity;
        $data['BatteryType'] = $request->BatteryType;
        $data['MaxChargingSupport'] = $request->MaxChargingSupport;
        $data['ChargerIncluded'] = $request->ChargerIncluded;
        $data['BatteryTechnology'] = $request->BatteryTechnology;
        $data['AdvancedSecurity'] = $request->AdvancedSecurity;
        $data['SpecialFeatures'] = $request->SpecialFeatures;
        $data['WaterDustResistance'] = $request->WaterDustResistance;
        $data['Recording'] = $request->Recording;
        $data['MobileNetwork'] = $request->MobileNetwork;
        $data['SIMSupport'] = $request->SIMSupport;
        $data['WifiSupport'] = $request->WifiSupport;
        $data['GPS'] = $request->GPS;
        $data['Bluetooth'] = $request->Bluetooth;
        $data['ChargingPort'] = $request->ChargingPort;
        $data['HeadphoneJack'] = $request->HeadphoneJack;
        $data['OtherConnections'] = $request->OtherConnections;
        $data['DesignType'] = $request->DesignType;
        $data['Material'] = $request->Material;
        $data['Dimensions'] = $request->Dimensions;
        $data['Weight'] = $request->Weight;
        $data['ReleaseDate'] = $request->ReleaseDate;
        //thieu stock
        // Lưu sản phẩm và lấy ID của sản phẩm vừa tạo
        $product_id = DB::table('products')->insertGetId($data);
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validations as needed
        ]);
        $coverImage = $request->file('cover_image');

        if (!is_null($coverImage)) {
            // Khởi tạo mảng lưu thông tin ảnh
            $imgData = [];
            $imgData['product_id'] = $product_id;

            // Lấy tên file gốc và đuôi file
            $originalName = pathinfo($coverImage->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $coverImage->getClientOriginalExtension();

            // Tạo tên file mới với timestamp để tránh trùng lặp
            $newFileName = $originalName . '_' . time() . '.' . $extension;

            $path = $coverImage->storeAs('uploads', $newFileName, 'public');
            $imgData['image_url'] = $path;
            $imgData['type_image'] = 'cover';

            // Lưu thông tin ảnh vào bảng 'product_images'
            DB::table('product_images')->insert($imgData);
        }

        $uploadedImages = $request->file('images');

        if (!is_null($uploadedImages) && count($uploadedImages) > 0) {
            foreach ($uploadedImages as $image) {
                // Khởi tạo mảng tạm để lưu thông tin ảnh
                $img_temp = array();
                $img_temp['product_id'] = $product_id;

                // Lấy tên file gốc và đuôi file
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                // Tạo tên file mới với timestamp để tránh trùng lặp
                $newFileName = $originalName . '_' . time() . '.' . $extension;
                // Lưu file ảnh vào thư mục 'uploads' trong storage với quyền 'public'
                $path = $image->storeAs('uploads', $newFileName, 'public');
                $img_temp['image_url'] = $path;
                // Lưu thông tin ảnh vào bảng 'product_images'
                DB::table('product_images')->insert($img_temp);
            }
        }



        // Bước 3: Lưu thông tin cấu hình sản phẩm (RAM, Kích thước, màu sắc, etc.)
        foreach ($request->input('product_details') as $detail) {
            // Thêm từng chi tiết vào mảng $details
            $details[] = [
                'product_id' => $product_id,
                'Color' => $detail['Color'],
                'RAM' => $detail['RAM'],
                'StorageCapacity' => $detail['StorageCapacity'],
                'Price' => $detail['Price']
            ];
        }
        DB::table('product_details')->insert($details);
        Session::put('message', 'Thêm sản phẩm thành công');
        return redirect()->route("products.add");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //pp
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = DB::table('products')
            ->where('product_id', $id)  // Lấy tối đa 10 sản phẩm
            ->first();
        $product->detail = DB::table('product_details')
            ->where('product_id', $id)  // Lấy tối đa 10 sản phẩm
            ->get();
        // return $product;
        return view('admin.update_product')->with('product', $product)
            ->with('all_brand_product', DB::table('tbl_brand_product')->get())
            ->with('all_category_product', DB::table('tbl_category_product')->get());
    }
    public function save(Request $request, string $id)
    {
        $product = DB::table('products')->where('product_id', $id)->first();
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Chuẩn bị dữ liệu để cập nhật
        $data = [
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'brands_id' => $request->brands_id,
            'category_id' => $request->category_id,
            'in_stock' => $request->in_stock,
            'OperatingSystem' => $request->OperatingSystem,
            'CPU' => $request->CPU,
            'CPU_Speed' => $request->CPU_Speed,
            'GPU' => $request->GPU,
            'RearCameraResolution' => $request->RearCameraResolution,
            'RearCameraFeatures' => $request->RearCameraFeatures,
            'FrontCameraResolution' => $request->FrontCameraResolution,
            'FrontCameraFeatures' => $request->FrontCameraFeatures,
            'DisplayTechnology' => $request->DisplayTechnology,
            'DisplayResolution' => $request->DisplayResolution,
            'DisplaySize' => $request->DisplaySize,
            'RefreshRate' => $request->RefreshRate,
            'MaxBrightness' => $request->MaxBrightness,
            'DisplayGlass' => $request->DisplayGlass,
            'BatteryCapacity' => $request->BatteryCapacity,
            'BatteryType' => $request->BatteryType,
            'MaxChargingSupport' => $request->MaxChargingSupport,
            'ChargerIncluded' => $request->ChargerIncluded,
            'BatteryTechnology' => $request->BatteryTechnology,
            'AdvancedSecurity' => $request->AdvancedSecurity,
            'SpecialFeatures' => $request->SpecialFeatures,
            'WaterDustResistance' => $request->WaterDustResistance,
            'Recording' => $request->Recording,
            'MobileNetwork' => $request->MobileNetwork,
            'SIMSupport' => $request->SIMSupport,
            'WifiSupport' => $request->WifiSupport,
            'GPS' => $request->GPS,
            'Bluetooth' => $request->Bluetooth,
            'ChargingPort' => $request->ChargingPort,
            'HeadphoneJack' => $request->HeadphoneJack,
            'OtherConnections' => $request->OtherConnections,
            'DesignType' => $request->DesignType,
            'Material' => $request->Material,
            'Dimensions' => $request->Dimensions,
            'Weight' => $request->Weight,
            'ReleaseDate' => $request->ReleaseDate,
        ];

        // Cập nhật thông tin sản phẩm
        DB::table('products')->where('product_id', $id)->update($data);

        // Cập nhật ảnh bìa
        $coverImage = $request->file('cover_image');
        if (!is_null($coverImage)) {
            // Xóa ảnh bìa cũ
            DB::table('product_images')->where('product_id', $id)->where('type_image', 'cover')->delete();

            // Lưu ảnh bìa mới
            $originalName = pathinfo($coverImage->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $coverImage->getClientOriginalExtension();
            $newFileName = $originalName . '_' . time() . '.' . $extension;
            $path = $coverImage->storeAs('uploads', $newFileName, 'public');

            DB::table('product_images')->insert([
                'product_id' => $id,
                'image_url' => $path,
                'type_image' => 'cover',
            ]);
        }

        // Cập nhật ảnh khác
        $uploadedImages = $request->file('images');
        if (!is_null($uploadedImages) && count($uploadedImages) > 0) {
            // Xóa ảnh cũ
            DB::table('product_images')->where('product_id', $id)->whereNull('type_image')->delete();

            // Lưu ảnh mới
            foreach ($uploadedImages as $image) {
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $newFileName = $originalName . '_' . time() . '.' . $extension;
                $path = $image->storeAs('uploads', $newFileName, 'public');

                DB::table('product_images')->insert([
                    'product_id' => $id,
                    'image_url' => $path,
                ]);
            }
        }

        // Cập nhật chi tiết sản phẩm
        $details = [];
        foreach ($request->input('product_details') as $detail) {
            $details[] = [
                'product_id' => $id,
                'Color' => $detail['Color'],
                'RAM' => $detail['RAM'],
                'StorageCapacity' => $detail['StorageCapacity'],
                'Price' => $detail['Price'],
            ];
        }

        // Xóa chi tiết cũ và thêm mới
        DB::table('product_details')->where('product_id', $id)->delete();
        DB::table('product_details')->insert($details);
        return redirect()->route('products.all');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
