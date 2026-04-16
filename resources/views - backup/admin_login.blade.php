<!-- Thiết kế bởi W3layouts
Tác giả: W3layout
URL của tác giả: http://w3layouts.com
Giấy phép: Creative Commons Attribution 3.0 Unported
URL của giấy phép: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Mẫu web đáp ứng cho khách, Mẫu web Bootstrap, Mẫu web phẳng, Mẫu web tương thích Android, 
    Mẫu web tương thích Smartphone, thiết kế web miễn phí cho Nokia, Samsung, LG, SonyEricsson, Motorola" />
    <script type="application/x-javascript"> 
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
        function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css"/>
    <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet"> 
    <!-- //font-awesome icons -->
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
</head>
<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Đăng Nhập Ngay</h2>
            @php
                $message = Session::get('message');
                if ($message) {
                    echo '<div class="alert alert-danger">' . $message . '</div>';
                    Session::put('message', null);
                }
            @endphp
            <form action="{{url('/admin-dashboard')}}" method="post">
                @csrf
                <input type="email" class="ggg" name="admin_email" placeholder="EMAIL" required="">
                <input type="password" class="ggg" name="admin_password" placeholder="MẬT KHẨU" required="">
                <span><input type="checkbox" />Ghi Nhớ Tôi</span>
                <h6><a href="#">Quên Mật Khẩu?</a></h6>
                <div class="clearfix"></div>
                <input type="submit" value="Đăng Nhập" name="login">
            </form>
            <p>Chưa có tài khoản?<a href="{{ asset('public/backend/registration.html') }}">Tạo tài khoản</a></p>
        </div>
    </div>
    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{ asset('public/backend/js/flot-chart/excanvas.min.js') }}"></script><![endif]-->
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
</body>
</html>
