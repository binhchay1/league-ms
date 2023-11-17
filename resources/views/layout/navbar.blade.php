
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Information -->
        <li class="nav-item dropdown user user-menu">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                <img src="{{auth()->user()->image ?? asset('image/default-avatar .png')}}" class="user-image" alt="User Image">
                <span class="hidden-xs"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <div class="d-flex bd-highlight">
                    <div class="p-2 bd-highlight">
                        <a href="" class="btn btn-default">changePass</a>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <a href="{{ route('logout') }}" class="btn btn-default">logout</a>
                    </div>
                    <form id="logout" action="#" method="POST" style="display: none;">
                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>
