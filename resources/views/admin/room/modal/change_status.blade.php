<div class="modal fade modal-primary" id="modal-form" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Chuyển trạng thái</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-change-status-room" action="{{ route('phong.postChangeStatus') }}" method="post">
                <div class="modal-body">
                    <input type="hidden" name="room_id" value="{{$room->id}}">
                    <ul>
                        <li>Tên phòng: <span class="text-success">{{$room->name}}</span></li>
                        <li>Trạng thái hiện tại: <span class="text-success">@if($room->status != 3) Sử dụng @else Ngưng sử dụng @endif</span></li>
                        <li>Trạng thái chuyển tới: <span class="text-success">@if($room->status == 3) Sử dụng @else Ngưng sử dụng @endif</span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-cyan bg-secondary" data-bs-dismiss="modal" type="button">Hủy</button>
                    <button class="btn btn-cyan" type="submit">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>

