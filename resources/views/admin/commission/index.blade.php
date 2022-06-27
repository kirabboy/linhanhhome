@extends('admin.layouts.master')
@section('title', 'Quản lý hoa hồng')

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="{{ asset('public/admin/css/select2.css') }}">

@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header" style="border-bottom: 1px solid #d3d3d3; padding-bottom: 15px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <p class="m-0" style="line-height: 40px; font-size: 14px;">
                        <i class="nav-icon fas fa-users text-success"></i>
                        Hoa hồng
                    </p>
                </div>
                @role(config('custom.role-admin'), 'admin')
                <div class="col-sm-10 text-right">
                    <button type="button" class="btn-change-status btn btn-cyan" data-action="1" disabled>
                        <i class="far fa-check-square"></i>
                        Duyệt
                    </button>
                    <button type="button" class="btn-change-status btn btn-cyan danger" data-action="0" disabled>
                        <i class="far fa-times-circle"></i>
                        Hủy duyệt
                    </button>
                </div>
                @endrole
            </div>
        </div>
    </section>
    <form id="formChangeStatus" class="form-delete" action="{{ route('admin.commission.multiple') }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="action" value="">
        <div class="row p-2">
            <table id="tableCommission" class="table">
                <thead>
                    <th class="no-sort text-12 text-uppercase" style="background-image: none !important;width: 10px">
                        @role(config('custom.role-admin'), 'admin')
                        <input class="form-check" name="checkAll" type="checkbox">
                        @endrole
                    </th>
                    <th>
                        Tên hợp đồng
                    </th>
                    <th>
                        CTV
                    </th>
                    <th>
                        Tòa nhà
                    </th>
                    <th>
                        Đơn vị thuê
                    </th>
                    <th>
                        Hoa hồng
                    </th>
                    <th>
                        Ngày ghi nhận
                    </th>
                    <th>
                        Trạng thái
                    </th>
                </thead>
                <tfoot style="display: table-header-group">
                    <tr>
                        <th></th>
                        <th class="yes">Tên hợp đồng</th>
                        <th class="yes">CTV</th>
                        <th>Tòa nhà</th>
                        <th class="yes">Đơn vị thuê</th>
                        <th></th>
                        <th class="yes">Ngày ghi nhận</th>
                        <th class="yes">Trạng thái</th>
                    </tr>
                </tfoot>
                <tbody id="afterSubmit">
                    @foreach ($commission as $item)
                    <tr>
                        <td>
                            @role(config('custom.role-admin'), 'admin')
                            <input type="checkbox" name="id[]" value="{{ $item->id }}">
                            @endrole
                        </td>
                        <td>{{ optional($item->contract)->name ?? 'HD không còn' }}</td>
                        <td>{{ optional($item->admin)->username ?? 'CTV không còn' }}</td>
                        <td>{{ optional($item->contract)->room->building->name ?? '' }}</td>
                        <td>{{ optional($item->contract)->room->floor->name ?? '' }} -
                            {{ optional($item->contract)->room->name ?? '' }}</td>
                        <td>{{ number_format($item->amount) }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td>{!! statusCommission($item->status) !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="p-5"></p>
    </form>

</div>
@endsection
@push('script')
<script src="{{ asset('public/admin/js/commission.js') }}"></script>
<script src="{{ asset('public/admin/js/checklist.js') }}"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endpush
