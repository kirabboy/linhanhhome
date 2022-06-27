<div class="modal fade model-render" id="modalFormCreate" tabindex="-1" role="dialog" aria-labelledby="modal-create-account"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tạo tài khoản Admin</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mainFormCreate" action="{{ route('quan-ly-admin.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên tài khoản <sup class="text-danger">*</sup></label>
                                <input type="text" name="username" class="form-control" placeholder="Tên tài khoản" required>
                            </div>
                            <div class="form-group">
                                <label for="">Họ và tên <sup class="text-danger">*</sup></label>
                                <input type="text" name="fullname" class="form-control" placeholder="Họ và tên" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="number" name="phone" class="form-control" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Mật khẩu <sup class="text-danger">*</sup></label>
                                <input type="text" name="password" class="form-control" placeholder="Mật khẩu" required>
                            </div>
                            <div class="form-group">
                                <label for="">Giới tính</label>
                                <select name="gender" class="form-control" required>
                                    @foreach($gender as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Ngày sinh</label>
                                <input type="date" name="birthday" class="form-control" placeholder="Ngày sinh">
                            </div>
                            <div class="form-group">
                                <label for="">Vai trò</label>
                                <select name="role" class="form-control" required>
                                    <option value="" disabled selected hidden>Chọn vai trò</option>
                                    @foreach($roles as $value)
                                    <option value="{{ $value->name }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-cyan bg-secondary" data-bs-dismiss="modal" type="button">Hủy</button>
                    <button type="submit" class="btn btn-cyan">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    var myModalEl = document.getElementById('modalFormCreate');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            $(this).remove();
        })
    </script>
</div>
