@extends('admin.layouts.master')

@section('title', 'Cài đặt')

@section('content')
<!-- Team -->
<div class="content-wrapper">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="page-title"><i class="fas fa-laptop"></i>Cài đặt</h3>
    </div>
    <div class="row justify-content-center p-2">
        <div class="col-xs-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Thông tin cài đặt</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.setting.update')}}" class="g-3" method="post">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="">Phần trăm hoa hồng: ( % )</label>
                            <input type="number" required class="form-control" name="percent_commission" min="1" value="{{ $percent_commission->value['percent'] }}">
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary" type="submit">Lưu lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Team -->
<!-- footer -->
<div class="d-flex justify-content-center pb-1 mt-4">
    <span class="footer__copyright">Copyright©2005-2021 . All rights reserved</span>
</div>
<!-- end footer -->

<!-- scroll top -->
<div class="scroll__top">
    <a href="#"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></a>
</div>
<!-- end scroll top -->
@endsection
