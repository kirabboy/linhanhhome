<div class="row pt-2">
    <div class="col-6">
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Tên hợp đồng</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14"><strong>{{ $current_contract_earnest->name }}</strong> <i
                    class="fas fa-edit text-success btn-edit-contract-earnest" role="button"
                    data-url="{{ route('hop-dong-coc.edit', $current_contract_earnest->id) }}"></i></p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6"> 
                <p class="m-0 mb-2 text-14">Loại hợp đồng</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 label label-light-success">{{ getContractType($current_contract_earnest->type) }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Thời gian bắt đầu</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 text-success">{{ date('d/m/Y', strtotime($current_contract_earnest->time_start)) }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 ">Khách hàng</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 text-success">
                    {{ $current_contract_earnest->customers[0]->fullname }}
                </p>
            </div>
        </div>

    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Mã</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14"><strong>{{ $current_contract_earnest->code }}</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Trạng thái</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 label label-light-success">
                    {{ getContractStatus($current_contract_earnest->status) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14">Thời gian kết thúc</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 text-success ">{{ date('d/m/Y', strtotime($current_contract_earnest->time_end)) }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 ">Số điện thoại</p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="m-0 mb-2 text-14 text-success">
                    {{ $current_contract_earnest->customers[0]->phone }}
                </p>
            </div>
        </div>

    </div>
</div>
