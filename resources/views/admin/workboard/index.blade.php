@extends('admin.layouts.master')
@section('title')
    Bàn làm việc
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('/public/admin/css/workboard.css') }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="border-bottom: 1px solid #d3d3d3; padding-bottom: 15px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="m-0" style="line-height: 40px; font-size: 14px;">
                            <i class="fas fa-laptop text-success"></i>
                            Bàn làm việc
                        </p>
                    </div>
                    <div class="col-sm-2 text-right">
                        <form id="form-select-building" action="" method="get">
                            <select id="select-building" name="building" class="form-control" onchange="this.form.submit()"">
                                                                                  @foreach ($buildings as $item)
                                <option value="{{ $item->id }}" {{ $building->id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="col-sm-8 text-right">
                        <button class="btn btn-green btn-vien-trai" id="btn-tool-create-contract" data-room_id=""
                            onclick="createContract(this)" data-url="{{ route('hop-dong.create') }}">
                            <i class="fas fa-plus"></i> Tạo hợp đồng</button>
                        <button class="btn btn-green btn-vien-trai btn-vien-phai" id="btn-tool-create-contract-earnest"
                            onclick="createContractEarnest(this)" data-room_id=""
                            data-url="{{ route('hop-dong-coc.create') }}">
                            <i class="fas fa-plus-circle"></i> Cọc giữ chỗ</button>
                        {{-- <button class="btn btn-green btn-vien-trai btn-vien-phai" id="btn-tool-create-service-detail">
                            <i class="fas fa-percent"></i> Ghi chi số</button> --}}

                        <p class="m-1 d-sm-none"> </p>

                        <button class="btn btn-green btn-vien-trai btn-vien-phai" id="btn-tool-create-invoice"
                            onclick="createInvoice(this)" data-id_room="" data-url="{{ route('hoa-don.create') }}">
                            <i class="fas fa-file-invoice"></i> Xuất hóa đơn</button>
                        {{-- <button class="btn btn-green btn-vien-trai btn-vien-phai btn-edit-room"
                            id="btn-tool-cancel-contract" data-id_room=""
                            data-url="{{ route('phong.edit', $room->id) }}">
                            <i class="fas fa-door-open"></i> Sửa phòng</button> --}}
                        {{-- <button class="btn btn-green btn-vien-phai" data-toggle="modal" data-target=".coc_giu_cho">
                            <i class="fa fa-search"></i> Chuyển phòng</button> --}}

                        <p class="m-1 d-sm-none"> </p>
                        {{-- <button class="btn btn-green" style="padding: 6px 15px;">
                            ...</button>
                        <button class="btn btn-green btn-vien-trai" style="padding: 9px 15px">
                            <i class="fa fa-search"></i></button>
                        <button class="btn btn-green btn-vien-phai"
                            style="padding: 9px 15px; background-color: #ffa800 !important;">
                            <i class="fa fa-search"></i></button> --}}
                    </div>
                </div>
            </div>
        </section>
        <section class="p-2">
            <!-- Card body start -->
            <div class="card-body">
                <div class="card-group">
                    <div class="card p-2">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-12 pb-2" style="border-bottom: 1px solid #d3d3d3;">
                                            <p class="text-muted m-0 text-14">
                                                <i class="fa fa-map"></i> {{ $building->address }}
                                            </p>
                                        </div>
                                        <div class="col-12 pt-2">
                                            <ul class="nav mb-3 justify-content-between" id="pills-tab" role="tablist">
                                                <li class="nav-item font-10 building-room-status-bar" role="presentation">
                                                    <ul id="tool-filter-status-room" class="nav nav-pills mb-3"
                                                        data-url="{{ route('ban-lam-viec.show', $building) }}">
                                                        <li class="nav-item pr-2" role="presentation">
                                                            <button class="btn btn-primary p-1">
                                                                Tất cả ({{ $building->count->sum() }})</button>
                                                        </li>
                                                        <li class="nav-item pr-2" role="presentation">
                                                            <button class="btn btn-danger p-1" data-status="0">
                                                                Trống
                                                                ({{ isset($building->count['0']) ? $building->count['0'] : 0 }})</button>
                                                        </li>
                                                        <li class="nav-item pr-2" role="presentation">
                                                            <button class="btn btn-warning p-1" data-status="1">
                                                                Đã cọc
                                                                ({{ isset($building->count['1']) ? $building->count['1'] : 0 }})</button>
                                                        </li>
                                                        <li class="nav-item pr-2" role="presentation">
                                                            <button class="btn btn-success p-1" data-status="2">
                                                                Đã thuê
                                                                ({{ isset($building->count['2']) ? $building->count['2'] : 0 }})</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="btn btn-secondary p-1" data-status="3">
                                                                Tạm ngưng
                                                                ({{ isset($building->count['3']) ? $building->count['3'] : 0 }})</button>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <li class="d-none-mobile building-process-bar">
                                                    <div class="progress " style="width: 100%; margin-top: 10px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $building->ratio }}%" aria-valuenow="100"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{ round($building->ratio) }}%
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="building-detail">
                                                @include(
                                                    'admin.workboard.include.building_detail',
                                                    compact('building')
                                                )
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <nav>
                            <div class="nav nav-tabs" id="tab_card_banlamviec" role="tablist">
                                <button class="nav-link active text-14" id="don_vi_thue" data-bs-toggle="tab"
                                    data-bs-target="#nav_don_vi_thue" type="button" role="tab">
                                    Đơn vị thuê</button>

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <!-- Tab đơn vị thuê -->
                            <div class="p-2 tab-pane fade show active" id="nav_don_vi_thue">
                                <!-- Tab thông tin đơn vị thuê-->
                                <nav>
                                    <div class="nav nav-tabs" id="tab_child_banlamviec_1" role="tablist">
                                        <button class="nav-link active text-14" id="don_vi_thue" data-bs-toggle="tab"
                                            data-bs-target="#nav_thong_tin_don_vi_thue" type="button" role="tab">
                                            Thông tin đơn vị thuê</button>
                                    </div>
                                </nav>
                                <div class="tab_thong_tin_dv" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav_thong_tin_don_vi_thue">

                                    </div>
                                </div>
                                <!-- End tab thông tin đơn vị thuê-->
                                <p class="m-2"> </p>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab-hop-dong-thue" role="tablist">
                                        <button class="nav-link active text-14" id="hop_dong_thue" data-bs-toggle="tab"
                                            data-bs-target="#nav_hop_dong_thue" type="button" role="tab">
                                            Hợp đồng thuê</button>
                                        <button class="nav-link text-14" id="dat_coc_giu_cho" data-bs-toggle="tab"
                                            data-bs-target="#nav_dat_coc_giu_cho" type="button" role="tab">
                                            Đặt cọc giữ chỗ</button>
                                        <button class="nav-link text-14" id="lich_su_hop_dong" data-bs-toggle="tab"
                                            data-bs-target="#nav_lich_su_hop_dong" type="button" role="tab">
                                            Lịch sử hợp đồng</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav_hop_dong_thue">
                                    </div>
                                    <div class="tab-pane fade" id="nav_dat_coc_giu_cho">

                                    </div>
                                    <div class="tab-pane fade show" id="nav_lich_su_hop_dong">
                                    </div>
                                </div>
                            </div>
                            <!-- End tab đơn vị thuê -->
                        </div>
                        <div id="service-detail-area" class="p-2">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <p class="p-5"></p>
    </div>
@endsection
@push('script')
    <script src="{{ asset('public/admin/js/workboard.js') }}"></script>
    <script src="{{ asset('public/admin/js/contract_earnest.js') }}"></script>
    <script src="{{ asset('/public/admin/js/create_room.js') }}"></script>
    <script src={{ asset('/public/admin/js/create_contract.js') }}></script>
    <script src={{ asset('/public/admin/js/create_contract_service.js') }}></script>
    <script src={{ asset('/public/admin/js/invoice.js') }}></script>
    <script src={{ asset('/public/admin/js/customer.js') }}></script>


@endpush
