@extends('public.layouts.master')
@section('title', 'Trang chủ')

@push('css')
<link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
@endpush
@section('content')

<section>
    <div class="container-fluid">
            <img src="{{ asset('public/image/banner.png') }}" alt="" width="100%">
    </div>
</section> 
<section class="xu-huong">
    <div class="container-fluid">
        <h3>Tòa nhà</h3>
        <div class="row">
            @foreach ($buildings as $building)
            <div class="col col-6 col-md-4 col-lg-2">
                <div class="card img-fluid" style="width:100%">
                    <a href="{{ route('blog.building', $building->slug) }}">
                        <img class="card-img-top" src="{{ asset($building->avatar) }}" onerror="this.onerror=null;this.src='{{ asset(config('custom.default-image')) }}';" alt="Card image"
                            style="width:100%">
                        <div class="card-img-overlay">
                            <h4 class="card-title">{{ $building->name }}</h4>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>

<section class="tong-hop">
    <div class="container-fluid">
        <div class="row">
            <!-- TRÁI -->
            <div class="col col-lg-9 col-12 phong-moi">
                <div class="widget">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Phòng mới nhất</h3>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary rounded-pill">Xem tất cả</a>
                    </div>
                    <div class="widget-content">
                        <!-- Bài 1 -->

                        @foreach($rooms as $room)

                        @include('public.include.room', ['room' => $room])

                        @endforeach
                        <!-- Bài 2 -->

                    </div>
                    <div class="text-center">
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary rounded-pill">Xem tất cả</a>
                    </div>
                </div>
            </div>
            <!-- PHẢI -->
            <div class="col col-lg-3 col-12 da-xac-thuc">
                <div class="widget">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3><i class="fas fa-shield-check"></i> Phòng trống</h3>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary rounded-pill">Xem tất cả</a>
                    </div>
                    <div class="widget-content">
                        <!-- Bài 1 -->
                        @foreach($rooms_empty as $room)

                        @include('public.include.room_sidebar', ['room' => $room])

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('script')
<script src="{{ asset('public/js/home.js') }}"></script>
@endpush
