<tr class="item-{{ $customer->id }}">
    <td><input type="checkbox" name="id[]" value="{{ $customer->id }}"></td>
    <td>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $customer->id }}"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $customer->id }}">
                <li><span class="customer-edit dropdown-item"
                        data-route="{{ route('admin.customer.edit', $customer->id) }}">Chỉnh sửa</span></li>
                <li><span class="customer-delete dropdown-item"
                        data-route="{{ route('admin.customer.delete', $customer->id) }}">Xóa</span></li>
            </ul>
        </div>
    </td>
    <td>{{ $customer->code }}</td>
    <td>{{ $customer->identification_number }}</td>
    <td>{{ $customer->fullname }}</td>
    <td>{{ $customer->phone }}</td>
    <td>{{ $customer->email }}</td>
    <td>{{ $customer->contracts()->whereStatus(1)->value('name')}}</td>
</tr>