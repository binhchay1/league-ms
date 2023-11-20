@php $route = Route::currentRouteName(); @endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link">
        <img src="{{asset('images/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">badomintion.io</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- User -->
                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Người dùng
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                </li>

                <!-- Sport -->
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-football-ball"></i>--}}
{{--                        <p>--}}
{{--                            Môn Thi Đấu--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                            <span class="badge badge-info right"></span>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('sport.create')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Tạo  Môn Thi Đấu</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('sport.index')}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Danh Sách  Môn Thi Đấu</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}

                <!-- Giải đấu -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Giải đấu
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('league.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo Giải Đấu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('league.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Giải Đấu</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Đội tuyển -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Đội Tuyển Thi Đấu
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('team.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo Đội</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('team.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Các Đội</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Vận động viên -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Vận Động Viên
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('player.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo Vận Động Viên</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Danh Sách Vận Động Viên</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

                    </ul>
                </li>

                <!-- Lịch thi đấu -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                            Lịch Thi Đấu
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('schedule.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo Lịch Thi Đấu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('schedule.index' )}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Lịch Thi Đấu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('schedule.result' )}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kết quả</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

    </div>

</aside>
