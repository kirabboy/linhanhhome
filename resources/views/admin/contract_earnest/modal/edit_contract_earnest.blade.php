<div class="modal model-render fade modal-primary" id="modalFormCreate" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Sửa hợp đồng cọc</h5>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="closeModalRender()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-update-contract-earneast" action="{{route('hop-dong-coc.update', $contract_earnest->id)}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="border border-1 p-2">
                        <label class="font-weight-bold text-danger">1. Thông tin hợp đồng</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tên phòng thuê <sup class="text-danger">*</sup></label>
                                    <input type="text" name="" class="form-control" value="{{$contract_earnest->room->name}}"
                                        placeholder="Tên phòng thuê" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Loại hợp đồng<sup class="text-danger">*</sup></label>
                                    <select class="form-control" name="type" readonly>
                                        <option value="2" selected>Hợp đồng cọc</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày bắt đầu<sup class="text-danger">*</sup></label>
                                    <input type="date" name="time_start" class="form-control"
                                        placeholder="Ngày bắt đầu" value="{{date('Y-m-d',strtotime($contract_earnest->time_start))}}" required pattern="(?:30))|(?:(?:0[13578]|1[02])-31))/(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])/(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])">
                                </div>
                                <div class="form-group">
                                    <label for="">Tiền cọc<sup class="text-danger">*</sup></label>
                                    <input type="number" name="amount_earnest" value="{{$contract_earnest->contractinfo->amount_earnest}}" class="form-control"
                                        placeholder="Tiền cọc" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Mã hợp đồng<sup class="text-danger">*</sup></label>
                                    <input type="text" name="code" class="form-control" value="{{$contract_earnest->code}}" placeholder="Mã hợp đồng"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tên hợp đồng<sup class="text-danger">*</sup></label>
                                    <input type="text" name="name" class="form-control" value="{{$contract_earnest->name}}" placeholder="Tên hợp đồng"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày kết thúc<sup class="text-danger">*</sup></label>
                                    <input type="date" name="time_end" class="form-control"
                                        placeholder="Ngày kết thúc" value="{{date('Y-m-d',strtotime($contract_earnest->time_end))}}" required pattern="(?:30))|(?:(?:0[13578]|1[02])-31))/(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])/(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])">
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái<sup class="text-danger">*</sup></label>
                                    <select name="status" class="form-control" id="">
                                        <option value="1" {{$contract_earnest->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="2" {{$contract_earnest->status == 2 ? 'selected' : '' }}>Ngừng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="">Mô tả hợp đồng</label>
                                <textarea name="note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="border border-1 p-2">
                        <label class="font-weight-bold text-danger">2. Thông tin khách hàng</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Chọn khách hàng <sup class="text-danger">*</sup></label>
                                    <select id="customer" data-url="{{ route('customer.getInfo') }}"
                                        class="customer form-control" name="id_customer">
                                        <option value="">--Chọn khách hàng--</option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}" {{$customer->id == $item->id ? ' selected' : '' }}>{{ $item->fullname }}</option>
                                        @endforeach
                                    </select>
                                    <div id="result-select2"></div>
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại<sup class="text-danger">*</sup></label>
                                    <input type="text" id="phone" class="form-control" value="{{$customer->phone}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Email<sup class="text-danger">*</sup></label>
                                    <input type="text" id="email" class="form-control" value="{{$customer->email}}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Số CMND/CCCD <sup class="text-danger">*</sup></label>
                                    <input type="text" id="id_number" class="form-control" value="{{$customer->identification_number}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày cấp <sup class="text-danger">*</sup></label>
                                    <input type="date" id="id_date" class="form-control" value="{{date('Y-m-d',strtotime($customer->identification_time))}}"readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nơi cấp <sup class="text-danger">*</sup></label>
                                    <input type="text" id="id_place" class="form-control" value="{{$customer->identification_address}}" readonly>
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
<script src="{{ asset('/public/admin/js/create_contract_earnest.js') }}"></script>
