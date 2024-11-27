@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('About') }}
@endsection
<style>
    .c-introduction {
        background: #fff;
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 12px 0 #aaa;
    }

    .c-award {
        background: #f7f6f6;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .c-introduction .wcs-page_body {
        font-size: 20px;
    }
</style>
@section('content')
    <section class="container">
        <div>
            <img class=" b-error b-error" width="100%"
                 src="{{ asset('images/hunghafc.jpg') }}">
        </div>
    </section>
    <section id="heading">
        <div class="container c-introduction">
            <h1 class="text-center"> Giới thiệu</h1>
            <p class="wcs-page_body">
                Dưới sự tài trợ của Tập đoàn T&T, câu lạc bộ Hà Nội – T&T thành lập vào ngày 18 tháng 6 năm 2006. 03 mùa
                giải đầu tiên, từ một đội bóng gồm đa số các cầu thủ trẻ do huấn luyện viên Triệu Quang Hà (cựu cầu thủ
                đội
                tuyển bóng đá Việt Nam và câu lạc bộ Thể Công) dẫn dắt đã liên tiếp thăng ba hạng, từ hạng Ba lên hạng
                chuyên nghiệp, giành quyền thi đấu ở đấu trường danh giá nhất Việt Nam V-League 2009.
                Bước vào mùa giải 2010, đội bóng Thủ đô có sự thay đổi trên băng ghế huấn luyện, ông Phan Thanh Hùng –
                trợ
                lý số 1 của HLV Calisto được mời về với mục tiêu đoạt chức vô địch để dành tặng người hâm mộ nhân dịp
                Đại lễ
                1000 năm Thăng Long – Hà Nội. Sự đồng lòng, quyết tâm của toàn thể thành viên đội bóng đã đưa Hà Nội
                –T&T
                bay cao và bước lên ngôi vị cao nhất lần đầu tiên chỉ sau 1 năm góp mặt ở sân chơi cao nhất Việt Nam.
                Đồng
                thời, chiếc cúp vô địch còn có ý nghĩa giải tỏa cơn khát danh hiệu của những người yêu bóng đá Hà Thành
                sau
                26 năm chờ đợi (Công An Hà Nội – 1984).
                Kể từ thời điểm đó, Hà Nội – T&T trở thành đội bóng đáng xem nhất của bóng đá Việt Nam, được biết đến
                bởi
                phong cách chơi đặc trưng là “ kiểm soát bóng, phối hợp trong phạm vi hẹp” áp dụng trong toàn hệ thống
                đào
                tạo của Câu lạc bộ. Sau 15 năm bước lên chuyên nghiệp, đại diện Thủ đô đã sưu tầm đầy đủ tất cả danh
                hiệu từ
                cấp độ đội I tới các lứa trẻ thuộc hệ thống thi đấu Quốc gia.
                Năm 2016 nhân dịp kỷ niệm sinh nhật lần thứ 10, Ủy ban Nhân dân Thành phố Hà Nội đồng ý cho phép đội
                bóng
                đổi tên Hà Nội – T&T sang Câu lạc bộ bóng đá Hà Nội và giao toàn quyền quản lý, sử dụng sân vận động
                Hàng
                Đãy, với mong muốn đội bóng thể hiện cho ý chí và sức mạnh của nhân dân Thủ đô ngàn năm văn hiến.
            </p>
        </div>
    </section>

    <section id="heading">
        <div class="container c-award">
            <h1 class="text-center"> Danh hiệu</h1>
            <div>
                <img class=" b-error b-error" width="100%"
                     src="{{ asset('images/hunghafc.jpg') }}">
            </div>
        </div>
    </section>

    <section id="next-tournament" class="next-tournament-section bg-black">
        <div class="next-tournament-wrap">
            <div class="results">
                <div class="wrapper-results">
                    <div class="box-results-tournament">
                        <div class="box-results-tournament-left">

                            <div class="info">
                                <a href="https://badominton.io/tournament-league/hochiminh-love-badmintons">
                                    <h2 class="leage-name">BAN LÃNH ĐẠO</h2>

                                </a>
                            </div>
                        </div>
                        <div class="logo-left " style="display: block">
                            <h6 class="">Đội trưởng đội bóng</h6>
                            <h6 class="">Nguyễn Anh Tuấn</h6>
                        </div>

                        <div class="box-results-tournament-right">
                            <div class="logo-right">
                                <img alt="" src="https://badominton.io/images/logo-no-background.png" width="150"
                                     height="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="heading">
        <div class="container">
            <h1 class="text-center">Sân thi đấu</h1>
            <div class="d-flex">
                <div>
                    <img class=" b-error b-error" width="100%"
                         src="{{ asset('images/hunghafc.jpg') }}">
                </div>
                <div>
                    <img class=" b-error b-error" width="100%"
                         src="{{ asset('images/hunghafc.jpg') }}">
                </div>

            </div>
        </div>
    </section>





@endsection
