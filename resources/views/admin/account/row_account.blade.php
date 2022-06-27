<tr class="item-{{ $admin->id }}">
    <td>
        {{ $admin->username }}
    </td>
    <td>
        {{ $admin->admin_info->fullname }}
    </td>
    <td>{!! showAdminWithRoles($admin->roles) !!}</td>
    <td>
        {{ $admin->admin_info->email }}
    </td>
    <td>
        {{ $admin->admin_info->phone }}
    </td>
    <td>
        {{ config('custom.user.gender')[$admin->admin_info->gender] }}
    </td>
    <td>
        {{ $admin->admin_info->birthday }}
    </td>
    <td>
        {{ $admin->admin_info->address }}
    </td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning admin-edit" data-route="{{ route('quan-ly-admin.edit', $admin->id) }}"><i
                    class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-danger admin-delete"
                data-route="{{ route('quan-ly-admin.destroy', $admin->id) }}"><i class="fa fa-trash"></i></button>
        </div>
    </td>
</tr>