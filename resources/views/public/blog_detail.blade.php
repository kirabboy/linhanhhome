@extends('public.layouts.master')
@section('title', 'Blog')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/blog_detail.css') }}">
@endpush
@section('content')
    <main>
        <section class="detail-home">
            <div class="slider-section">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <!-- Carousel Content -->
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"
                            style="background-image: url({{ asset($room->avatar) }});">
                        </div> <!-- End of Carousel Item -->
                    </div> <!-- End of Carousel Content -->
                </div> <!-- End of Carousel -->
            </div> <!-- End of Slider -->
            <div class="container">
                <div class="title">
                    <div class="title-detail">
                        <h1 itemprop="name" class="name_home">{{ $room->name_blog }}</h1>
                        <div>
                            <div class="share_btn">
                                <!-- <span class="icon-external" style="color: rgb(255, 255, 255); font-size: 24px;"></span> -->
                                <span class="share_item">Chia sẻ</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-lg-7 col-12">
                            <div class="box_room">
                                <div class="room_info">
                                    <div class="title_info">
                                        <div class="_2-dFY"><span class="icon-nav-home-fill"
                                                style="color: rgb(247, 52, 134); font-size: 32px;"></span></div>
                                        <span class="title">Thông tin phòng</span>
                                    </div>
                                    <div class="room_detail">
                                        <div class="detail_item">
                                            <p>Giá phòng</p>
                                            <p>{{ number_format( $room->price ).config('custom.currency') }}</p>
                                        </div>
                                        <div class="detail_item">
                                            <p>Diện tích</p>
                                            <p>{{ $room->acreage }}m<sup>2</sup></p>
                                        </div>
                                        <div class="detail_item">
                                            <p>Loại phòng</p>
                                            <p>{{ config('custom.room.type')[$room->type] }}</p>
                                        </div>
                                        <div class="detail_item">
                                            <p>Tòa nhà</p>
                                            <p><a href="{{ route('blog.building', $room->building->slug) }}">{{ optional($room->building)->name }}</a></p>
                                        </div>
                                    </div>
                                    <div class="room_address">
                                        <p>Điạ chỉ</p>
                                        <p itemprop="address">{{ optional($room->building)->address }}
                                        </p>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                        <div class="col-lg-5 col-12">
                            <div class="room_info">
                                <div class="title_info">
                                    <div class="_2-dFY"><span class="icon-nav-home-fill"
                                            style="color: rgb(247, 52, 134); font-size: 32px;"></span></div>
                                    <span class="title">Thông tin liên hệ</span>
                                </div>
                                <div class="room_owner">
                                    <img src="{{ asset('public/admin/image/profile.svg') }}" onerror="this.onerror=null;this.src='{{ asset(config('custom.default-image')) }}';"
                                        alt="avatar" class="_1Ad8s">
                                    <div class="name_owner">
                                        <span>{{ optional($room->building)->owner }}</span>
                                        <div><span>SĐT:&nbsp;</span><span>{{ optional($room->building)->owner_phone }}</span></div>
                                    </div>
                                    <div class="date_post">
                                        <span>Ngày đăng:&nbsp;</span>
                                        <span>{{ date('d-m-Y', strtotime($room->create_at)) }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="room_info">
                                <div class="title_info">
                                    <div class="_2-dFY"><span class="icon-nav-home-fill"
                                            style="color: rgb(247, 52, 134); font-size: 32px;"></span></div>
                                    <span class="title">Google map</span>
                                </div>
                                <div class="room_des">
                                    {!! optional($room->building)->google_map !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="room_info">
                                <div class="title_info">
                                    <div class="_2-dFY"><span class="icon-nav-home-fill"
                                            style="color: rgb(247, 52, 134); font-size: 32px;"></span></div>
                                    <span class="title">Tài sản</span>
                                </div>
                                <div class="room_des">
                                        {!! $room->asset !!}
                                    </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="room_info">
                                <div class="title_info">
                                    <div class="_2-dFY"><span class="icon-nav-home-fill"
                                            style="color: rgb(247, 52, 134); font-size: 32px;"></span></div>
                                    <span class="title">Mô tả chi tiết</span>
                                </div>
                                <div class="room_des">
                                        {!! $room->description !!}
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('public.include.float-contact-button')
@endsection
@push('script')
<script src="{{ asset('public/js/home.js') }}"></script>
@endpush
