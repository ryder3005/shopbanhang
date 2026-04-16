<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- jQuery (Giữ lại phiên bản mới hơn) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (Giữ lại phiên bản mới nhất) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">
    {{-- DATATABLE --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <!-- Morris Chart CSS và Raphael JS (Nếu cần thiết cho biểu đồ) -->
    <script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('public/backend/js/morris.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        :root {
            --bs-blue: #007bff;
            --bs-indigo: #6610f2;
            --bs-purple: #696cff;
            --bs-pink: #e83e8c;
            --bs-red: #ff3e1d;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffab00;
            --bs-green: #71dd37;
            --bs-teal: #20c997;
            --bs-cyan: #03c3ec;
            --bs-black: #393a5a;
            --bs-white: #fff;
            --bs-gray: rgba(230, 230, 241, 0.6);
            --bs-gray-dark: rgba(230, 230, 241, 0.8);
            --bs-gray-25: rgba(230, 230, 241, 0.025);
            --bs-gray-60: rgba(230, 230, 241, 0.06);
            --bs-gray-80: rgba(230, 230, 241, 0.08);
            --bs-primary: #696cff;
            --bs-secondary: #8592a3;
            --bs-success: #71dd37;
            --bs-info: #03c3ec;
            --bs-warning: #ffab00;
            --bs-danger: #ff3e1d;
            --bs-light: #494a5d;
            --bs-dark: #6b6c9d;
            --bs-gray: rgba(230, 230, 241, 0.5);
            --bs-primary-rgb: 105, 108, 255;
            --bs-secondary-rgb: 133, 146, 163;
            --bs-success-rgb: 113, 221, 55;
            --bs-info-rgb: 3, 195, 236;
            --bs-warning-rgb: 255, 171, 0;
            --bs-danger-rgb: 255, 62, 29;
            --bs-light-rgb: 73, 74, 93;
            --bs-dark-rgb: 107, 108, 157;
            --bs-gray-rgb: 230, 230, 241;
            --bs-primary-text-emphasis: #2a2b66;
            --bs-secondary-text-emphasis: #353a41;
            --bs-success-text-emphasis: #2d5816;
            --bs-info-text-emphasis: #014e5e;
            --bs-warning-text-emphasis: #664400;
            --bs-danger-text-emphasis: #66190c;
            --bs-light-text-emphasis: rgba(230, 230, 241, 0.7);
            --bs-dark-text-emphasis: rgba(230, 230, 241, 0.7);
            --bs-primary-bg-subtle: #e1e2ff;
            --bs-secondary-bg-subtle: #e7e9ed;
            --bs-success-bg-subtle: #e3f8d7;
            --bs-info-bg-subtle: #cdf3fb;
            --bs-warning-bg-subtle: #ffeecc;
            --bs-danger-bg-subtle: #ffd8d2;
            --bs-light-bg-subtle: rgba(254, 254, 254, 0.55);
            --bs-dark-bg-subtle: rgba(230, 230, 241, 0.4);
            --bs-primary-border-subtle: #c3c4ff;
            --bs-secondary-border-subtle: #ced3da;
            --bs-success-border-subtle: #c6f1af;
            --bs-info-border-subtle: #9ae7f7;
            --bs-warning-border-subtle: #ffdd99;
            --bs-danger-border-subtle: #ffb2a5;
            --bs-light-border-subtle: rgba(230, 230, 241, 0.12);
            --bs-dark-border-subtle: rgba(230, 230, 241, 0.5);
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 57, 58, 90;
            --bs-font-sans-serif: "Public Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            --bs-font-monospace: "SFMono-Regular", Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-root-font-size: 16px;
            --bs-body-font-family: var(--bs-font-sans-serif);
            --bs-body-font-size: 0.9375rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.375;
            --bs-body-color: #b2b2c4;
            --bs-body-color-rgb: 178, 178, 196;
            --bs-body-bg: #232333;
            --bs-body-bg-rgb: 35, 35, 51;
            --bs-emphasis-color: #393a5a;
            --bs-emphasis-color-rgb: 57, 58, 90;
            --bs-secondary-color: rgba(178, 178, 196, 0.75);
            --bs-secondary-color-rgb: 178, 178, 196;
            --bs-secondary-bg: rgba(230, 230, 241, 0.12);
            --bs-secondary-bg-rgb: 230, 230, 241;
            --bs-tertiary-color: rgba(178, 178, 196, 0.5);
            --bs-tertiary-color-rgb: 178, 178, 196;
            --bs-tertiary-bg: rgba(230, 230, 241, 0.1);
            --bs-tertiary-bg-rgb: 230, 230, 241;
            --bs-heading-color: #d5d5e2;
            --bs-link-color: #696cff;
            --bs-link-color-rgb: 105, 108, 255;
            --bs-link-decoration: none;
            --bs-link-hover-color: #5f61e6;
            --bs-link-hover-color-rgb: 95, 97, 230;
            --bs-code-color: #e83e8c;
            --bs-highlight-color: #b2b2c4;
            --bs-highlight-bg: #ffeecc;
            --bs-border-width: 1px;
            --bs-border-style: solid;
            --bs-border-color: #4e4f6c;
            --bs-border-color-translucent: rgba(57, 58, 90, 0.175);
            --bs-border-radius: 0.375rem;
            --bs-border-radius-sm: 0.25rem;
            --bs-border-radius-lg: 0.5rem;
            --bs-border-radius-xl: 0.625rem;
            --bs-border-radius-xxl: 2rem;
            --bs-border-radius-2xl: var(--bs-border-radius-xxl);
            --bs-border-radius-pill: 50rem;
            --bs-box-shadow: 0 0.1875rem 0.5rem 0 rgba(20, 20, 29, 0.22);
            --bs-box-shadow-sm: 0 0.125rem 0.375rem 0 rgba(20, 20, 29, 0.2);
            --bs-box-shadow-lg: 0 0.25rem 0.75rem 0 rgba(20, 20, 29, 0.24);
            --bs-box-shadow-inset: inset 0 1px 2px rgba(57, 58, 90, 0.075);
            --bs-focus-ring-width: 0.15rem;
            --bs-focus-ring-opacity: 0.75;
            --bs-focus-ring-color: rgba(230, 230, 241, 0.75);
            --bs-form-valid-color: #71dd37;
            --bs-form-valid-border-color: #71dd37;
            --bs-form-invalid-color: #ff3e1d;
            --bs-form-invalid-border-color: #ff3e1d;
        }

        body {
            font-size: 0.875rem;
            background-color: #262333;

            display: flex;
            overflow-x: auto;
            color: #d5d5e2;
        }

        .sidebar {
            position: fixed;
            height: 100vh;
            width: 16.25rem;
            margin: 0;
            background-color: #2b2c40;

        }

        .sidebar a {
            color: #ffffff;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .submenu {
            display: none;

        }

        .submenu.show {
            display: block;
            /* Hiển thị nội dung khi có class show */
        }

        .content {
            border-radius: 1rem;
            margin-left: 17rem;
            margin-right: 1rem;
            /* Điều chỉnh margin trái cho nội dung chính */
            flex: 1;
            padding: 20px;
            background-color: #2b2c40;
            min-width: 800px;
            /* Đảm bảo chiều rộng tối thiểu cho nội dung */
            margin-top: 1rem;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 200px;
            /* Căn lề trái cho footer */
            width: calc(100% - 200px);
            /* Chiều rộng footer */
            background-color: #212529;
            padding: 10px;
            text-align: center;
        }

        table {
            background-color: #2b2c40 !important;
        }

        th,
        td {
            color: #d5d5e2;
        }

        tr {
            background-color: transparent !important;
        }

        th {
            background-color: transparent !important;
        }

        ul.nav.flex-column {
            font-size: .9375rem;
        }

        h4.text-white.text-center.py-3 {
            font-size: 1.75rem;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #3e3f69 !important;
            border-top-width: 1px !important;
            border-top-style: solid !important;
            border-top-color: rgb(78, 79, 108) !important;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            padding: 10px 18px;
            border-bottom: 0px solid #111;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid rgb(78, 79, 108);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #ffffff !important;
            border: 1px solid #696969;
            background-color: white;

            background: #d5d1f17a;
            border-radius: 0.3rem;
        }

        ::before {
            color: var(--bs-body-color);
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        i.fas.fa-eye {
            width: 20px;
        }

        div {
            color: inherit !important;
        }

        select {
            color: inherit;
        }

        div#productDropzone {
            background-color: transparent;
        }
    </style>

</head>

<body>


    <div class="sidebar">
        <h4 class="text-white text-center py-3">Dashboard Admin</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href={{ route('admin.dashboard') }}><i class="fas fa-home"></i>
                    Trang Chủ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-users"></i>
                    Quản Lý Người Dùng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="productToggle"><i class="fas fa-box"></i> Quản Lý Sản Phẩm</a>
                <ul class="nav flex-column pl-3 submenu" id="productMenu">
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('products.all') }}><i class="fas fa-cube"></i> Sản
                            Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('category.all') }}><i class="fas fa-tags"></i> Danh Mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('brand.all') }}><i class="fas fa-tag"></i> Thương Hiệu</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-chart-line"></i> Thống Kê</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-cog"></i> Cài
                    Đặt</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>
            </li>
        </ul>
    </div>

    <main class="content">
        @yield('admin_content')

    </main>


    <script>
        $(document).ready(function() {
            $('#productToggle').click(function() {
                $('#productMenu').toggleClass('show');
            });
        });
    </script>
</body>

</html>
