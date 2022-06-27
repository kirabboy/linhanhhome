<div class="modal fade modal-primary" id="modal-form" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title">Thêm phòng</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="create-room-form" action="{{ route('phong.store') }}" method="post">
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab"
                                aria-selected="true">Phòng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="asset-tab" data-toggle="tab" href="#asset" role="tab"
                                aria-selected="true">Tài sản</a>
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
                                <div class="col-12 col-sm-6">
                                    <input type="hidden" name="building_id" value="{{ $building->id }}">
                                    <div class="form-group">
                                        <label for="">Mã <sup class="text-danger">*</sup></label>
                                        <input type="text" name="code" class="form-control" placeholder="Mã phòng"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Loại <sup class="text-danger">*</sup></label>
                                        <select name="type" class="form-control" required>
                                            <option value="1">Phòng trọ</option>
                                            <option value="2">Căn hộ</option>
                                            <option value="3">Chung cư mini</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Giá/tháng <sup class="text-danger">*</sup></label>
                                        <input type="number" class="form-control" name="price" value="{{$building->price_room}}"
                                            placeholder="Giá phòng">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="">Tên phòng <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="name" placeholder="Tên phòng"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tầng <sup class="text-danger">*</sup></label>
                                        <select name="floor_id" class="form-control" required>
                                            @foreach ($floors as $floor)
                                                <option value="{{ $floor->id }}"
                                                    {{ $floor_id == $floor->id ? ' selected' : '' }}>
                                                    {{ $floor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Diện tích(m2) <sup class="text-danger">*</sup></label>
                                        <input type="number" class="form-control" name="acreage"
                                            placeholder="Diện tích">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Ghi chú</label>
                                        <textarea name="note" id="" rows="10" class="w-100"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="imageTab" role="tabpanel">
                            <div class="form-group">
                                <label for="">Hình đại diện</label>
                                <div class="form-group">
                                    <input type="text" class="form-control d-none" name="avatar"
                                        value="/public/image/default-image.png">
                                    <img id="avatar" class="add-image-ckfinder pointer" data-preview="#avatar"
                                        data-input="input[name='avatar']" data-type=""
                                        src="{{ asset('/public/image/default-image.png') }}" alt="" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="asset" role="tabpanel">
                            <div class="form-group">
                                <label for="">Tài sản</label>
                                <textarea class="editor" name="asset"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="extend" role="tabpanel">
                            <div class="form-group">
                                <label for="">Tên Hiển thị blog <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="name_blog"
                                    placeholder="Tên hiển thị bài viết khách hàng">
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <textarea class="editor" name="description"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-cyan bg-secondary" data-bs-dismiss="modal" type="button">Hủy</button>
                    <button class="btn btn-cyan" type="submit">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('/public/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/public/packages/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('/public/packages/ckfinder/ckfinder.js') }}"></script>

    <script>
        $('textarea.editor').ckeditor({
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

        var myModalEl = document.getElementById('modal-form');
        myModalEl.addEventListener('hidden.bs.modal', function(event) {
            $(this).remove();
        })
    </script>
</div>
