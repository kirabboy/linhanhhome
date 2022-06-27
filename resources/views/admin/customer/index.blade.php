@extends('admin.layouts.master')
@section('title', 'Hồ sơ khách hàng')

@push('css')
<style>
    .dropdown-toggle::after {
        display: none !important;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <form class="form-delete" action="{{ route('admin.customer.multiple') }}" method="post">
        @csrf
        @method('DELETE')
        <section class="content-header" style="border-bottom: 1px solid #d3d3d3; padding-bottom: 15px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="m-0" style="line-height: 40px; font-size: 14px;">
                            <i class="nav-icon fas fa-users text-success"></i>
                            Hồ sơ khách hàng
                        </p>
                    </div>
                    <div class="col-sm-10 text-right">
                        <button type="button" class="btn btn-cyan" id="createCustomer"
                            data-route="{{ route('admin.customer.create') }}">
                            <i class="fas fa-plus-circle"></i>
                            Thêm mới
                        </button>
                        <button type="submit" id="deleteCustomer" class="btn btn-cyan danger"
                            data-route="{{ route('quan-ly-admin.create') }}" disabled>
                            <i class="fa fa-trash"></i>
                            Xóa
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <div class="row p-2">
            <div class="table-responsive table-scrollable">
                <table class="table table-head-custom" id="tableCustomer">
                    <thead>
                        <tr class="header-table-height">
                            <th class="no-sort text-12 text-uppercase"
                                style="background-image: none !important;width: 10px">
                                <input class="form-check" name="checkAll" type="checkbox">
                            </th>
                            <th class="text-12 text-uppercase" style="width: 10px">#</th>
                            <th class="text-12 text-uppercase" style="width: 10px">Mã</th>
                            <th class="text-12 text-uppercase" style="width: 80px">CMND/CCCD</th>
                            <th class="text-12 text-uppercase" style="width: 150px">HỌ VÀ TÊN</th>
                            <th class="text-12 text-uppercase" style="width: 150px">SỐ ĐIỆN THOẠI</th>
                            <th class="text-12 text-uppercase" style="width: 160px">EMAIL</th>
                            <th class="text-12 text-uppercase" style="width: 160px">Hợp đồng hiện tại</th>
                        </tr>
                    </thead>
                    <tfoot style="display: table-header-group">
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="yes">Mã</th>
                            <th class="yes">Cmnd</th>
                            <th class="yes">Họ và tên</th>
                            <th class="yes">Sđt</th>
                            <th class="yes">Email</th>
                            <th class="yes">Hợp đồng hiện tại</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($customers as $customer)
                        @include('admin.customer.row', ['customer' => $customer])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <p class="p-5"></p>
    </form>
 
</div>
@endsection
@push('script')
<script src="{{ asset('public/admin/js/customer.js') }}"></script>
<script src="{{ asset('public/admin/js/checklist.js') }}"></script>
@endpush
