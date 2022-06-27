@extends('admin.layouts.master')
@section('title')
    Hợp đồng
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('public/admin/css/contract.css') }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="border-bottom: 1px solid #d3d3d3; padding-bottom: 15px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="m-0" style="line-height: 40px; font-size: 14px;">
                            <i class="nav-icon fas fa-paper-plane text-success"></i>
                            Danh sách hợp đồng cần tạo hóa đơn
                        </p>
                    </div>
                    <div class="col-sm-10 text-right">
                        {{-- <button class="btn btn-green btn-vien-trai">
                            <i class="fa fa-search"></i> Tải lại</button>
                        <button class="btn btn-green btn-vien-trai btn-vien-phai">
                            <i class="fa fa-search"></i> Thêm mới</button>
                        <button class="btn btn-green btn-vien-trai btn-vien-phai">
                            <i class="fa fa-search"></i> Sao chép</button>

                        <p class="m-1 d-sm-none"> </p>

                        <button class="btn btn-green btn-vien-trai btn-vien-phai">
                            <i class="fa fa-search"></i> Chỉnh sửa</button>
                        <button class="btn btn-green btn-vien-trai btn-vien-phai">
                            <i class="fa fa-search"></i> Tiến độ</button>
                        <button class="btn btn-green btn-vien-trai btn-vien-phai">
                            <i class="fa fa-search"></i> Trạng thái</button>
                        <button class="btn btn-green btn-vien-phai" style="background:rgb(255, 94, 94) !important">
                            <i class="fa fa-trash"></i> Xóa</button> --}}
                    </div>
                </div>
            </div>
        </section>

        <section id="content-main">
            {{-- <ul class="nav mb-1 nav_congviec" id="pills-tab" role="tablist" style="border-bottom: dotted 1px #d3d3d3;">
                <li class="nav-item">
                    <a class="nav-link text-14 active" id="pills-tat_ca-tab" data-toggle="pill" href="#pills-tat_ca">
                        Tất cả (6)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-14" id="pills-moi-tab" data-toggle="pill" href="#pills-moi">
                        Mới (0)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-14" id="pills-dang_tien_hanh-tab" data-toggle="pill"
                        href="#pills-dang_tien_hanh">
                        Đang tiến hành (0)</a>
                </li>
            </ul> --}}

            <div class="tab-content  p-2" id="pills-tabContent">
                <!-- Tab tất cả table -->
                <div class="tab-pane fade show active" id="pills-tat_ca" role="tabpanel" aria-labelledby="pills-tat_ca-tab">
                    <div class="table-responsive table-scrollable">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-tat_ca" role="tabpanel"
                                aria-labelledby="pills-tat_ca-tab">
                                <div class="table-responsive table-scrollable">
                                    <table class="table table-head-custom" id="table-hop-dong-den-han">
                                        <thead>
                                            <tr class="header-table-height">
                                                <th class="text-12 text-uppercase" >#</th>
                                                <th class="text-12 text-uppercase" >Mã</th>
                                                <th class="text-12 text-uppercase" >TÊN</th>
                                                <th class="text-12 text-uppercase" >Ngày tính phí</th>
                                                <th class="text-12 text-uppercase" >Hạn tạo hóa đơn</th>
                                                <th class="text-12 text-uppercase" >Mã phòng thuê</th>
                                                <th class="text-12 text-uppercase" >Tên phòng thuê</th>
                                                <th class="text-12 text-uppercase" >Loại hợp đồng</th>
                                                <th class="text-12 text-uppercase">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contracts as $contract)
                                                <tr>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle" type="button"
                                                                id="dropdownMenuButton" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item " target="_blank" href="{{route('chi-so-dich-vu.show', $contract->id)}}">Xem chỉ số dịch vụ</a>
                                                                <span class="dropdown-item"  onclick="createInvoice(this)"
                                                                data-id_room="{{ $contract->room->id }}" data-url="{{ route('hoa-don.create') }}">Xuất hóa đơn</span>
                                                                <span class="dropdown-item btn-edit-contract" role="button"
                                                                    data-url="{{ route('hop-dong.edit', $contract->id) }}">Sửa
                                                                    hợp đồng</span>
                                                                <span class="dropdown-item btn-get-process-contract" 
                                                                    data-url="{{ route('hop-dong.getProcess', $contract->id) }}">Kiểm duyệt hợp đồng</span>
                                                                <a class="dropdown-item" href="{{ route('pdf.contract', $contract->id) }}" target="_blank">Xem hợp đồng</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="{{ formatColorContract($contract->status) }}">
                                                        {{ $contract->code }}</td>
                                                    <td>{{ $contract->name }}</td>
                                                    
                                                    <td>{{ date('d/m/Y', strtotime($contract->time_charge)) }}</td>
                                                    <td>@if($contract->day_remaining>0)
                                                            Còn
                                                        @else
                                                            Trễ
                                                        @endif
                                                        {{abs( $contract->day_remaining )}} ngày</td>

                                                    <td> {{ $contract->room->code }} </td>
                                                    <td>{{ $contract->room->name }}</td>
                                                    <td>{{ getContractType($contract->type) }}</td>

                                                    <td>{{ getContractStatus($contract->status) }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- End tab tất cả table -->
                <div class="tab-pane fade" id="pills-moi" role="tabpanel" aria-labelledby="pills-moi-tab">
                    2
                </div>
                <div class="tab-pane fade" id="pills-dang_tien_hanh" role="tabpanel"
                    aria-labelledby="pills-dang_tien_hanh-tab">
                    3
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
<script>
    $(document).ready(function() {
         var table = $('#table-hop-dong-den-han').DataTable();
    });
</script>
@endpush
