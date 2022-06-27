<aside class="main-sidebar sidebar-green elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('public/admin/image/profile.svg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-light">{{ auth()->guard('admin')->user()->admin_info->fullname }}</span>
    </a>

    <!-- Sidebar -->
    <div id="sideBar" class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-check-current flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @if(auth()->guard('admin')->user()->can('Bảng quản trị'))
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Bảng quản trị
                        </p>
                    </a>
                </li>
                @endif
               @if(auth()->guard('admin')->user()->can('Quản trị cơ sở'))

                <li class="nav-item">
                    <a href="{{ route('admin.building.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Quản trị cơ sở
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->guard('admin')->user()->can('Bàn làm việc'))

                <li class="nav-item">
                    <a href="{{ route('ban-lam-viec.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Bàn làm việc
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->guard('admin')->user()->can('Hồ sơ khách hàng'))

                <li class="nav-header text-uppercase">Quản lý khách hàng</li>

                <li class="nav-item">
                    <a href="{{ route('admin.customer.index') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Hồ sơ khách hàng
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->guard('admin')->user()->can('Hợp đồng'))

                <li class="nav-header text-uppercase">Hợp đồng</li>

                <li class="nav-item">
                    <a href="{{ route('hop-dong.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Hợp đồng</p>
                    </a>
                </li>
                @endif
                @if(auth()->guard('admin')->user()->can('Hợp đồng'))
                <li class="nav-item">
                    <a href="{{ route('hop-dong.expired') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Hợp đồng đến hạn thanh toán</p>
                    </a>
                </li>
                @endif
                @if(auth()->guard('admin')->user()->can('Vai trò') || auth()->guard('admin')->user()->can('Người dùng'))

                <li class="nav-header text-uppercase">Quản lý tổ chức</li>
                @if(auth()->guard('admin')->user()->can('Vai trò'))

                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Vai trò
                        </p>
                    </a>
                </li>
                @endif

                @if(auth()->guard('admin')->user()->can('Người dùng'))

                <li class="nav-item">
                    <a href="{{ route('quan-ly-admin.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Người dùng
                        </p>
                    </a>
                </li>
                @endif
                @endif
                <li class="nav-item">
                    <a href="{{ route('admin.commission.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-medal"></i>
                        <p>
                            Hoa hồng
                        </p>
                    </a>
                </li>
                @role(config('custom.role-admin'), 'admin')

                <li class="nav-item">
                    <a href="{{ route('admin.setting.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Cài đặt
                        </p>
                    </a>
                </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
