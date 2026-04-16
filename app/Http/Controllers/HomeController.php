<?php

namespace App\Http\Controllers;

// use Illuminate\Container\Attributes\Auth;

use App\Models\Product;
use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

session_start();
class HomeController extends Controller
{

    public function index()
    {
        // return getenv('MAIL_FROM_ADDRESS');
        // return url()->previous();
        $products = DB::table('products')
                    ->orderBy('ReleaseDate', 'desc') // Sắp xếp theo ReleaseDate giảm dần
                    ->limit(10)                      // Lấy tối đa 10 sản phẩm
                    ->get();


        // Duyệt qua từng sản phẩm và lấy hình ảnh
        foreach ($products as $product) {
            // Lấy URL hình ảnh đầu tiên liên quan đến product_id từ bảng 'product_images'
            $image = DB::table('product_images')
                ->where('product_id', $product->product_id)
                ->where('type_image', 'cover')
                ->value('image_url');  // Chỉ lấy cột 'image_url' đầu tiên
            $brand_name = DB::table('tbl_brand_product')
                ->where('brand_id', $product->brands_id)
                ->value('brand_name');
            // Gán URL hình ảnh cho thuộc tính 'image' của sản phẩm
            $product_details = DB::table('product_details')
                ->where('product_id', $product->product_id)
                ->get();

            $min_price = $product_details->min('price');
            // return $min_price;
            $product->image = $image;
            $product->brand_name = $brand_name;
            $product->min_price = $min_price;
            $product->details = $product_details;
        }
        
        // return $products;
        if (Auth::check()) {
            $user = Auth::user();
            $cartCount = DB::table('cartitems')
                ->where('UserID', $user->UserID)
                ->count();
            session()->put('cart_count', $cartCount);
        }
        // return $products;
        return view('frontendpage.homepage')->with("products", $products);
    }
    public function search(Request $request){
        $query = $request->input('search'); // Lấy từ khóa tìm kiếm từ input

        // Tìm kiếm trong bảng 'products' theo tên
        $products = Product::where('product_name', 'LIKE', "%{$query}%")->get();
        foreach ($products as $product) {
            // Lấy URL hình ảnh đầu tiên liên quan đến product_id từ bảng 'product_images'
            $image = DB::table('product_images')
                ->where('product_id', $product->product_id)
                ->where('type_image', 'cover')
                ->value('image_url');  // Chỉ lấy cột 'image_url' đầu tiên
            $brand_name = DB::table('tbl_brand_product')
                ->where('brand_id', $product->brands_id)
                ->value('brand_name');
            // Gán URL hình ảnh cho thuộc tính 'image' của sản phẩm
            $product_details = DB::table('product_details')
                ->where('product_id', $product->product_id)
                ->get();

            $min_price = $product_details->min('price');
            // return $min_price;
            $product->image = $image;
            $product->brand_name = $brand_name;
            $product->min_price = $min_price;
            $product->details = $product_details;
        }
        // Trả về view với kết quả tìm kiếm
        // return $products;
        return view('frontendpage.product_search')->with('products',$products);
    }
    public function listproduct(Request $request){
        $products = DB::table('products')
                    ->orderBy('ReleaseDate', 'desc') // Sắp xếp theo ReleaseDate giảm dần
                    ->limit(10)                      // Lấy tối đa 10 sản phẩm
                    ->get();


        // Duyệt qua từng sản phẩm và lấy hình ảnh
        foreach ($products as $product) {
            // Lấy URL hình ảnh đầu tiên liên quan đến product_id từ bảng 'product_images'
            $image = DB::table('product_images')
                ->where('product_id', $product->product_id)
                ->where('type_image', 'cover')
                ->value('image_url');  // Chỉ lấy cột 'image_url' đầu tiên
            $brand_name = DB::table('tbl_brand_product')
                ->where('brand_id', $product->brands_id)
                ->value('brand_name');
            // Gán URL hình ảnh cho thuộc tính 'image' của sản phẩm
            $product_details = DB::table('product_details')
                ->where('product_id', $product->product_id)
                ->get();

            $min_price = $product_details->min('price');
            // return $min_price;
            $product->image = $image;
            $product->brand_name = $brand_name;
            $product->min_price = $min_price;
            $product->details = $product_details;
        }
        
        // return $products;
        if (Auth::check()) {
            $user = Auth::user();
            $cartCount = DB::table('cartitems')
                ->where('UserID', $user->UserID)
                ->count();
            session()->put('cart_count', $cartCount);
        }
        // return $products;
        return view('frontendpage.product_page')->with("products", $products);
    }
    public function update_cart(Request $request)
    {

        // return $request;
        $cartItems = $request->num_product; // Lấy dữ liệu giỏ hàng từ request
        // return $cartItems;
        foreach ($cartItems as $ProductDetailID  => $Quantity) {
            $user = Auth::user()->UserID;
            DB::table('cartitems')
                ->where('ProductDetailID', $ProductDetailID) // `id` là ID của dòng giỏ hàng
                ->where('UserID', $user)
                ->update(['Quantity' => $Quantity]);
        }
        session()->forget('DiscountID');
        session()->forget('code');
        session()->forget('discounted_total');
        if ($request->address_option == 'new') {
            session()->put('Province', $request->city);
            session()->put('District', $request->district);
            session()->put('Ward', $request->ward);
            session()->put('Street', $request->Address);
        } else {
            $user = Auth::user();

            session()->put('Province', $user->City);
            session()->put('District', $user->District);
            session()->put('Ward', $user->Ward);
            session()->put('Street', $user->Address);
        }
        session()->put('address_option', $request->address_option);
        if ($request->code) {
            $discounts = DB::table('discounts')
                ->where('code', $request->code)
                ->first();
            if ($discounts) {
                session()->put('code', $request->code);
                session()->put('DiscountID', $discounts->DiscountID);
                return redirect()->back()->with('success', 'Giỏ hàng và mã giảm giá đã được cập nhật.');
            }

            return redirect()->back()->with('error', 'Mã giảm giá không đúng');
        }



        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật.');
    }
    public function showproduct( $id)
    {
        // session()->
        $detail_id = DB::table('product_details')->where('product_id', $id)->first();
        // return  [
        //     'product_id' => $id,
        //     'detail_id' => $detail_id->ProductDetailID,
        // ];
        if (!$detail_id) {
            return redirect()->route('home')->with('error', 'Sản phẩm không có chi tiết!');
        }
        return redirect()->route('home.detail', [
            'product_id' => $id,
            'detail_id' => $detail_id->ProductDetailID,
        ]);
    }
    public function showdetail( $id,  $detail_id)
    {

        $product = DB::table('products')->where('product_id', $id)->first();
        $product_details = DB::table('product_details')
            ->where('product_id', $product->product_id)
            ->get();
        $product->details = $product_details;
        $images = DB::table('product_images')
            ->where('product_id', $product->product_id)
            ->pluck('image_url');
        $pickproduct_details = DB::table('product_details')
            ->where('ProductDetailID', $detail_id)
            ->first();
        session()->put('SelectStorageCapacity', $pickproduct_details->StorageCapacity);
        session()->put('SelectRAM', $pickproduct_details->RAM);
        session()->put('SelectColor', $pickproduct_details->Color);
        session()->put('SelectProductDetailID', $detail_id);

        $product->images = $images;
        // Điều hướng về trang danh sách với thông báo thành công
        // return $product;
        session()->put("product", $product);
        // return $product;
        return view('frontendpage.product-detail')->with("product", $product);
    }
    public function addToCart(Request $request)
    {
        // return request();
        if (Auth::check()) {
            $user = Auth::user();

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng hay chưa
            $existingItem = DB::table('cartitems')
                ->where('product_id', $request->product_id)
                ->where('ProductDetailID', $request->ProductDetailID)
                ->where('UserID', $user->UserID)
                ->first();

            if ($existingItem) {
                // Nếu sản phẩm đã tồn tại, tăng số lượng
                DB::table('cartitems')
                    ->where('product_id', $request->product_id)
                    ->where('ProductDetailID', $request->ProductDetailID)
                    ->where('UserID', $user->UserID)
                    ->increment('Quantity', $request->num_product);
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
                DB::table('cartitems')->insert([
                    'product_id' => $request->product_id,
                    'ProductDetailID' => $request->ProductDetailID,
                    'Quantity' => $request->num_product,
                    'UserID' => $user->UserID,
                ]);
            }
            if (Auth::check()) {
                $user = Auth::user();
                $cartCount = DB::table('cartitems')
                    ->where('UserID', $user->UserID)
                    ->count();
                session()->put('cart_count', $cartCount);
            }
            session()->put('success', "Sản phẩm đã được thêm vào giỏ hàng");
            return redirect()->back();
        }

        // Lưu URL hiện tại vào session nếu chưa đăng nhập
        session()->put('url.intended', url()->previous());
        return redirect()->route('user.loginpage');
    }
    public function deleteCart($ProductDetailID)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Tìm kiếm sản phẩm trong giỏ hàng của người dùng
            $existingItem = DB::table('cartitems')
                ->where('ProductDetailID', $ProductDetailID)
                ->where('UserID', $user->UserID)
                ->first();

            if ($existingItem) {
                // Nếu sản phẩm tồn tại, thực hiện xóa
                DB::table('cartitems')
                    ->where('ProductDetailID', $ProductDetailID)
                    ->where('UserID', $user->UserID)
                    ->delete();

                // Cập nhật số lượng sản phẩm trong giỏ hàng vào session
                $cartCount = DB::table('cartitems')
                    ->where('UserID', $user->UserID)
                    ->count();
                session()->put('cart_count', $cartCount);

                // Thông báo thành công
                session()->put('success', "Sản phẩm đã được xóa khỏi giỏ hàng");
            } else {
                // Nếu sản phẩm không tồn tại trong giỏ hàng
                session()->put('error', "Sản phẩm không tồn tại trong giỏ hàng");
            }

            return redirect()->back();
        }

        // Lưu URL hiện tại vào session nếu chưa đăng nhập
        session()->put('url.intended', url()->previous());
        return redirect()->route('user.loginpage');
    }


    public function alreadylogin()
    {
        if (!Auth::check()) {
            return redirect()->route('user.loginpage');
        }
    }
    public function trangdangki()
    {
        return view('frontendpage.register');
    }
    public function forgetpage()
    {
        return view('frontendpage.forgetpass');
    }
    public function forgetverification(){
       
        return view('frontendpage.forgetvertifycode');
    }
    public function xacnhanma(Request $request){

        if ($request->verificationCode==session('verificationCode')){
           
            $user=DB::table('users')->where('Email',session('forgetmail'))->first();
            $user->Password=Hash::make($request->newpass);
            return redirect()->route('user.login');
        }
        return back();
    }
    public function register(Request $request)
    {
        // return $request;
        $verificationCode = rand(100000, 999999);
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = getenv('MAIL_FROM_ADDRESS');                     //SMTP username
            $mail->Password   =  getenv('MAIL_PASSWORD');                               //SMTP password

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_USERNAME'));
            $mail->addAddress($request->email, $request->FullName);     //Add a recipient

            $mail->CharSet = 'UTF-8';
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Mã xác nhận tài khoản';
            $mail->Body    = "Mã xác thực của bạn là <b>$verificationCode</b>";

            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        session([
            'email' => $request->email,
            'FullName' => $request->FullName,
            'Address' => $request->Address,
            'PhoneNumber' => $request->PhoneNumber,
            'verificationCode' => $verificationCode,
            'city' => $request->city,
            'district' => $request->district,
            'ward' => $request->ward,
            'Password' => Hash::make($request->Password),
        ]);
        // return $request;
        // $user = new User();
        // $user->Email = $request->email;
        // $user->Password = Hash::make($request->Password); 
        // $user->FullName = $request->FullName;
        // $user->Address = $request->Address;
        // $user->PhoneNumber = $request->PhoneNumber;
        // $user->save();
        return view('frontendpage.registervertifycode')->with('success', 'Đăng ký thành công!');
    }
    public function forgetsendmail(Request $request)
    {
        // return $request;
        $verificationCode = rand(100000, 999999);
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = getenv('MAIL_FROM_ADDRESS');                     //SMTP username
            $mail->Password   =  getenv('MAIL_PASSWORD');                               //SMTP password

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_USERNAME'));
            $mail->addAddress($request->email);     //Add a recipient

            $mail->CharSet = 'UTF-8';
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Mã xác nhận đổi mật khẩu';
            $mail->Body    = "Mã xác thực của bạn là <b>$verificationCode</b>";
            // return $mail;
            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        session([
            'forgetmail' => $request->email,
            'verificationCode'=>$verificationCode
            
        ]);
        // return $request;
        // $user = new User();
        // $user->Email = $request->email;
        // $user->Password = Hash::make($request->Password); 
        // $user->FullName = $request->FullName;
        // $user->Address = $request->Address;
        // $user->PhoneNumber = $request->PhoneNumber;
        // $user->save();
        return view('frontendpage.forgetvertifycode')->with('success', 'Đăng ký thành công!');
    }
    public function verificationpage() {}
    public function verification(Request $request)
    {
        $verificationCode = $request->verificationCode;

        $verificationCodetrue = session('verificationCode');
        $email = session('email');
        $FullName = session('FullName');
        $Address = session('Address');
        $PhoneNumber = session('PhoneNumber');
        $Password = session('Password');
        $city = session('city');
        $district = session('district');
        $ward = session('ward');


        if ($verificationCodetrue == $verificationCode) {
            $user = new User();
            $user->Email = $email;
            $user->Password = $Password;
            $user->FullName = $FullName;
            $user->Address = $Address;
            $user->PhoneNumber = $PhoneNumber;
            $user->city = $city;
            $user->district = $district;
            $user->ward = $ward;
            $user->save();
        }
        return Redirect()->route('user.login')->with('success', 'Xác thực thành công!');
    }
    public function loginpage(Request $request)

    {
        Redirect::setIntendedUrl(url()->previous());

        return view('frontendpage.login');
    }
    public function login(Request $request)
    {

        // return Hash::make('pass');
        $user = User::where('Email', $request->Email)->first();
        
        // return $request;
        if ($user && Hash::check($request->Password, $user->Password)) {
            // Đăng nhập thành công
            Auth::login($user);
            // ve trang truoc
            if($user->Role=="admin"){
                return redirect()->route('admin.dashboard');
            }
            // return $user;
            return redirect(session()->get('url.intended', '/'));
        } else {
            // Đăng nhập không thành công
            // return $user->Password;
            Log::info('Đăng nhập không thành công cho: ' . $request->Email);
            return view('frontendpage.login');
        }
    }
    public function logout(Request $request)
    {
        // Đăng xuất người dùng hiện tại
        Auth::logout();

        // Xóa session và CSRF token để bảo mật
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Chuyển hướng về trang chủ hoặc trang đăng nhập
        return redirect()->back();
    }
    public function shoppingcart(Request $request)
    {

        // $eeee=Product::firstWhere('product_id',"1");
        
        // return $eeee->brand;
        // return json_decode($response, true);;
        // return $request;
        // return session()->all();
        if (Auth::check()) {

            $user = Auth::user();
            $cart = DB::table('cartitems')
                ->where('UserID', $user->UserID)
                ->get();
            $totalprice = 0;
            foreach ($cart as $i) {
                $image = DB::table('product_images')
                    ->where('product_id', $i->product_id)
                    ->value('image_url');
                $i->image = $image;
                $name = DB::table('products')->where('product_id', $i->product_id)->value('product_name');
                $i->name = $name;
                $details = DB::table('product_details')
                    ->where('ProductDetailID', $i->ProductDetailID)
                    ->first();

                $i->detail = $details;
                if ($i->detail) {
                    $i->total = $i->Quantity * $i->detail->Price; // Lấy giá trị Price từ đối tượng $i->detail
                    $totalprice += $i->total;
                } else {
                    $i->total = 0; // Đặt giá trị mặc định nếu không tìm thấy detail
                }
            }
            $total = $totalprice;
            $DiscountID = session()->get('DiscountID');
            if ($DiscountID) {

                $discounts = DB::table('discounts')
                    ->where('DiscountID', $DiscountID)
                    ->first();


                if ($discounts) {
                    $currentDate = now();
                    if ($discounts->start_date && $discounts->end_date) {
                        if ($currentDate->between($discounts->start_date, $discounts->end_date)) {
                            if ($discounts->used < $discounts->usage_limit) {
                                if ($discounts->type == 'percent') {
                                    $neg = $totalprice * $discounts->amount / 100;
                                    session(['amount' => $discounts->amount . '%']);
                                } else {
                                    $neg = $totalprice - $discounts->amount;
                                    session(['amount' =>$discounts->amount . ' VND']);
                                }
                                session()->put('discounted_total', $neg);
                                $total = $total - $neg;
                            } else {
                                // Nếu số lượt sử dụng đã hết
                                // session()->flash();
                                return redirect()->back()->with('error', 'Mã giảm giá đã hết lượt sử dụng');
                            }
                        } else {
                            return redirect()->back()->with('error', 'Mã giảm giá không còn hiệu lực');
                        }
                    }
                } else {
                    return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ');
                }
            }

            if (session()->get('address_option') === 'new') {

                $data = array(
                    "pick_province" => getenv('PICKProvince'),
                    "pick_district" => getenv('PICKdistrict'),
                    "province" => session()->get('Province'),
                    "district" => session()->get('District'),
                    "address" => session()->get('Ward') . ' ' . session()->get('Street'),
                    "weight" => 1000,
                    "value" => $totalprice,
                    "deliver_option" => "none",
                );
            } else {
                $data = array(
                    "pick_province" => getenv('PICKProvince'),
                    "pick_district" =>getenv('PICKdistrict'),
                    "province" => $user->City,
                    "district" => $user->District,
                    "address" => $user->Ward . ' ' . $user->Address,
                    "weight" => 1000,
                    "value" => $totalprice,
                    "deliver_option" => "none",
                );
                $user = Auth::user();
                session()->put('Province', $user->City);
                session()->put('District', $user->District);
                session()->put('Ward', $user->Ward);
                session()->put('Street', $user->Address);
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Token: " . getenv("TokenGHTK"),
                ),
            ));

            $response = curl_exec($curl);

            // return 
            $fee = json_decode($response, true)['fee']['fee'];
            // return $fee;
            $total = $total + $fee;

            session()->put("total", $total);
            session()->put("ShippingFee", $fee);
            // return $totalprice;
            session()->put("totalprice", $totalprice);
            // return $totalprice;
            // return $cart;
            // return session()->all();
            return view('frontendpage.shoppingcart')
                ->with("cart", $cart)
                ->with("totalprice", $totalprice)
                ->with("total", $total)
            ;
        }
    }
    public function checkout(Request $request)
    {
        // return session()->all();
        $cart = $request->input('num_product', []);
        // return $request;
        $total = session('total');
        $totalprice = session('totalprice');

        $DiscountID = session('DiscountID');
        $discounted_total = session('discounted_total', 0);

        // alreadylogin();
        if (Auth::check()) {
            $user = Auth::user();
            $OrderID = DB::table('orders')->insertGetId([
                'UserID' => $user->UserID,
                'TotalPrice' => $totalprice,
                'DiscountID' => $DiscountID,
                'DiscountAmount' => $discounted_total,
                'FinalPrice' => $total,
                'Province' => session('Province'),
                'District' => session('District'),
                'Ward' => session('Ward'),
                'Street' => session('Street'),
                'ShippingFee' => session('ShippingFee'),
            ]);
            DB::table('discounts')
                ->where('DiscountID', $DiscountID)
                ->increment('used', 1);


            foreach ($cart as $ProductDetailID => $Quantity) {
                $product_details = DB::table('product_details')
                    ->where('ProductDetailID', $ProductDetailID)
                    ->first();
                $price = $product_details->Price;
                $product_id = $product_details->product_id;

                DB::table('orderdetails')->insert([

                    'OrderID' => $OrderID,
                    'product_id' => $product_id,
                    'ProductDetailID' => $ProductDetailID,
                    'Quantity' => $Quantity,
                    'Price' => $price
                ]);
                DB::table('products')
                    ->where('product_id', $product_id)
                    ->decrement('in_stock', $Quantity);
            }
            DB::table('cartitems')
                ->where('UserID', $user->UserID)
                ->delete();
            // session()->forget('cart');
            session()->forget('total');
            session()->forget('totalprice');
            session()->forget('DiscountID');
            session()->forget('discounted_total');
            session()->forget('code');
            session()->forget('amount');
            session()->put('cart_count', 0);
            // session()->put('success', "Đặt hàng thành công");
            return redirect()->route('user.order')->with('success', "Đặt hàng thành công");
        }
    }
    public function profile()
    {
        $user = Auth::user();
        // return $user;
        return view('frontendpage.user_profile')->with('user', $user);
    }
    public function detailorder(string $OrderID)
    {
        $user = Auth::user();
        $order = DB::table('orders')
            ->where('UserID', $OrderID)
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
        // foreach ($orders as $order) {
        //     // Lấy các chi tiết đơn hàng dựa trên OrderID
        //     $details = DB::table('orderdetails')
        //         ->where('OrderID', $order->OrderID)
        //         ->get();

        //     $images = []; // Mảng lưu các URL hình ảnh

        //     foreach ($details as $detail) {
        //         // Lấy hình ảnh đầu tiên của sản phẩm trong orderdetails
        //         $image = DB::table('product_images')
        //             ->where('product_id', $detail->product_id)
        //             ->pluck('image_url')
        //             ->first();


        //         if ($image) {
        //             $images[] = $image; // Thêm hình ảnh vào mảng
        //         }
        //     }
        //     $user = DB::table('users')
        //         ->where('UserID', $order->UserID)
        //         ->first();
        //     // Gắn mảng hình ảnh vào đối tượng đơn hàng
        //     $order->images = $images;
        //     $order->FullName = $user->FullName;
        //     $order->Email = $user->Email;

        //     $order->Address = implode(', ', array_filter([
        //         $user->Address,
        //         $user->Ward,
        //         $user->District,
        //         $user->City
        //     ]));
        // }
        // return $user;
        // return $orders;
        return view('frontendpage.user_detailorders')->with('user', $user)->with('order', $order);
    }
    public function listorder()
    {
        $user = Auth::user();
        $orders = DB::table('orders')
            ->where('UserID', $user->UserID)
            ->get();
        // foreach ($orders as $order) {
        //     // Lấy các chi tiết đơn hàng dựa trên OrderID
        //     $details = DB::table('orderdetails')
        //         ->where('OrderID', $order->OrderID)
        //         ->get();

        //     $images = []; // Mảng lưu các URL hình ảnh

        //     foreach ($details as $detail) {
        //         // Lấy hình ảnh đầu tiên của sản phẩm trong orderdetails
        //         $image = DB::table('product_images')
        //             ->where('product_id', $detail->product_id)
        //             ->pluck('image_url')
        //             ->first();


        //         if ($image) {
        //             $images[] = $image; // Thêm hình ảnh vào mảng
        //         }
        //     }
        //     $user = DB::table('users')
        //         ->where('UserID', $order->UserID)
        //         ->first();
        //     // Gắn mảng hình ảnh vào đối tượng đơn hàng
        //     $order->images = $images;
        //     $order->FullName = $user->FullName;
        //     $order->Email = $user->Email;

        //     $order->Address = implode(', ', array_filter([
        //         $user->Address,
        //         $user->Ward,
        //         $user->District,
        //         $user->City
        //     ]));
        // }
        // return $user;
        // return $orders;
        return view('frontendpage.user_orders')->with('user', $user)->with('orders', $orders);
    }
}
