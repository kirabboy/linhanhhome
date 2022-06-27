@extends('admin.layouts.master_login')
@section('title')
    Đăng nhập
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('public/admin/css/login.css') }}">
@endpush
@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row d-flex align-items-center row-login">
                <div class="col-md-6 col-12" id="particles-js">
                    <div class="card-block">
                        <div class="card card-login">
                            <div class="card-header text-center">
                                <img class="w-50" src="{{ asset('public/admin/images/linhanhlogo.png') }}" alt="">
                            </div>
                            <div class="card-body">
                                <h5 class="title">Chào mừng bạn trở lại,</h5>
                                <small class="sub-title"> ChuoiCanHo, không chỉ đơn giản là giải pháp quản lý mà
                                    còn là một Hệ Sinh Thái Bất Động Sản toàn diện.
                                </small>
                                <div class="card-content">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Tên đăng nhập<sup class="text-danger">*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-address-card-o"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Tên đăng nhập"
                                                    name="username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mật khẩu<sup class="text-danger">*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" placeholder="Mật khẩu"
                                                    name="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-main w-100">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 d-md-flex d-none carousel-login ">
                    <div class="carousel-content">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-50" src="{{ asset('public/admin/images/slide1.png') }}"
                                        alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('public/admin/images/slide1.png') }}"
                                        alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-50" src="{{ asset('public/admin/images/slide1.png') }}"
                                        alt="First slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
    <script src="{{ asset('public/admin/js/login.js') }}"></script>
   
@endpush
