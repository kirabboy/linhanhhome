<div class="row pt-2">
    <div class="col-6 col-sm-3">
        <p class="m-0 mb-2 text-14">Tên đơn vị thuê</p>
        <p class="m-0 mb-2 text-14">Giá/tháng</p>
        <p class="m-0 mb-2 text-14">Trạng thái</p>
        <p class="m-0 mb-2 pt-1 text-14">Loại phòng</p>
    </div>
    <div class="col-6 col-sm-3">
        <p class="m-0 mb-2 text-14"><strong>{{ $room->name }}</strong></p>
        <p class="m-0 mb-2 text-14 text-success">{{ formatPrice($room->price) }}</p>
        <p class="m-0 mb-2 text-14 label label-light-success">{{ roomStatus($room->status) }}</p>
        <p class="m-0 mb-2 text-14 label label-light-success">{{ formatTypeRoom($room->type) }}</p>
    </div>
    <div class="col-6 col-sm-3">
        <p class="m-0 mb-2 text-14">Mã</p>
        <p class="m-0 mb-2 text-14">Tiền cọc</p>
        <p class="m-0 mb-2 text-14">Trạng thái hợp đồng</p>
    </div>
    <div class="col-6 col-sm-3">
        <p class="m-0 mb-2 text-14"><strong>{{ $room->code }}</strong></p>
        <p class="m-0 mb-2 text-14 text-success">{{ isset($current_contract)?formatPrice($current_contract->contractinfo->amount_earnest): '' }}</p>
        <p class="m-0 mb-2 ">@if($current_contract) <span class="text-14 label label-light-success">{{ isset($current_contract)?getContractStatus($current_contract->status):'' }}</span> @endif</p>
    </div>
    
</div>