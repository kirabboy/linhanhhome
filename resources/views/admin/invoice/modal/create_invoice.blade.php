<div class="modal model-render fade modal-primary" id="modal-form" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Xuất hóa đơn</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-create-invoice" action="{{ route('hoa-don.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Tháng</label>
                                <input type="number" class="form-control" name="month"
                                    value="{{ $service_detail['0']->month }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Phòng</label>
                                <input type="text" class="form-control" name="name_room" value="{{ $room->name }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Tên hóa đơn <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="name"
                                    value="Hóa đơn hợp đồng {{ $contract->code }} {{ date('m/Y') }}"
                                    placeholder="Tên hóa đơn" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Năm</label>
                                <input type="number" class="form-control" name="year" value="{{ date('Y') }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Hợp đồng</label>
                                <input type="text" class="form-control" name="name_contract"
                                    value="{{ $contract->name }}" readonly>
                                <input type="hidden" name="id_contract" value="{{ $contract->id }}">
                            </div>
                            <div class="form-group">
                                <label for="">Ngày lập <sup class="text-danger">*</sup></label>
                                <input type="date" class="form-control" name="date_create" value=""
                                    placeholder="Ngày lập" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Tòa nhà</label>
                                <input type="text" class="form-control" name="name_building"
                                    value="{{ $room->building->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Mã hóa đơn <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="code"
                                    value="HOADON-{{ $contract->code }}-{{ date('m/Y') }}" placeholder="Mã hóa đơn"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="">Hạn thanh toán <sup class="text-danger">*</sup></label>
                                <input type="date" class="form-control" name="date_expired"
                                    placeholder="Hạn thanh toán" value="" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-create-contract">
                                    <thead>
                                        <tr>
                                            <th scope="col">Dịch vụ</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Tiêu thụ</th>
                                            <th scope="col">Đơn giá</th>
                                            <th scope="col">Đơn vị</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Phí thuê nhà</td>
                                            <td><input type="number" class="form-control" name="number_room"
                                                    value="{{ $contract->contractinfo->number_room }}" readonly></td>
                                            <td><input type="number" class="form-control" name="used_room"
                                                    value="{{ $contract->contractinfo->number_room }}"
                                                    placeholder="Tiêu thụ" readonly></td>
                                            </td>
                                            <td><input type="number" class="form-control" name="price_room"
                                                    value="{{ $contract->contractinfo->price_room }}"
                                                    placeholder="Đơn giá" readonly></td>
                                            <td>tháng</td>
                                            <td><input type="number" class="form-control" name="amount_room"
                                                    value="{{ $contract->contractinfo->number_room * $contract->contractinfo->price_room }}"
                                                    placeholder="Thành tiền" readonly>
                                            </td>
                                        </tr>
                                        @foreach ($service_detail as $item)
                                            <tr>
                                                <td>{{ formatContractService($item->type) }}</td>
                                                <td><input type="number" class="form-control" name="number_electric"
                                                        value="{{ $contract->contractinfo->number_electric }}"
                                                        readonly></td>
                                                <td><input type="number" class="form-control" name="used_electric"
                                                        value="{{ $item->end_number - $item->start_number }}"
                                                        placeholder="Tiêu thụ" readonly></td>
                                                </td>
                                                <td><input type="number" class="form-control" name="price_electric"
                                                        value="{{ $item->type == 1 ? $contract->contractinfo->price_electric : $contract->contractinfo->price_water }}"
                                                        placeholder="Đơn giá" readonly></td>
                                                <td>{{ $item->type == 1 ? 'Kwh' : ($contract->contractinfo->type_water == 1 ? 'tháng' : 'm3') }}
                                                </td>
                                                <td><input type="number" class="form-control"
                                                        name="{{ $item->type == 1 ? 'amount_electric' : 'amount_water' }}"
                                                        value="{{ ($item->end_number - $item->start_number) * ($item->type == 1 ? $contract->contractinfo->price_electric : $contract->contractinfo->price_water) }}"
                                                        placeholder="Thành tiền" readonly>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($contract->contractinfo->type_water == 1)
                                            <tr>
                                                <td>Phí nước</td>
                                                <td><input type="number" class="form-control" name="number_water"
                                                        value="{{ $contract->contractinfo->number_water }}" readonly>
                                                </td>
                                                <td><input type="number" class="form-control" name="used_water"
                                                        value="{{ $contract->contractinfo->number_water }}"
                                                        placeholder="Tiêu thụ" readonly></td>
                                                </td>
                                                <td><input type="number" class="form-control" name="price_water"
                                                        value="{{ $contract->contractinfo->price_water }}"
                                                        placeholder="Đơn giá" readonly></td>
                                                <td>
                                                    tháng

                                                </td>
                                                <td>
                                                    <input type="number" class="form-control"
                                                        value="{{ $contract->contractinfo->number_water * $contract->contractinfo->price_water }}"
                                                        name="amount_water" placeholder="Thành tiền" readonly>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Phí dịch vụ</td>
                                            <td><input type="number" class="form-control" name="number_service"
                                                    value="{{ $contract->contractinfo->number_service }}" readonly>
                                            </td>
                                            <td><input type="number" class="form-control" name="used_service"
                                                    value="{{ $contract->contractinfo->number_service }}"
                                                    placeholder="Tiêu thụ" readonly></td>
                                            </td>
                                            <td><input type="number" class="form-control" name="price_service"
                                                    value="{{ $contract->contractinfo->price_service }}"
                                                    placeholder="Đơn giá" readonly></td>
                                            <td>tháng</td>
                                            <td><input type="number" class="form-control"
                                                    value="{{ $contract->contractinfo->number_service * $contract->contractinfo->price_service }}"
                                                    name="amount_service" placeholder="Thành tiền" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Tổng cộng</label>
                                <input type="number" class="form-control text-right" name="total" value="" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Đã thanh toán</label>
                                <input type="number" class="form-control text-right" name="amount_paid" value="0">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Còn lại</label>
                                <input type="number" class="form-control text-right" name="amount_rest" value="0"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-cyan bg-secondary" type="button" data-bs-dismiss="modal">Hủy</button>
                    <button class="btn btn-cyan" type="submit">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('input[name="total"]').val(parseInt($('input[name="amount_room"]').val()) + parseInt($(
            'input[name="amount_electric"]').val()) +
        parseInt($('input[name="amount_water"]').val()) + parseInt($('input[name="amount_service"]').val()));
    $('input[name="amount_paid"]').on('change', function() {
        $('input[name="amount_rest"]').val(parseInt($('input[name="total"]').val()) - parseInt($(
            'input[name="amount_paid"]').val()));
    });
</script>
