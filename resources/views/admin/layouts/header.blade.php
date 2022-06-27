<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav nav-check-current">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <div class="pr-2"></div>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard.index') }}" class="nav-link btn btn-xam">
                <i class="nav-icon fas fa-tachometer-alt pr-1"></i>
                Bảng quản trị</a>
        </li>
        <div class="pr-2"></div>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.building.index') }}" class="nav-link btn btn-xam">
                <i class="nav-icon fas fa-file pr-1"></i>
                Quản trị cơ sở</a>
        </li>
        <div class="pr-2"></div>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('ban-lam-viec.index') }}" class="nav-link btn btn-xam">
                <i class="nav-icon fas fa-edit pr-1"></i> Bàn làm việc</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown mr-3" id="dropdown_notice">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ asset('public/admin/image/notice.jpg')}}" alt="User Avatar"
                    class="img-size-25 img-circle">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{count($notify)}}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-notice dropdown-menu-right">
                @foreach($notify as $item)
                <a href="#" class="dropdown-item sidebar-green user_hover">
                    <!-- Message Start -->
                    <div class="media pt-2 pb-2">
                        <div class="media-body">
                            <h5 class="font-weight-bold">
                                Hợp đồng sắp hết hạn
                            </h5>
                            <p class="text-sm">Mã HĐ: {{ $item->data['notify']['code'] }}.</p>
                            <p class="text-sm">Tên HĐ: {{ $item->data['notify']['name'] }}.</p>
                            <p class="text-sm">Thời gian hết: {{ date('d/m/Y', strtotime($item->data['notify']['time_end'])) }}.</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item dropdown" id="dropdown_user">
            <a class="nav-link" data-toggle="dropdown" href="#">
                Chào, <strong class="text-uppercase">{{ auth()->guard('admin')->user()->username }}</strong>
                <img src="{{ asset('public/admin/image/profile.svg')}}" alt="User Avatar"
                    class="img-size-25 img-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-user dropdown-menu-right">
                <a href="#" class="dropdown-item sidebar-green user_hover">
                    <!-- Message Start -->
                    <div class="media pt-2 pb-2">
                        <img src="{{ asset('public/admin/image/profile.svg')}}" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h1 class="dropdown-item-title" style="font-size: 24px;">
                                {{ auth()->guard('admin')->user()->admin_info->fullname }}
                            </h1>
                            <p class="text-sm">{{ auth()->guard('admin')->user()->admin_info->phone }}</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>

                <!-- <a href="#" class="dropdown-item ic_of_user">
                    <div class="media">
                        <i class="fas fa-user text-success pr-4"></i>
                        <div class="media-body">
                            <h1 class="dropdown-item-title">
                                Hồ sơ cá nhân
                            </h1>
                            <p class="text-sm">Cài đặt tài khoản</p>
                        </div>
                    </div>

                </a>

                <a href="#" class="dropdown-item ic_of_user">
                    <div class="media">
                        <i class="fas fa-file text-danger pr-4"></i>
                        <div class="media-body">
                            <h1 class="dropdown-item-title">
                                Công việc của tôi
                            </h1>
                            <p class="text-sm">Danh sách dự án công việc</p>
                        </div>
                    </div>
                </a> -->

                <div class="p-3">
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <i class="fas fa-logout text-danger pr-2"></i>
                        <button type="submit" class="btn btn-success sidebar-green">Đăng xuất</button>
                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>
