@extends('admin.layouts.master')
@section('title', 'Quản trị cơ sở')
    
@push('css')
    <link rel="stylesheet" href="{{ asset('public/admin/css/building.css') }}">
@endpush
@section('content')
    
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"><i class="fas fa-laptop"></i>Quản trị cơ sở</h3>
            <div class="page-header-tool">
                <button class="btn btn-cyan" id="btn-create-building" data-url="{{ route('admin.building.create') }}">
                    <i class="fas fa-plus-circle"></i>
                    Thêm tòa nhà
                </button>
            </div>
        </div>
        <div class="row building p-2" id="afterSubmit">
            @foreach($buildings as $building)
                @include('admin.manager_building.card_building', ['building' => $building])
            @endforeach
        </div>
    </div>
  
@endsection
@push('script-plugin')
<script src="{{ asset('public/packages/ckfinder/ckfinder.js') }}"></script>
@endpush
@push('script')
    <!-- <script src="{{ asset('public/admin/js/home.js') }}"></script> -->
    <script src="{{ asset('public/admin/js/building.js') }}"></script>
@endpush
