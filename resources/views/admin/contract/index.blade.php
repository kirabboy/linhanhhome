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
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title">
                <p class="m-0" style="line-height: 40px; font-size: 14px;">
                    <i class="nav-icon fas fa-paper-plane text-success"></i>
                    Danh sách hợp đồng
                </p>
            </h3>
            <div class="page-header-tool d-flex">
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
                <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                        class="fas fa-circle text-danger mr-2"></i>Chờ duyệt </span>
                <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                        class="fas fa-circle text-success mr-2"></i>Hiệu lực</span>
                <span class="mr-3 d-flex align-items-center font-weight-bold"><i
                        class="fas fa-circle text-secondary mr-2"></i>Đã hủy</span>

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
                                    <table class="table table-head-custom" id="table_hop_dong" style="width: 2150px;">
                                        <thead>
                                            <tr class="header-table-height">
                                                <th class="text-12 text-uppercase" style="width: 10px">#</th>
                                                <th class="text-12 text-uppercase" style="width: 10px">Mã</th>
                                                <th class="text-12 text-uppercase" style="width: 80px">TÊN</th>
                                                <th class="text-12 text-uppercase" style="width: 120px">Mã phòng thuê
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 120px">Tên phòng thuê
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 120px">Loại hợp đồng
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 110px">Loại phòng thuê
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 120px">Ngày bắt đầu
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 80px">Ngày kết thúc
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 150px">Ngày tính phí
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 150px">Đặt cọc</th>
                                                <th class="text-12 text-uppercase" style="width: 150px">Phí thuê nhà
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 150px">Người đại diện
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 150px">Số điện thoại
                                                </th>
                                                <th class="text-12 text-uppercase" style="width: 150px">Trạng thái</th>
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
                                                                <span class="dropdown-item btn-edit-contract" role="button"
                                                                    data-url="{{ route('hop-dong.edit', $contract->id) }}">Sửa
                                                                    hợp đồng</span>
                                                                <span class="dropdown-item btn-get-process-contract"
                                                                    data-url="{{ route('hop-dong.getProcess', $contract->id) }}">Kiểm
                                                                    duyệt hợp đồng</span>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('pdf.contract', $contract->id) }}"
                                                                    target="_blank">Xem hợp đồng</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="{{ formatColorContract($contract->status) }}">
                                                        {{ $contract->code }}</td>
                                                    <td>{{ $contract->name }}</td>
                                                    <td> {{ $contract->room->code }} </td>
                                                    <td>{{ $contract->room->name }}</td>
                                                    <td>{{ getContractType($contract->type) }}</td>
                                                    <td>{{ formatTypeRoom($contract->room->type) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($contract->time_start)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($contract->time_end)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($contract->time_charge)) }}</td>
                                                    <td>{{ formatPrice($contract->contractinfo->amount_earnest) }}
                                                    </td>
                                                    <td>{{ formatPrice($contract->contractinfo->price_room) }}</td>

                                                    <td>
                                                        @foreach ($contract->customers()->get() as $item)
                                                            @if ($item->pivot->is_representative == 1)
                                                                {{ $item->fullname }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($contract->customers()->get() as $item)
                                                            @if ($item->pivot->is_representative == 1)
                                                                {{ $item->phone }}
                                                            @endif
                                                        @endforeach
                                                    </td>

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
<script>
    $(document).on('hide.bs.modal', '.modal', function() {

        location.reload();

});
</script>
@endsection
@push('script')

    <script src="{{ asset('public/admin/js/contract.js') }}"></script>
    <script src="{{ asset('public/admin/js/create_contract.js') }}"></script>
    <script src="{{ asset('public/admin/js/workboard.js') }}"></script>
@endpush
