<div class="model-render modal fade modal-primary" id="modalShowQuickly" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Thông tin đơn vị thuê {{ $room->name }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="closeModalRender()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($room))
                <div class="row">
                    <div class="col-6 mb-3">
                        <span>Tên: {{ $room->name }}</span>
                    </div>
                    <div class="col-6 mb-3">
                        <span>Trạng thái: </span>
                        <span class="badge bg-{{ badgeStatus($room->status) }}">{{ roomStatus($room->status) }}</span>
                    </div>
                    <div class="col-6">
                        <span>Mục đích: {{ config('custom.room.type')[$room->type] }}</span>
                    </div>
                    <div class="col-6">
                        <span>Diện tích: {{  $room->acreage }}m<sup>2</sup></span>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </div>
    <script>
        var myModalEl = document.getElementById('modalShowQuickly');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            $(this).remove();
        })
    </script>
</div>
