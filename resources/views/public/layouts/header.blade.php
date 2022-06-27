<header>
    <div class="header-main stuck" style="width: 100%;">
        <div class="container-fluid">
            <div class="header-main-content row">
                <div class="col d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{ route('index') }}">

                            <img src="{{ asset(config('custom.shortcut-icon')) }}" alt="logo">
                        </a>
                    </div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog.index') }}">Danh sách căn hộ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<main id="homepage">
        <div id="noidungtrang">
            
