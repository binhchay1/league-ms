<style>
    .container-fluid {
        background-color: #001e28 !important;
    }

    .btn-outline {
        background-color: #0f2d37;
    }
</style>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a target="_blank" class="iconShop hidden">
                <img src="{{ asset('/homepage/content/images/shop.png') }}"> </a>
            <a class="navbar-brand nav-logo-myleague hvr-buzz-out" href="{{ route('home') }}">
                <img src="{{ asset('/homepage/content/images/green_logo.jpg') }}" class="pull-left hidden">
                <img src="{{ asset('/homepage/content/images/white_logo.jpg') }}" class="pull-left">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right ">
                <li class="dropdown"><a title="Giải đấu" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span>Giải đấu</span> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('tournament.create') }}">
                                Tạo giải đấu </a></li>
                        <li><a href="{{ route('list.tour') }}"> Tìm giải đấu </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"><a title="Đội thi đấu" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span>Đội thi đấu</span> <span class="caret"></span> </a>
                    <ul class="dropdown-menu">
                        <li><a href="https://myleague.vn/competitor/create"> Tạo
                                đội </a></li>
                        <li><a href="https://myleague.vn/competitor"> Tìm đội </a>
                        </li>
                        <li><a href="https://myleague.vn/lineup"> Tạo đội hình </a>
                        </li>
                    </ul>
                </li>
                @if (!auth()->user())
                <li><a href="{{ route('login') }}">{{ __('Đăng nhập') }}</a></li>
                <li>
                    <a href="{{ route('register_user') }}">{{ __('Đăng ký') }}</a>
                </li>
                </li>
                @else(auth::check())
                <li class="dropdown" id="info-account">
                    <a title=" Tâm An" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <img src="{{ asset(Auth::user()->image) ?? asset('/images/default-avatar.png') }}">
                        <span class="truncated name-profile">
                            {{ Auth::user()->name }}
                        </span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('profile.edit') }}">
                                Thông tin tài khoản
                            </a>
                        </li>
                        <li>
                            <a href="https://myleague.vn/account/myleague">
                                Quản lý giải đấu
                            </a>
                        </li>
                        <li>
                            <a href="https://myleague.vn/account/mycompetitor">
                                Quản lý đội
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('signout') }}">
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li>

                @endif
                <li class="dropdown" id="language">
                    <a href="javascript:void(0)" id="locale" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="flag-icon flag-icon-vn" alt="Vietnam"></span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="https://myleague.vn/lang/vi?url=https://myleague.vn">
                                <span class="flag-icon flag-icon-vn"></span>Tiếng Việt
                            </a>
                        </li>
                        <li>
                            <a href="https://myleague.vn/lang/en?url=https://myleague.vn">
                                <span class="flag-icon flag-icon-en"></span>Tiếng Anh
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
