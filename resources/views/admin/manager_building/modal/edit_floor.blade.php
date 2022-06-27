<div class="model-render modal fade modal-primary" id="modalFormEdit" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Sửa Tầng</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(isset($floor))
            <form id="mainFormEdit" action="{{ route('admin.floor.update') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $floor->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Mã <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="code" placeholder="Mã tòa nhà"
                            value="{{ $floor->code }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tên tầng <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="name" placeholder="Tên tòa nhà"
                            value="{{ $floor->name }}" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-cyan bg-secondary" type="button" data-bs-dismiss="modal">Hủy</button>
                        <button class="btn btn-cyan" type="submit">Lưu lại</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
    <script>
        var myModalEl = document.getElementById('modalFormEdit');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            $(this).remove();
        })
    </script>
</div>
