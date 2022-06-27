<div class="modal fade modal-primary" id="modalFormCreate" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Thêm chỉ số công tơ</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-create-contract-service" action="{{ route('chi-so-dich-vu.store') }}" method="post">
                <div class="modal-body">
                    <div class="p-2">
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" name="id_contract" value="{{$contract->id}}">
                                <div class="form-group">
                                    <label for="">Loại công tơ <sup class="text-danger">*</sup></label>
                                    <select name="type" id="" class="form-control">
                                        <option value="1">Công tơ điện</option>
                                        @if($contract->contractinfo->type_water == 2)
                                        <option value="2">Công tơ nước</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tháng <sup class="text-danger">*</sup></label>
                                    <input type="number" class="form-control" name="month" value="{{date('m')}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Năm <sup class="text-danger">*</sup></label>
                                    <input type="number" class="form-control" name="year" value="{{date('Y')}}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Chỉ số đầu <sup class="text-danger">*</sup></label>
                                    <input type="number" class="form-control" name="start_number" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Chỉ số cuối <sup class="text-danger">*</sup></label>
                                    <input type="number" class="form-control" name="end_number" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Tiêu thụ <sup class="text-danger">*</sup></label>
                                    <input type="number" class="form-control" min="0" name="amount" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-cyan bg-secondary" data-bs-dismiss="modal" type="button">Hủy</button>
                    <button class="btn btn-cyan" type="submit">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('input[name="end_number"], input[name="start_number"]').on('change', function() {
        $('input[name="amount"]').val($('input[name="end_number"]').val() - $('input[name="start_number"]').val());
    });
</script>

