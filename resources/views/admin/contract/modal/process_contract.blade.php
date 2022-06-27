<div class="modal model-render fade modal-primary" id="modal-form" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Kiểm duyệt hợp đồng</h5>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="closeModalRender()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-center">Thông tin hợp đồng</h4>
                    </div>
                    <div class="col-6">
                        <ul class="contract-info-detail">
                            <li><span>Mã hợp đồng: </span><b>{{ $contract->code }}</b></li>
                            <li><span>Tên hợp đồng: </span><b>{{ $contract->name }}</b></li>
                            <li><span>Phòng thuê: </span><b>{{ $contract->room->name }}</b></li>
                            <li><span>Tòa nhà thuê: </span><b>{{ $contract->room->building->name }}</b></li>
                            <li><span>Ngày tính phí:
                                </span><b>{{ date('d/m/Y', strtotime($contract->time_charge)) }}</b></li>
                            <li><span>Ngày bắt đầu:
                                </span><b>{{ date('d/m/Y', strtotime($contract->time_start)) }}</b>
                            </li>
                            <li><span>Ngày kết thúc: </span><b>{{ date('d/m/Y', strtotime($contract->time_end)) }}</b>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="contract-info-detail">
                            <li><span>Tên khách hàng: </span><b>{{ $customer->fullname }}</b></li>
                            <li><span>Số điện thoại: </span><b>{{ $customer->phone }}</b></li>
                            <li><span>Số chứng minh: </span><b>{{ $customer->identification_number }}</b></li>
                            <li><span>Phí thuê nhà:
                                </span><b>{{ formatPrice($contract->contractinfo->price_room) }}</b></li>
                            <li><span>Phí điện:
                                </span><b>{{ formatPrice($contract->contractinfo->price_electric) }}</b></li>
                            <li><span>Phí nước: </span><b>{{ formatPrice($contract->contractinfo->price_water) }}</b>
                            </li>
                            <li><span>Phí dịch vụ:
                                </span><b>{{ formatPrice($contract->contractinfo->price_service) }}</b></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 text-center">
                        <button class="btn btn-success btn-process-contract"
                            data-url="{{ route('hop-dong.runProcess', ['id' => $contract->id, 'status' => 1]) }}">
                            Duyệt hợp đồng</button>
                    </div>
                    <div class="col-6 text-center">
                        <button class="btn btn-danger btn-process-contract"
                            data-url="{{ route('hop-dong.runProcess', ['id' => $contract->id, 'status' => 3]) }}">
                            Hủy hợp đồng</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cyan bg-secondary" type="button" data-bs-dismiss="modal"
                    onclick="closeModalRender()">Hủy</button>
            </div>
        </div>
    </div>
</div>
