<div class="modal model-render fade modal-primary" id="modal-form" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Sửa hợp đồng</h5>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="closeModalRender()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-edit-contract" action="{{ route('hop-dong.update',$contract->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="border border-1 p-2">
                        <label class="font-weight-bold text-danger">1. Thông tin hợp đồng</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tên phòng thuê <sup class="text-danger">*</sup></label>
                                    <input type="text" name="" class="form-control" value="{{$contract->room->name}}"
                                        placeholder="Tên phòng thuê" readonly>
                                    <input type="hidden" name="id_room" value="{{$contract->room->id}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Loại hợp đồng<sup class="text-danger">*</sup></label>
                                    <select class="form-control" name="type" readonly>
                                        <option value="1" selected>Hợp đồng thuê</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày bắt đầu<sup class="text-danger">*</sup></label>
                                    <input type="date" name="time_start" class="form-control"
                                        placeholder="Ngày bắt đầu" value="{{date('Y-m-d',strtotime($contract->time_start))}}" required >
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày tính phí<sup class="text-danger">*</sup></label>
                                    <input type="date" name="time_charge" class="form-control"
                                        placeholder="Ngày tính phí" value="{{date('Y-m-d',strtotime($contract->time_charge))}}" required >
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái<sup class="text-danger">*</sup></label>
                                    <select class="form-control" name="status" id="" readonly>
                                        <option value="0" {{$contract->status == 0 ? 'selected' : ''}}>Chờ duyệt</option>
                                        <option value="1" {{$contract->status == 1 ? 'selected' : ''}}>Hiệu lực</option>
                                        <option value="2" {{$contract->status == 2 ? 'selected' : ''}}>Hết hạn</option>
                                        <option value="3" {{$contract->status == 3 ? 'selected' : ''}}>Đã hủy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Mã hợp đồng<sup class="text-danger">*</sup></label>
                                    <input type="text" name="code" class="form-control" placeholder="Mã hợp đồng"
                                        value="{{$contract->code}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tên hợp đồng<sup class="text-danger">*</sup></label>
                                    <input type="text" name="name" class="form-control" placeholder="Tên hợp đồng"
                                        value="{{$contract->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày kết thúc<sup class="text-danger">*</sup></label>
                                    <input type="date" name="time_end" class="form-control"
                                        placeholder="Ngày kết thúc"  value="{{date('Y-m-d',strtotime($contract->time_end))}}"required >
                                </div>
                                <div class="form-group">
                                    <label for="">Đặt cọc</label>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-2 justify-content-center d-flex">
                                            <input type="checkbox" class="input-group-text" name="is_earnest" @if($contract->is_earnest == 1) checked @endif value="1">
                                        </div>
                                        <div class="col-10">
                                            <input type="number" class="form-control" name="amount_earnest"
                                                placeholder="Tiền đặt cọc" value="{{$contract->contractinfo->amount_earnest}}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <label for="">Mô tả hợp đồng</label>
                                <textarea name="note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="border border-1 p-2 mt-3">
                        <label class="font-weight-bold text-danger">2. Thông tin khách hàng</label>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="table-customer" class="table table-sm table-create-contract">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Khách hàng</th>
                                                <th scope="col">CCCD/CMND</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Đại diện</th>
                                                <th scope="col">Ghi chú</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border border-1 p-2 mt-3">
                        <label class="font-weight-bold text-danger">3. Thông tin dịch vụ</label>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-create-contract">
                                        <thead>
                                            <tr>
                                                <th scope="col">Dịch vụ</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Đơn giá</th>
                                                <th scope="col">Đơn vị</th>
                                                <th scope="col">Ghi chú</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Phí thuê nhà</td>
                                                <td><input type="number" class="form-control" name="number_room"
                                                        value="{{$contract->contractinfo->number_room}}"></td>
                                                <td><input type="number" class="form-control" name="price_room"
                                                        value="{{$contract->contractinfo->price_room}}" placeholder="Đơn giá"></td>
                                                <td>tháng</td>
                                                <td><input type="text" class="form-control" name="note_room" value="{{$contract->contractinfo->note_room}}" placeholder="Ghi chú">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Phí điện</td>
                                                <td><input type="number" class="form-control" name="number_electric"
                                                        value="{{$contract->contractinfo->number_electric}}"></td>
                                                <td><input type="number" class="form-control" name="price_electric"
                                                        value="{{$contract->contractinfo->price_electric}}" placeholder="Đơn giá"></td>
                                                <td>kWh</td>
                                                <td><input type="text" class="form-control" name="note_electric"
                                                        value="{{$contract->contractinfo->note_electric}}" placeholder="Ghi chú">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Phí nước</td>
                                                <td><input type="number" class="form-control" name="number_water" value="{{$contract->contractinfo->number_water}}"></td>
                                                <td><input type="number" class="form-control" name="price_water" value="{{$contract->contractinfo->price_water}}"
                                                        placeholder="Đơn giá"></td>
                                                <td><select name="type_water" class="form-control" id="" >
                                                    @if($contract->contractinfo->type_water == 1) <option value="1" selected >tháng</option>@endif
                                                    @if($contract->contractinfo->type_water == 2) <option value="2" selected >m3</option>@endif
                                                    </select></td>
                                                <td><input type="text" class="form-control" name="note_water value="{{$contract->contractinfo->note_water}} placeholder="Ghi chú">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Phí dịch vụ</td>
                                                <td><input type="number" class="form-control" name="number_service" value="{{$contract->contractinfo->number_service}}"></td>
                                                <td><input type="number" class="form-control" name="price_service" value="{{$contract->contractinfo->price_service}}"
                                                        placeholder="Đơn giá"></td>
                                                <td>tháng</td>
                                                <td><input type="text" class="form-control" name="note_service" value="{{$contract->contractinfo->note_service}}" placeholder="Ghi chú">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-cyan bg-secondary" type="button" data-bs-dismiss="modal"
                        onclick="closeModalRender()">Hủy</button>
                        <a href="{{ route('pdf.contract', $contract->id) }}" target="_blank" class="btn btn-cyan">In PDF</a>
                    <button class="btn btn-cyan" type="submit">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#table-customer').DataTable({

        // order: [
        //     [1, 'asc']
        // ],
        responsive: true,
        lengthMenu: [
            [25, 50, -1],
            [25, 50, "All"]
        ],
        ajax: "{{ route('customer.indexDatatableEdit',$contract->id) }}",
        columnDefs: [{
                targets: 0,
                type: "html",
                render: function(data, id, row) {
                    if(row.id_contract){
                        return `<input type="checkbox" onclick="selectCustomer(this)" name="customer_ids[]" value="${row.id_customer}" checked />`
                    }
                    else{
                        return `<input type="checkbox" onclick="selectCustomer(this)" name="customer_ids[]" value="${row.id}" />`

                    }
                }

            },
            {
                targets: 1,
                type: "html",
                render: function(data, fullname, row) {
                    return `${row.fullname}`
                }

            },
            {
                targets: 2,
                type: "html",
                render: function(data, identification_number, row) {
                    return `${row.identification_number}`
                }

            },
            {
                targets: 3,
                type: "html",
                render: function(data, id, row) {
                    return `${row.phone}`
                }

            },
            {
                targets: 4,
                type: "html",
                render: function(data, id, row) {
                    if(row.is_representative == 1){
                        return `<input type="radio" id="representative${row.id_customer}" name="is_representative"  value="${row.id_customer}" checked>`
                    }else if(row.id_contract){
                        return `<input type="radio" id="representative${row.id_customer}" name="is_representative"  value="${row.id_customer}">`
                    }else{
                        return `<input type="radio" id="representative${row.id}" name="is_representative" disabled value="${row.id}" >`

                    }
                }
            },
            {
                targets: 5,
                type: "html",
                render: function(data, id, row) {
                    if(row.id_contract){
                        if(row.note != null){
                            return `<input type="text" class="form-control" name="note${row.id_customer}" value="${row.note}">`
                        }else{
                            return `<input type="text" class="form-control" name="note${row.id}" value="">`
                        }

                    }else{
                        return `<input type="text" class="form-control" name="note${row.id}" value="">`

                    }
                }

            },

        ],
    });

    function selectCustomer(e) {
        if($(e).attr("checked")){
            $(e).removeAttr("checked");
        }
        if ($(e).is(":checked")) {
            $('#representative' + $(e).val()).removeAttr('disabled');
        } else {
            $('#representative' + $(e).val()).attr('disabled', true);
        }
        $('#representative' + $('#table-customer input[type="checkbox"]:checked').val()).trigger('click');


    }
</script>
