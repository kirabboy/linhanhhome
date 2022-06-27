@extends('public.layouts.master')
@section('title')
Danh sách căn hộ
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/blog_list.css') }}">
@endpush
@section('content')
<main>
    <section class="detail-home">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 d-none d-md-block">
                    <div class="box_filter">
                        <form action="{{ url()->current() }}" method="get">
                            <nav class='animated bounceInDown'>
                                <div class="title_filter">
                                    <span class="tit">Bộ lọc</span>
                                    <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">
                                        Áp dụng
                                    </button>
                                </div>
                                <ul class="menu_filter">
                                    <li class='sub-menu'><a href='#message'>Giá<div class='fa fa-caret-down right'>
                                            </div>
                                        </a>
                                        <div id="time-range">
                                            <div class="sliders_step1">

                                                <input type="hidden" name="price_min"
                                                    value="{{ request()->get('price_min') ?? $price_min }}">

                                                <div class="flat-slider" id="sliderRange" data-min="{{$price_min}}"
                                                    data-max="{{$price_max}}" data-step="100"
                                                    data-min_current="{{ request()->get('price_min') ?? $price_min }}"
                                                    data-max_current="{{ request()->get('price_max') ?? $price_max }}">
                                                </div>

                                                <input type="hidden" name="price_max"
                                                    value="{{ request()->get('price_max') ?? $price_max }}">

                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <span class="slider-time">
                                                    {{ number_format(request()->get('price_min') ?? $price_min) }}
                                                    {{ config('custom.currency') }}
                                                </span>
                                                <span class="slider-time2">
                                                    {{ number_format(request()->get('price_max') ?? $price_max) }}
                                                    {{ config('custom.currency') }}
                                                </span>

                                            </div>
                                        </div>
                                    </li>

                                    <li class='sub-menu'><a href='#settings'>Loại phòng <div
                                                class='fa fa-caret-down right'>
                                            </div></a>
                                        <ul>
                                            @foreach($type as $value)
                                            <li>
                                                <label class="box_list" id="room_bathroom">
                                                    <span class="title_lis">
                                                        <span class="icon-toilet"
                                                            style="color: rgb(51, 51, 51); font-size: 20px;"></span>
                                                        <span class="name_lis">{{ config('custom.room.type')[$value] }}
                                                        </span>
                                                    </span>
                                                    <input type="checkbox"
                                                        {{ checkedArray($value, request()->get('type') ?? []) }}
                                                        name="type[]" value="{{ $value }}">
                                                    <span class="checkbox_list">
                                                    </span>
                                                </label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <div class="title_filter bottom mt-3">
                                    <button type="submit" class="btn btn-block btn-outline-primary rounded-pill">
                                        Áp dụng
                                    </button>
                                </div>
                            </nav>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-8 room tong-hop">
                    <div class="widget">
                        <div class="widget-title">
                            <h3>Danh sách phòng</h3>

                        </div>
                        <div class="widget-content">
                            @forelse ($rooms as $room)
                            @include('public.include.room', ['room' => $room])
                            @empty
                            <div class="d-flex justify-content-center align-items-center text-muted">
                                Hiện tại chưa có vui lòng truy cập lại sau.
                            </div>
                            @endforelse
                        </div>
                        {{ $rooms->appends(request()->all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('script')
<script src="{{ asset('public/js/home.js') }}"></script>
<script src="{{ asset('public/js/blog_list.js') }}"></script>

@endpush
