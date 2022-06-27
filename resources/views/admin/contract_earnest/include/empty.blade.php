<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-8">
                <h5>Đơn vị thuê trống cọc</h5>
                <p class="text-muted text-14 m-0">
                    Đơn vị thuê không có cọc giữ chỗ, bạn có thể nhận cọc mới
                </p>
            </div>
            <div class="col-12 col-sm-4 text-center">
                <p class="m-2"> </p>
                <button onclick="createContractEarnest(this)" data-room_id="{{ $room->id }}" data-url="{{ route('hop-dong-coc.create') }}" class="btn btn-success text-12">
                    <i class="fa fa-plus-circle"></i> Nhận cọc giữ chỗ
                </button>
            </div>
        </div>
    </div>
</div>

