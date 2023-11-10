<!DOCTYPE html>
<html lang="vi" itemscope itemtype="http://schema.org/Article">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="description" content="{{ __('Phần mềm tổ chức, ứng dụng quản lý giải đấu thể thao giúp tiết kiệm thời gian, chi phí và làm cho giải đấu của bạn chuyên nghiệp, thành công hơn.') }}" />
    <meta name="robots" content="all" />
    <meta name="keywords" content="{{ __('quản lý giải đấu, tổ chức giải đấu, hệ thống quản lý giải đấu, app quản lý giải đấu, phần mềm quản lý giải đấu, quản lý giải đấu phủi, quản lý giải đấu thể thao, phần mềm tổ chức giải đấu, bóng đá phủi, bóng đá sinh viên, bóng đá học sinh, quản lý giải đấu bóng đá, bóng đá phong trào, bóng đá phủi, bóng đá sân 7, bóng đá sân bảy, bóng đá sân nhân tạo, người quản lý bóng đá, tạo giải đấu game, lịch thi đấu, xếp lịch thi đấu, tổ chức giải đấu, kết quả trận đấu, điểm số, bảng xếp hạng, giải đấu loại trực tiếp, giải đấu vòng tròn, sự kiện giải đấu thể thao, chia bảng đấu online.') }}">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />

    <title>{{ env('APP_NAME', 'Pro League') }}</title>
    <link rel="shortcut icon" href="{{ asset('/homepage/content/images/football.ico') }}" type="image/x-icon" />
    <link href="{{ asset('/homepage/asset/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('/homepage/css/app.css') }}" rel="stylesheet" />

    <style>
        #wrapHomePage #fullpage #home--2:before {
            background-image: none;
            background-color: transparent;
        }

        .container-fluid {
            background-color: #001e28 !important;
        }

        .btn-outline {
            background-color: #0f2d37;
        }

        a {
            color: #596377;
        }
    </style>
</head>

<body data-user-id class>

    <div class="bodyContent">
        <div id="AppBar">
            @include('page.navbar')
        </div>
        @yield('content')
        <div id="AppFooter">
            @include('page.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/homepage/content/js/vendors/jquery/jquery.ui.timepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/homepage/content/js/vendors/bootstrap/bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/homepage/content/js/vendors/toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/sweetalert2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/lazyIntroCroppiePaceTippy.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/photoswipe.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/homepage/content/system/theme/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/homepage/content/system/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/homepage/content/js/vendors/exif/exif.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/myleague.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/homepage/content/js/vendors/countUp/countUp.js') }}"></script>
    <script src="{{ asset('/homepage/asset/aos/aos.js') }}"></script>
    @yield('js')


</body>

</html>
