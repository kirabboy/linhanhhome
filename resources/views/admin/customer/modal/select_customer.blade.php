<div class="modal model-render fade modal-primary" id="modalFormCreate" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Thêm hợp đồng</h5>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="closeModalRender()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mainFormCreate" action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="table-customer" class="table table-sm">
                                    <thead>
                                        <th></th>
                                        <th>#</th>
                                        <th>Khách hàng</th>
                                        <th>CCCD/CMND</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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

