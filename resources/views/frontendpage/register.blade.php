<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->

    <link rel="stylesheet" href={{ asset('assets/vendor/fonts/boxicons.css') }}/>

    <!-- Core CSS -->

    <link rel="stylesheet" href={{ asset('assets/vendor/css/core.css') }} class="template-customizer-core-css" />
    <link rel="stylesheet" href={{ asset('assets/vendor/css/theme-default.css') }} class="template-customizer-theme-css" />
    <link rel="stylesheet" href={{ asset('assets/css/demo.css') }} />

    <!-- Vendors CSS -->
    {{-- <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" /> --}}
    <link rel="stylesheet" href={{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} />
    {{-- <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" /> --}}
    <link rel="stylesheet" href={{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }} />
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
  </head>

  <body>
    
    <div class="container-xxl col-6">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner">
            <!-- Register Card -->
            <div class="card">
              <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                  <h1>Đăng kí tài khoản</h1>
                </div>
                <!-- /Logo -->
                {{-- <h4 class="mb-2">Adventure starts here 🚀</h4>
                <p class="mb-4">Make your app management easy and fun!</p> --}}
  
                <form id="formAuthentication" class="mb-3" action={{ route('user.register') }} method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input
                      type="text"
                      class="form-control"
                      id="username"
                      name="FullName" required
                      {{-- placeholder="Enter your username" --}}
                      autofocus
                    />
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="email" name="PhoneNumber" required />
                  </div>

                  <div class="mb-4">
                    <label for="citySelect" class="form-label">Tỉnh/Thành phố</label>
                    <select id="citySelect" class="form-select" name="city" required>
                      <option value="">-- Chọn Tỉnh/Thành phố --</option>
                    </select>
                  </div>
                  
                  <div class="mb-4">
                    <label for="districtSelect" class="form-label">Quận/Huyện</label>
                    <select id="districtSelect" class="form-select" name="district" required>
                      <option value="">-- Chọn Quận/Huyện --</option>
                    </select>
                  </div>
                  
                  <div class="mb-4">
                    <label for="wardSelect" class="form-label">Phường/Xã</label>
                    <select id="wardSelect" class="form-select" name="ward" required>
                      <option value="">-- Chọn Phường/Xã --</option>
                    </select>
                  </div>
                  
                  <div class="mb-3">
                    <label for="email" class="form-label">Đường</label>
                    <input type="text" class="form-control" id="email" name="Address" required />
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required/>
                  </div>
                  <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password" >Mật khẩu</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="Password" required
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                      />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
  
                  {{-- <div class="mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                      <label class="form-check-label" for="terms-conditions">
                        I agree to
                        <a href="javascript:void(0);">privacy policy & terms</a>
                      </label>
                    </div>
                  </div> --}}
                  <button class="btn btn-primary d-grid w-100">Đăng kí</button>
                </form>
  
                <p class="text-center">
                  <span>Bạn có tài khoản?</span>
                  <a href={{ route('user.loginpage') }}>
                    <span>Đăng nhập</span>
                  </a>
                </p>
              </div>
            </div>
            <!-- Register Card -->
          </div>
        </div>
      </div>
    
    <!-- Core JS -->
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>

    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>



    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('/assets/js/ui-toasts.js') }}"></script>
    {{-- <script src=""></script> --}}

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        // Đường dẫn tới file JSON
        const jsonPath = "{{ asset('/front_file/vietnamAddress.json') }}";

        // Lấy tham chiếu tới các dropdown
        const citySelect = document.getElementById("citySelect");
        const districtSelect = document.getElementById("districtSelect");
        const wardSelect = document.getElementById("wardSelect");

        // Hàm tạo danh sách option
        function populateSelect(selectElement, data, placeholder) {
            selectElement.innerHTML = `<option>-- ${placeholder} --</option>`;
            data.forEach((item) => {
                const option = document.createElement("option");
                option.value = item.Name; // Chỉnh lại để value là Name thay vì Id
                option.textContent = item.Name;
                selectElement.appendChild(option);
            });
        }

        // Tải dữ liệu từ file JSON
        fetch(jsonPath)
            .then((response) => response.json())
            .then((data) => {
                // Gán dữ liệu tỉnh/thành phố
                populateSelect(citySelect, data, "Chọn Tỉnh/Thành phố");

                // Khi chọn tỉnh/thành phố
                citySelect.addEventListener("change", (event) => {
                    const selectedCity = data.find((city) => city.Name === event.target.value);
                    if (selectedCity) {
                        populateSelect(districtSelect, selectedCity.Districts, "Chọn Quận/Huyện");
                        wardSelect.innerHTML = `<option>-- Chọn Phường/Xã --</option>`;
                    } else {
                        districtSelect.innerHTML = `<option>-- Chọn Quận/Huyện --</option>`;
                        wardSelect.innerHTML = `<option>-- Chọn Phường/Xã --</option>`;
                    }
                });

                // Khi chọn quận/huyện
                districtSelect.addEventListener("change", (event) => {
                    const selectedCity = data.find((city) => city.Name === citySelect.value);
                    const selectedDistrict = selectedCity?.Districts.find(
                        (district) => district.Name === event.target.value
                    );
                    if (selectedDistrict) {
                        populateSelect(wardSelect, selectedDistrict.Wards, "Chọn Phường/Xã");
                    } else {
                        wardSelect.innerHTML = `<option>-- Chọn Phường/Xã --</option>`;
                    }
                });
            })
            .catch((error) => console.error("Lỗi khi tải dữ liệu:", error));
    </script>

      
  </body>
</html>
