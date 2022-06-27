@extends('admin.layouts.master')
@section('title', 'Quản trị cơ sở')

@push('css')
<link rel="stylesheet" href="{{ asset('public/admin/css/building.css') }}">
@endpush

@section('content')

<div class="content-wrapper">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="page-title">
            <a href="javascript:history.back()">
                <i class="fas fa-chevron-left"></i> {{ $building['name'] }}
            </a>
        </h3>
        <div class="page-header-tool">
            <span class="mr-3 d-flex align-items-center font-weight-bold">Tỷ lệ lấp đầy
                ({{ round($building['ratio'], 2) }}%)</span>
            <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                    class="fas fa-circle text-danger mr-2"></i>Trống ({{ $building['empty'] }})</span>
            <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                    class="fas fa-circle text-success mr-2"></i>Đã thuê ({{ $building['hired'] }})</span>
            <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                    class="fas fa-circle text-secondary mr-2"></i>Tạm ngưng ({{ $building['unactive'] }})</span>
            <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                    class="fas fa-circle text-warning mr-2"></i>Đã đặt cọc ({{ $building['booked'] }})</span>
        </div>
    </div>
    <div class="row p-4 bg-white" id="after-submit">
        <div class="floor col-12">
            @foreach($building['floor'] as $item)
            <div class="floor-item-{{ $item['id'] }}">
                <div class="d-flex justify-content-between">
                    <span class="name mr-5 d-flex align-items-center font-size-h5 font-weight-bold">
                        <i class="fas fa-layer-group mr-2"></i> <span>{{ $item['name'] }}</span>
                    </span>
                    <div class="dropdown mr-auto">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><span class="floor-edit dropdown-item"
                                    data-route="{{ route('admin.floor.edit', $item['id']) }}">Chỉnh sửa</span></li>
                            <li><span class="floor-delete dropdown-item"
                                    data-route="{{ route('admin.floor.delete', $item['id']) }}">Xóa</span></li>
                        </ul>
                    </div>
                    <div class="d-flex">
                        <span class="mr-3 d-flex align-items-center font-weight-bold">Tỷ lệ lấp đầy
                            ({{ round($item['ratio'], 2) }}%)</span>
                        <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                                class="fas fa-circle text-danger mr-2"></i>{{ $item['empty'] }}/{{ $item['total'] }}</span>
                        <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                                class="fas fa-circle text-success mr-2"></i>{{ $item['hired'] }}/{{ $item['total'] }}</span>
                        <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                                class="fas fa-circle text-secondary mr-2"></i>{{ $item['unactive'] }}/{{ $item['total'] }}</span>
                        <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                                class="fas fa-circle text-warning mr-2"></i>{{ $item['booked'] }}/{{ $item['total'] }}</span>
                    </div>
                </div>
                <div class="room d-flex justify-content-start align-items-center mt-2">
                    @forelse($item['room'] as $item)
                    <div class="show-quickly-room item {{ bgStatus($item['status']) }} d-flex align-items-center justify-content-center font-weight-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Đơn vị thuê: {{ $item['name'] }}" data-route="{{ route('admin.room.show.quickly', $item['id']) }}">{{ $item['name'] }}</div>
                    @empty
                    <div class="d-flex justify-content-center align-items-center w-100">Tầng trống</div>
                    @endforelse
                </div>

                <hr>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('script')
<!-- <script src="{{ asset('public/admin/js/home.js') }}"></script> -->
<!-- <script src="{{ asset('public/admin/js/building.js') }}"></script> -->
<script src="{{ asset('public/admin/js/floor.js') }}"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            'customClass': 'custom-tooltip'
        })
    })
</script>
@endpush
