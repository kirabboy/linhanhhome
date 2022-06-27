<div class="modal model-render fade modal-primary" id="modalFormCreate" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Thêm tòa nhà</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mainFormCreate" action="{{ route('admin.building.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab"
                                aria-selected="true">Tòa nhà</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="image-tab" data-toggle="tab" href="#imageTab" role="tab"
                                aria-selected="false">Hình ảnh</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="extend-tab" data-toggle="tab" href="#extend" role="tab"
                                aria-selected="false">Mở rộng</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="main" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Mã <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="code" placeholder="Mã tòa nhà"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tên tòa nhà <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="name" placeholder="Tên tòa nhà"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Chủ sở hữu <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="owner" placeholder="Chủ sở hữu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Số tầng <sup class="text-danger">*</sup></label>
                                        <input type="number" class="form-control" name="number_floor"
                                            placeholder="Số tầng" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Giá phòng <sup class="text-danger">*</sup></label>
                                                <input type="number" class="form-control" name="price_room"
                                                    placeholder="Giá phòng" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cách tính nước <sup class="text-danger">*</sup></label>
                                                <select name="type_water" class="form-control" id="">
                                                    <option value="1">Theo tháng</option>
                                                    <option value="2">Theo m3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Địa chỉ <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="address" placeholder="Địa chỉ"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Điện thoại <sup class="text-danger">*</sup></label>
                                        <input type="number" class="form-control" name="owner_phone"
                                            placeholder="Số điện thoại" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email <sup class="text-danger">*</sup></label>
                                        <input type="email" class="form-control" name="owner_email"
                                            placeholder="Địa chỉ Email" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Ghi chú</label>
                                        <textarea class="form-control" name="note"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="extend" role="tabpanel">
                            <div class="form-group">
                                <label for="">ID messenger</label>
                                <input type="text" class="form-control" name="messgenger" placeholder="ID messgenger"
                                    value="">
                            </div>
                            <div class="form-group">
                                <label for="">Google map</label>
                                <textarea class="form-control" name="google_map"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <textarea name="introduce"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="imageTab" role="tabpanel">
                            <div class="form-group">
                                <label for="">Hình đại diện</label>
                                <div class="form-group">
                                    <input type="text" class="form-control d-none" name="avatar"
                                        value="/public/images/default-image.png">
                                    <img id="avatar" class="add-image-ckfinder pointer" data-preview="#avatar"
                                        data-input="input[name='avatar']" data-type=""
                                        src="{{asset('/public/image/default-image.png')}}" alt="" style="width: 100%">
                                </div>
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
    
    <script src="{{ asset('/public/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/public/packages/ckfinder/ckfinder.js') }}"></script>
    
    <script>
        CKEDITOR.replace('introduce', {
            toolbar: [{
                    name: 'clipboard',
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt']
                },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                        'CreateDiv',
                        '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'BidiLtr',
                        'BidiRtl'
                    ]
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink', 'Anchor']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak',
                        'Iframe'
                    ]
                },
                '/',
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                },
                {
                    name: 'tools',
                    items: ['Maximize', 'ShowBlocks', '-', 'About']
                }
            ]
        });

        var myModalEl = document.getElementById('modalFormCreate');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            $(this).remove();
        })
    </script>
</div>
