<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-8">
                <h5>Đơn vị thuê trống</h5>
                <p class="text-muted text-14 m-0">
                    Đơn vị thuê không chưa được thuê, bạn có thể tạo hợp đồng mới
                </p>
            </div>
            <div class="col-12 col-sm-4 text-center">
                <p class="m-2"> </p>
                <button class="btn btn-success text-12" data-room_id="{{ $room->id }}" onclick="createContract(this)"
                    data-url="{{ route('hop-dong.create') }}">
                    <i class="fa fa-plus-circle"></i> Tạo hợp đồng
                </button>
            </div>
        </div>
    </div>
</div>
