<div class="modal model-render fade modal-primary" id="modalFormCreateContract" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Thêm hợp đồng</h5>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="closeModalRender()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-create-contract" action="{{ route('hop-dong.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="border border-1 p-2">
                        <label class="font-weight-bold text-danger">1. Thông tin hợp đồng</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tên phòng thuê <sup class="text-danger">*</sup></label>
                                    <input type="text" name="" class="form-control"
                                        value="{{ $room->name }}" placeholder="Tên phòng thuê" readonly>
                                    <input type="hidden" name="id_room" value="{{ $room->id }}" readonly>
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
                                        placeholder="Ngày bắt đầu" value="{{date('Y-m-d')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày tính phí<sup class="text-danger">*</sup></label>
                                    <input type="date" name="time_charge" class="form-control"
                                        placeholder="Ngày tính phí" value="{{date('Y-m-d')}}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Mã hợp đồng<sup class="text-danger">*</sup></label>
                                    <input type="text" name="code" class="form-control"
                                        value="{{ $contract_earnest != null ? $contract_earnest->code : '' }}"
                                        placeholder="Mã hợp đồng" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tên hợp đồng<sup class="text-danger">*</sup></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $contract_earnest != null ? $contract_earnest->name : '' }}"
                                        placeholder="Tên hợp đồng" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày kết thúc<sup class="text-danger">*</sup></label>
                                    <input type="date" name="time_end" class="form-control"
                                        placeholder="Ngày kết thúc" value="{{date('Y-m-d')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Đặt cọc</label>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-2 justify-content-center d-flex">
                                            <input type="checkbox" class="input-group-text" name="is_earnest"
                                                value="1" {{ $contract_earnest != null ? 'checked' : '' }}>
                                        </div>
                                        <div class="col-10">
                                            <input type="number" class="form-control" name="amount_earnest"
                                                placeholder="Tiền đặt cọc"
                                                value="{{ $contract_earnest != null ? $contract_earnest->contractinfo->amount_earnest : '' }}">
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
                                <button type="button" class="btn btn-cyan" onclick="createCustomer(this)"
                                    data-route="{{ route('admin.customer.create') }}" data-is_contract_table="1">
                                    <i class="fas fa-plus-circle"></i>
                                    Thêm mới
                                </button>
                            </div>
                        </div>
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
                                                        value="1"></td>
                                                <td><input type="number" class="form-control" name="price_room"
                                                        value="{{ $room->price }}" placeholder="Đơn giá"></td>
                                                <td>tháng</td>
                                                <td><input type="text" class="form-control" name="note_room"
                                                        placeholder="Ghi chú">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Phí điện</td>
                                                <td><input type="number" class="form-control" name="number_electric"
                                                        value="1"></td>
                                                <td><input type="number" class="form-control" name="price_electric"
                                                        value="3500" placeholder="Đơn giá"></td>
                                                <td>kWh</td>
                                                <td><input type="text" class="form-control" name="note_electric"
                                                        value="" placeholder="Ghi chú">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Phí nước</td>
                                                <td><input type="number" class="form-control" name="number_water"
                                                        value="1"></td>
                                                <td><input type="number" class="form-control" name="price_water"
                                                        value="25000" placeholder="Đơn giá"></td>
                                                <td>
                                                    @if ($room->building()->value('type_water') == 1)
                                                        tháng
                                                    @else
                                                        m3
                                                    @endif
                                                    <input type="hidden" name="type_water"
                                                        value="{{ $room->building()->value('type_water') }}">

                                                </td>
                                                <td><input type="text" class="form-control" name="note_water"
                                                        placeholder="Ghi chú">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Phí dịch vụ</td>
                                                <td><input type="number" class="form-control" name="number_service"
                                                        value="1"></td>
                                                <td><input type="number" class="form-control" name="price_service"
                                                        value="100000" placeholder="Đơn giá"></td>
                                                <td>tháng</td>
                                                <td><input type="text" class="form-control" name="note_service"
                                                        placeholder="Ghi chú">
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
                    <button class="btn btn-cyan" type="submit">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-area-customer">

</div>
<script>
    $('#table-customer').DataTable({

        // order: [
        //     [1, 'asc']
        // ],
        order: [0, 'desc'],
        responsive: true,
        lengthMenu: [
            [25, 50, -1],
            [25, 50, "All"]
        ],
        ajax: "{{ route('customer.indexDatatable') }}",
        columnDefs: [{
                targets: 0,
                type: "html",
                render: function(data, id, row) {
                    @if ($contract_earnest != null)

                        if ("{{ $contract_earnest->customers()->first()->value('id') }}" == row.id) {
                            return `<input type="checkbox" class="select-customer" name="customer_ids[]" checked value="${row.id}" /><p style="visibility: hidden;display:none">0</p>`

                        } else {
                            return `<input type="checkbox" class="select-customer" name="customer_ids[]" value="${row.id}" />`

                        }
                    @else
                        return `<input type="checkbox" class="select-customer" name="customer_ids[]" value="${row.id}" />`
                    @endif
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
                    @if ($contract_earnest != null)
                        if ("{{ $contract_earnest->customers()->first()->value('id') }}" == row.id) {
                            return `<input type="radio" id="representative${row.id}" name="is_representative" checked value="${row.id}">`

                        } else {
                            return `<input type="radio" id="representative${row.id}" name="is_representative" disabled value="${row.id}">`

                        }
                    @else
                        return `<input type="radio" id="representative${row.id}" name="is_representative" disabled value="${row.id}">`
                    @endif
                }

            },
            {
                targets: 5,
                type: "html",
                render: function(data, id, row) {
                    return `<input type="text" class="form-control" name="note${row.id}" value="">`
                }

            },

        ],
    });

    $(document).on('click', '.select-customer', function() {
        if ($(this).is(":checked")) {
            $('#representative' + $(this).val()).removeAttr('disabled');
        } else {
            $('#representative' + $(this).val()).attr('disabled', true);
        }
        $('#representative' + $('#table-customer input[type="checkbox"]:checked').val()).trigger('click');


    });
    $(".date-picker").datepicker({
        dateFormat: 'dd/mm/yy',
        inputFormat: 'dd/mm/yy',
        outputFormat: 'yy/mm/dd',
    });
</script>

<script>
    function createCustomer(e) {
        $.ajax({
                url: $(e).data('route'),
                type: 'GET',
                data: {
                    'is_contract_table': $(e).data('is_contract_table'),
                },
            })
            .fail(function(data) {
                toastr.error('Vui lòng tải lại trang', {
                    timeOut: 5000
                })
            })
            .done(function(response) {
                $('.modal-area-customer').empty().append(response);
                $('#modalFormCreateCustomer').modal('show');
            });
    }
</script>
