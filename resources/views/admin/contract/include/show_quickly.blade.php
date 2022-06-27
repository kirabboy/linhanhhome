<div class="row pt-2">
    <div class="col-6">
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Tên hợp đồng</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14"><strong>{{ $current_contract->name }} <i
                            class="fas fa-edit text-success btn-edit-contract" role="button"
                            data-url="{{ route('hop-dong.edit', $current_contract->id) }}"></i></strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Loại hợp đồng</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 label label-light-success">{{ getContractType($current_contract->type) }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Thời gian bắt đầu</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 text-success">{{ date('d/m/Y', strtotime($current_contract->time_start)) }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 pt-1 text-14">Đặt cọc</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 label label-light-success">
                    {{ getEarnestStatus($current_contract->is_earnest) }}</p>
            </div>
        </div>

    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Mã</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14"><strong>{{ $current_contract->code }}</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Trạng thái</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 label label-light-success">
                    {{ getContractStatus($current_contract->status) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Thời gian kết thúc</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 text-success ">{{ date('d/m/Y', strtotime($current_contract->time_end)) }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 ">Số tiền</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 text-success">
                    {{ formatPrice($current_contract->contractinfo->price_room) }}</p>
            </div>
        </div>

    </div>
</div>
<div class="row pt-2">
    <div class="col-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <span class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                            href="#contract-customer-list" aria-expanded="false" aria-controls="contract-customer-list">
                            <i class="fas fa-user"></i> Danh sách khách hàng
                        </a>
                    </span>
                </div>
                <div id="contract-customer-list" class="panel-collapse collapse" role="tabpanel"
                    aria-labelledby="headingTwo">
                    <div class="panel-body">

                        <div class="table-responsive table-scrollable">
                            <table class="table table-head-custom">
                                <thead>
                                    <th class="text-12 text-uppercase">Khách hàng</th>
                                    <th class="text-12 text-uppercase">CMND/CCCD</th>
                                    <th class="text-12 text-uppercase">Số điện thoại</th>
                                    <th class="text-12 text-uppercase">Đại diện</th>
                                    <th class="text-12 text-uppercase">Ghi chú</th>
                                </thead>
                                <tbody>
                                    @foreach ($current_contract->customers()->get() as $item)
                                        <tr>
                                            <td>{{ $item->fullname }}</td>
                                            <td>{{ $item->identification_number }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                @if ($item->pivot->is_representative == 1)
                                                    <i class="fas fa-circle text-success"></i>
                                                @endif
                                            </td>
                                            <td>{{ $item->pivot->note }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">

                <div class="panel-heading" role="tab" id="headingTwo">
                    <span class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                            href="#contract-service-list" aria-expanded="false" aria-controls="contract-service-list">
                            <i class="fas fa-file-invoice"></i> Danh sách dịch vụ
                        </a>
                    </span>
                </div>
                <div id="contract-service-list" class="panel-collapse collapse" role="tabpanel"
                    aria-labelledby="headingTwo">
                    <div class="panel-body">

                        <div class="table-responsive table-scrollable">
                            <table class="table table-head-custom">
                                <thead>
                                    <th class="text-12 text-uppercase">Dịch vụ</th>
                                    <th class="text-12 text-uppercase">Số lượng</th>
                                    <th class="text-12 text-uppercase" colspan="2">Đơn giá</th>
                                    <th class="text-12 text-uppercase">Đơn vị</th>
                                    <th class="text-12 text-uppercase">Ngày tính phí</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Phí thuê nhà</td>
                                        <td>{{ $current_contract->contractinfo->number_room }}</td>
                                        <td>Theo tháng</td>
                                        <td> {{ formatPrice($current_contract->contractinfo->price_room) }}</td>
                                        <td></td>
                                        <td>{{ date('d/m/Y', strtotime($current_contract->time_charge)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phí điện</td>
                                        <td>{{ $current_contract->contractinfo->number_electric }}</td>
                                        <td>Cố định</td>
                                        <td> {{ formatPrice($current_contract->contractinfo->price_electric) }}</td>
                                        <td>kWh</td>
                                        <td>{{ date('d/m/Y', strtotime($current_contract->time_charge)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phí nước</td>
                                        <td>{{ $current_contract->contractinfo->number_room }}</td>
                                        <td>
                                            @if ($current_contract->contractinfo->type_water == 1)
                                                Theo tháng
                                            @else
                                                Cố định
                                            @endif
                                        </td>
                                        <td> {{ formatPrice($current_contract->contractinfo->price_water) }}</td>
                                        <td>
                                            @if ($current_contract->contractinfo->type_water == 1)
                                                Người
                                            @else
                                                m3
                                            @endif
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($current_contract->time_charge)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phí dịch vụ</td>
                                        <td>{{ $current_contract->contractinfo->number_service }}</td>
                                        <td>Theo tháng</td>
                                        <td> {{ formatPrice($current_contract->contractinfo->price_service) }}</td>
                                        <td>Người</td>
                                        <td>{{ date('d/m/Y', strtotime($current_contract->time_charge)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
