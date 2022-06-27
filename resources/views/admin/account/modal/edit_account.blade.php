<div class="modal fade model-render" id="modalFormEdit" tabindex="-1" role="dialog" aria-labelledby="modal-create-account"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sửa tài khoản Admin</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mainFormEdit" action="{{ route('quan-ly-admin.update', $admin->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $admin->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tên tài khoản <sup class="text-danger">*</sup></label>
                                <input type="text" name="username" class="form-control" placeholder="Tên tài khoản" value="{{ $admin->username }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Họ và tên <sup class="text-danger">*</sup></label>
                                <input type="text" name="fullname" class="form-control" placeholder="Họ và tên" value="{{ $admin->admin_info->fullname }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $admin->admin_info->email }}">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="number" name="phone" class="form-control" placeholder="Số điện thoại" value="{{ $admin->admin_info->phone }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Mật khẩu mới</label>
                                <input type="text" name="password" class="form-control" placeholder="Mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="">Giới tính</label>
                                <select name="gender" class="form-control" required>
                                    @foreach($gender as $key => $value)
                                        <option {{ checked( $key, $admin->admin_info->gender )}} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Ngày sinh</label>
                                <input type="date" name="birthday" class="form-control" placeholder="Ngày sinh" value="{{ date('Y-m-d', strtotime($admin->admin_info->birthday)) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Vai trò</label>
                                <select name="role" class="form-control" required>
                                    <option value="" disabled selected hidden>Chọn vai trò</option>
                                    @foreach($roles as $value)
                                    <option {{ checkAdminHasRole( $admin, $value )}} value="{{ $value->name }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="{{ $admin->admin_info->address }}">
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
    var myModalEl = document.getElementById('modalFormEdit');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            $(this).remove();
        })
    </script>
</div>

